/*
 * ARXATEC MVP - static demo runtime.
 *
 * The pages of this demo are the HTML that the original PHP app renders.
 * This script stands in for the PHP backend: it keeps the session, answers the
 * requests the pages make and runs the same queries as the original models
 * against a SQLite database (sql.js) stored only in the visitor's browser.
 *
 * It is loaded first in <head> by demo/build.mjs with two data attributes:
 *   data-root  relative path from the page to the demo root ("../../")
 *   data-page  page id, e.g. "projects/admin/client_list"
 */
(function () {
  'use strict';

  const script = document.currentScript;
  const ROOT = script.dataset.root;
  const PAGE = script.dataset.page;
  const DEMO = ROOT + '_demo/';
  const QUERY = new URLSearchParams(location.search);

  const DB_VERSION = 1;
  const STORE = 'arxatec-mvp-demo';
  const SESSION_KEY = STORE + ':session';
  const SEEN_KEY = STORE + ':seen';
  const SOURCE_URL = 'https://github.com/arxatec-engine/arxatec-mvp';
  const AUTHOR_URL = 'https://linktr.ee/yemis_paredez';
  const PANEL_BY_ROLE = { admin: 'admin', cliente: 'customer', abogado: 'lawyer' };
  const DEMO_ACCOUNTS = [
    { label: 'Admin', email: 'admin@gmail.com', password: 'admin' },
    { label: 'Client', email: 'cliente@gmail.com', password: 'cliente' },
    { label: 'Lawyer', email: 'abogado@gmail.com', password: 'abogado' },
  ];

  /* ------------------------------------------------------------------ */
  /* Session: the equivalent of PHP's $_SESSION                          */
  /* ------------------------------------------------------------------ */

  const session = {
    get() {
      try { return JSON.parse(sessionStorage.getItem(SESSION_KEY)) || {}; } catch { return {}; }
    },
    set(value) {
      try { sessionStorage.setItem(SESSION_KEY, JSON.stringify(value)); } catch { /* private mode */ }
    },
    clear() {
      try { sessionStorage.removeItem(SESSION_KEY); } catch { /* private mode */ }
    },
  };

  const panelUrl = (role) => ROOT + 'projects/' + PANEL_BY_ROLE[role] + '/';

  // auth/middleware/logout.php
  if (PAGE === 'auth/middleware/logout') {
    session.clear();
    location.replace(ROOT + 'auth/');
    return;
  }
  // auth/middleware/session_check.php
  if (PAGE.startsWith('projects/') && !session.get().user_id) {
    location.replace(ROOT + 'auth/');
    return;
  }
  // auth/index.php: users already signed in go to their panel
  if (['auth/index', 'auth/register', 'auth/forgot_password'].includes(PAGE) && session.get().user_type) {
    location.replace(panelUrl(session.get().user_type));
    return;
  }

  /* ------------------------------------------------------------------ */
  /* Database: SQLite in the browser, persisted in IndexedDB             */
  /* ------------------------------------------------------------------ */

  const nativeFetch = window.fetch.bind(window);
  let db;

  function idb(mode, operation) {
    return new Promise((resolve, reject) => {
      const open = indexedDB.open(STORE, 1);
      open.onupgradeneeded = () => open.result.createObjectStore('store');
      open.onerror = () => reject(open.error);
      open.onsuccess = () => {
        const conn = open.result;
        const tx = conn.transaction('store', mode);
        const request = operation(tx.objectStore('store'));
        tx.oncomplete = () => { conn.close(); resolve(request.result); };
        tx.onerror = tx.onabort = () => { conn.close(); reject(tx.error); };
      };
    });
  }

  function toBase64(bytes) {
    let binary = '';
    for (let i = 0; i < bytes.length; i += 0x8000) {
      binary += String.fromCharCode.apply(null, bytes.subarray(i, i + 0x8000));
    }
    return btoa(binary);
  }

  function fromBase64(text) {
    const binary = atob(text);
    const bytes = new Uint8Array(binary.length);
    for (let i = 0; i < binary.length; i++) bytes[i] = binary.charCodeAt(i);
    return bytes;
  }

  // IndexedDB first; localStorage if IndexedDB is unavailable.
  const storage = {
    async load() {
      try {
        return await idb('readonly', (store) => store.get('db'));
      } catch {
        try {
          const saved = JSON.parse(localStorage.getItem(STORE));
          return saved && { version: saved.version, bytes: fromBase64(saved.bytes) };
        } catch { return null; }
      }
    },
    async save(record) {
      try {
        await idb('readwrite', (store) => store.put(record, 'db'));
      } catch {
        try {
          localStorage.setItem(STORE, JSON.stringify({ version: record.version, bytes: toBase64(record.bytes) }));
        } catch { /* data stays in memory for this page only */ }
      }
    },
    async clear() {
      try { await idb('readwrite', (store) => store.delete('db')); } catch { /* nothing stored */ }
      try { localStorage.removeItem(STORE); } catch { /* nothing stored */ }
    },
  };

  function loadSqlJs() {
    return new Promise((resolve, reject) => {
      const tag = document.createElement('script');
      tag.src = DEMO + 'vendor/sql.js/sql-wasm.js';
      tag.onload = () => window.initSqlJs({ locateFile: (file) => DEMO + 'vendor/sql.js/' + file }).then(resolve, reject);
      tag.onerror = reject;
      document.head.appendChild(tag);
    });
  }

  const persist = () => storage.save({ version: DB_VERSION, bytes: db.export() });

  const dbReady = (async () => {
    const SQL = await loadSqlJs();
    const saved = await storage.load();
    if (saved && saved.version === DB_VERSION) {
      db = new SQL.Database(saved.bytes);
    } else {
      db = new SQL.Database();
      for (const file of ['schema.sql', 'seed.sql']) {
        db.exec(await (await nativeFetch(DEMO + 'db/' + file)).text());
      }
      await persist();
    }
    db.exec('PRAGMA foreign_keys = ON;');
  })();

  const domReady = new Promise((resolve) => {
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', resolve, { once: true });
    else resolve();
  });

  const ready = Promise.all([dbReady, domReady]);

  function all(sql, params = []) {
    const statement = db.prepare(sql);
    statement.bind(params);
    const rows = [];
    while (statement.step()) rows.push(statement.getAsObject());
    statement.free();
    return rows;
  }

  const one = (sql, params) => all(sql, params)[0] || null;

  function insert(sql, params) {
    db.run(sql, params);
    return db.exec('SELECT last_insert_rowid()')[0].values[0][0];
  }

  // Runs the statements in one transaction and saves the database.
  async function transaction(statements) {
    db.exec('BEGIN');
    try {
      const result = statements();
      db.exec('COMMIT');
      await persist();
      return result;
    } catch (error) {
      db.exec('ROLLBACK');
      throw error;
    }
  }

  /* ------------------------------------------------------------------ */
  /* Helpers that mirror the PHP views                                   */
  /* ------------------------------------------------------------------ */

  // htmlspecialchars()
  const h = (value) => String(value ?? '').replace(/[&<>"']/g, (c) => (
    { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[c]
  ));
  const ucfirst = (value) => String(value ?? '').charAt(0).toUpperCase() + String(value ?? '').slice(1);

  // Shows the controller's result message right before the form, as the views do.
  function showFormMessage(form, html) {
    form.parentElement.querySelectorAll(':scope > [data-demo-message]').forEach((el) => el.remove());
    if (!html) return;
    const template = document.createElement('template');
    template.innerHTML = html.trim();
    const message = template.content.firstElementChild;
    message.setAttribute('data-demo-message', '');
    form.before(message);
  }

  /* ------------------------------------------------------------------ */
  /* Models (same queries as the PHP models)                             */
  /* ------------------------------------------------------------------ */

  const lawyersList = () => all("SELECT dni, nombres, apellidos FROM usuarios WHERE tipo_usuario = 'abogado' AND estado = 'activo'");

  const userProfile = (dni) => one(
    'SELECT nombres, apellidos, correo_electronico, dni, direccion, telefono, telefono_adicional, genero, imagen_perfil, contraseña FROM usuarios WHERE dni = ?',
    [dni],
  );

  function addUser(role, data) {
    return insert(
      `INSERT INTO usuarios (nombres, apellidos, correo_electronico, contraseña, tipo_usuario, dni, telefono, direccion)
       VALUES (?, ?, ?, ?, '${role}', ?, ?, ?)`,
      [data.get('name'), data.get('surname'), data.get('email'), data.get('password'), data.get('dni'), data.get('phone'), data.get('address')],
    );
  }

  const meetingsSql = (states) => `
    SELECT s.fecha_servicio, s.hora_servicio, s.estado, s.link_videollamada, s.mensaje, u.nombres, u.apellidos
    FROM servicio_consultas_videollamadas s
    INNER JOIN usuarios u ON s.dni_abogado = u.dni
    WHERE s.dni_cliente = ? AND s.estado IN (${states})`;

  /* ------------------------------------------------------------------ */
  /* Requests the original pages send with fetch()                       */
  /* ------------------------------------------------------------------ */

  const fetchRoutes = [
    {
      // auth: registration_controller.php ?checkEmail=
      match: (url) => url.searchParams.has('checkEmail'),
      handle: (url) => ({
        email_exists: !!one('SELECT id FROM usuarios WHERE correo_electronico = ? COLLATE NOCASE', [url.searchParams.get('checkEmail')]),
      }),
    },
    {
      // auth: registration_controller.php ?checkDni=
      match: (url) => url.searchParams.has('checkDni'),
      handle: (url) => ({ dni_exists: !!one('SELECT id FROM usuarios WHERE dni = ?', [url.searchParams.get('checkDni')]) }),
    },
    {
      // admin: profile_controller.php (image upload and password change)
      match: (url, method) => method === 'POST' && url.searchParams.get('page') === 'profile',
      handle: async (url, init) => {
        const form = init.body;
        const dni = session.get().dni;
        if (!dni) return '';
        const file = form.get('profile_image');
        if (file !== null) {
          const allowed = ['image/jpeg', 'image/png', 'image/jpg'];
          if (file instanceof File && allowed.includes(file.type) && file.size <= 800 * 1024) {
            const dataUrl = await new Promise((resolve, reject) => {
              const reader = new FileReader();
              reader.onload = () => resolve(reader.result);
              reader.onerror = reject;
              reader.readAsDataURL(file);
            });
            await transaction(() => db.run('UPDATE usuarios SET imagen_perfil = ? WHERE dni = ?', [dataUrl, dni]));
          }
          return '';
        }
        if (form.has('current_password') && form.has('new_password') && form.has('confirm_password')) {
          if (form.get('new_password') !== form.get('confirm_password')) return 'Error: Las contraseñas no coinciden.';
          if (userProfile(dni).contraseña !== form.get('current_password')) return 'Error: La contraseña actual no es correcta.';
          await transaction(() => db.run('UPDATE usuarios SET contraseña = ? WHERE dni = ?', [form.get('new_password'), dni]));
        }
        return '';
      },
    },
  ];

  window.fetch = async function (input, init = {}) {
    const url = new URL(typeof input === 'string' ? input : input.url, location.href);
    const method = (init.method || 'GET').toUpperCase();
    const route = url.origin === location.origin && fetchRoutes.find((r) => r.match(url, method));
    if (!route) return nativeFetch(input, init);
    await ready;
    const body = await route.handle(url, init);
    const isText = typeof body === 'string';
    return new Response(isText ? body : JSON.stringify(body), {
      headers: { 'Content-Type': isText ? 'text/html; charset=utf-8' : 'application/json' },
    });
  };

  /* ------------------------------------------------------------------ */
  /* Form submissions (the POST handlers of the controllers)             */
  /* ------------------------------------------------------------------ */

  const formHandlers = {
    // auth/app/controllers/authentication_controller.php
    'auth/index': (form, data) => {
      const user = one(
        'SELECT * FROM usuarios WHERE correo_electronico = ? COLLATE NOCASE AND contraseña = ?',
        [data.get('email'), data.get('password')],
      );
      if (!user) {
        location.href = 'index.html?page=login&error=' + encodeURIComponent('Correo o contraseña incorrectos');
        return;
      }
      session.set({ user_id: user.id, user_type: user.tipo_usuario, dni: user.dni });
      location.href = panelUrl(user.tipo_usuario);
    },

    // auth/app/controllers/registration_controller.php
    'auth/register': async (form, data) => {
      if (data.get('contraseña') !== data.get('confirm_password')) {
        location.href = 'register.html?page=register&error=' + encodeURIComponent('Las contraseñas no coinciden');
        return;
      }
      try {
        const userId = await transaction(() => insert(
          `INSERT INTO usuarios (nombres, apellidos, correo_electronico, contraseña, tipo_usuario, dni, estado)
           VALUES (?, ?, ?, ?, 'cliente', ?, 'activo')`,
          [data.get('nombres'), data.get('apellidos'), data.get('correo_electronico'), data.get('contraseña'), data.get('dni')],
        ));
        session.set({ user_id: userId, user_email: data.get('correo_electronico'), dni: data.get('dni'), logged_in: true });
        location.href = ROOT + 'projects/customer/';
      } catch {
        location.href = 'register.html?page=register&error=' + encodeURIComponent('Error en el registro');
      }
    },

    // Personal data form of the admin profile
    'projects/admin/profile': async (form, data) => {
      if (!(form.getAttribute('action') || '').includes('actualizar_datos')) return unsupported();
      try {
        await transaction(() => db.run(
          `UPDATE usuarios SET nombres = ?, apellidos = ?, direccion = ?, correo_electronico = ?, telefono = ?, telefono_adicional = ?
           WHERE dni = ?`,
          [data.get('nombres'), data.get('apellidos'), data.get('direccion'), data.get('correo_electronico'),
            data.get('telefono'), data.get('telefono_adicional'), session.get().dni],
        ));
        window.showConfirmationToast('Datos actualizados con éxito');
      } catch {
        window.showConfirmationToast('Error al actualizar los datos');
      }
    },

    // admin_controller.php
    'projects/admin/add_admin': async (form, data) => {
      try {
        await transaction(() => {
          addUser('admin', data);
          db.run('INSERT INTO admins_datos (dni, notas) VALUES (?, ?)', [data.get('dni'), data.get('notes')]);
        });
        showFormMessage(form, "<div class='alert alert-success'>Administrador registrado con éxito.</div>");
      } catch {
        showFormMessage(form, "<div class='alert alert-danger'>Hubo un error al registrar al administrador.</div>");
      }
      form.reset();
    },

    // lawyer_controller.php
    'projects/admin/add_lawyer': async (form, data) => {
      try {
        await transaction(() => {
          addUser('abogado', data);
          db.run('INSERT INTO abogados_datos (dni, cedula_colegiatura) VALUES (?, ?)', [data.get('dni'), data.get('lawyer_license')]);
        });
        showFormMessage(form, "<div class='alert alert-success'>Abogado registrado con éxito.</div>");
      } catch {
        showFormMessage(form, "<div class='alert alert-danger'>Hubo un error al registrar al abogado.</div>");
      }
      form.reset();
    },

    // plans/create_plan.php ("consultas" fills both consultation columns)
    'projects/admin/create_plan': async (form, data) => {
      const container = form.closest('.container-xxl');
      container.parentElement.querySelectorAll(':scope > [data-demo-message]').forEach((el) => el.remove());
      let message;
      try {
        await transaction(() => db.run(
          `INSERT INTO planes (nombre_plan, descripcion, precio, consultas_videollamadas, consultas_mensajes, asesorias, procedimientos)
           VALUES (?, ?, ?, ?, ?, ?, ?)`,
          [data.get('planName'), data.get('description'), data.get('price'), data.get('consultas'), data.get('consultas'),
            data.get('asesorias'), data.get('procedimientos')],
        ));
        message = '<p>Plan creado exitosamente.</p>';
      } catch (error) {
        message = '<p>Error al crear el plan: ' + h(error.message) + '</p>';
      }
      container.insertAdjacentHTML('beforebegin', message.replace('<p>', '<p data-demo-message>'));
      form.reset();
    },

    // meet_controller.php
    'projects/customer/inquiry_meet': async (form, data) => {
      const dni = session.get().dni;
      if (!dni) return showFormMessage(form, "<div class='alert alert-danger'>Error: No está autenticado.</div>");
      try {
        await transaction(() => db.run(
          `INSERT INTO servicio_consultas_videollamadas (dni_cliente, dni_abogado, asunto, fecha_servicio, hora_servicio, descripcion, estado)
           VALUES (?, ?, ?, ?, ?, ?, 'pendiente')`,
          [dni, data.get('dni_abogado'), data.get('asunto'), data.get('fecha'), data.get('hora'), data.get('descripcion')],
        ));
        showFormMessage(form, "<div class='alert alert-success'>Consulta enviada exitosamente.</div>");
      } catch {
        showFormMessage(form, "<div class='alert alert-danger'>Hubo un error al enviar la consulta.</div>");
      }
      form.reset();
    },

    // message_controller.php
    'projects/customer/inquiry_message': async (form, data) => {
      const dni = session.get().dni;
      if (!dni) return showFormMessage(form, "<div class='alert alert-danger'>Error: No está autenticado.</div>");
      try {
        await transaction(() => db.run(
          `INSERT INTO servicio_consultas_mensajes (dni_cliente, dni_abogado, asunto, mensaje, estado)
           VALUES (?, ?, ?, ?, 'pendiente')`,
          [dni, data.get('lawyer_dni'), data.get('subject'), data.get('message')],
        ));
        showFormMessage(form, "<div class='alert alert-success'>Mensaje enviado exitosamente.</div>");
      } catch {
        showFormMessage(form, "<div class='alert alert-danger'>Hubo un error al enviar el mensaje.</div>");
      }
      form.reset();
    },
  };

  // Every form that would reach the server is handled here; forms that only
  // work in the page (or GET to the same page) keep their normal behavior.
  document.addEventListener('submit', (event) => {
    const form = event.target;
    const method = (form.getAttribute('method') || 'get').toLowerCase();
    const action = form.getAttribute('action');
    if (method !== 'post' && (!action || action.startsWith('#'))) return;
    event.preventDefault();
    const data = new FormData(form);
    const handler = formHandlers[PAGE];
    ready.then(() => (handler ? handler(form, data) : unsupported()));
  }, true);

  /* ------------------------------------------------------------------ */
  /* Data-driven parts of the views                                      */
  /* ------------------------------------------------------------------ */

  function renderUserTable(role, columns, emptyText, colspan, prefix) {
    const rows = all('SELECT * FROM usuarios WHERE tipo_usuario = ?', [role]);
    const tbody = document.querySelector('table tbody');
    if (!rows.length) {
      tbody.innerHTML = `<tr><td colspan='${colspan}'>${emptyText}</td></tr>`;
      return;
    }
    tbody.innerHTML = rows.map((row, i) => `<tr>
      <td>${i + 1}</td>
      <td>${h(row.nombres)} ${h(row.apellidos)}</td>
      ${columns.map((col) => `<td>${h(row[col])}</td>`).join('')}
      <td>
        <a href='index.html?page=view_${prefix}&id=${row.id}' class='btn btn-sm btn-primary'>Ver</a>
        <a href='index.html?page=edit_${prefix}&id=${row.id}' class='btn btn-sm btn-warning'>Editar</a>
        <a href='index.html?page=suspend_${prefix}&id=${row.id}' class='btn btn-sm btn-secondary'>Suspender</a>
      </td>
    </tr>`).join('');
  }

  function renderLawyerOptions(name) {
    const select = document.querySelector(`select[name="${name}"]`);
    select.querySelectorAll('option:not([value=""])').forEach((option) => option.remove());
    select.insertAdjacentHTML('beforeend', lawyersList().map((lawyer) => `
      <option value="${lawyer.dni}">${lawyer.nombres} ${lawyer.apellidos}</option>`).join(''));
  }

  const renderers = {
    'auth/index': () => {
      // login.php: shows $_GET['error']
      const error = QUERY.get('error');
      if (error) {
        document.querySelector('#login-form .card-body > .row .col-12')
          .insertAdjacentHTML('beforeend', `<div class="alert alert-danger">${h(error)}</div>`);
      }
    },

    'projects/admin/profile': () => {
      const user = userProfile(session.get().dni);
      if (!user) return;
      document.getElementById('profileImage').src = user.imagen_perfil || '../shared/assets/img/avatars/1.png';
      const form = document.querySelector('form[action*="actualizar_datos"]');
      ['nombres', 'apellidos', 'dni', 'direccion', 'correo_electronico', 'telefono', 'telefono_adicional', 'genero']
        .forEach((field) => { form.elements[field].value = user[field] ?? ''; });
    },

    'projects/admin/admin_list': () => renderUserTable('admin', ['correo_electronico', 'telefono', 'tipo_usuario'], 'No hay administradores disponibles.', 6, 'admin'),
    'projects/admin/lawyer_list': () => renderUserTable('abogado', ['correo_electronico', 'telefono'], 'No hay abogados disponibles.', 5, 'lawyer'),
    'projects/admin/client_list': () => renderUserTable('cliente', ['correo_electronico', 'telefono', 'direccion'], 'No hay clientes disponibles.', 6, 'client'),

    'projects/customer/inquiry_meet': () => renderLawyerOptions('dni_abogado'),
    'projects/customer/inquiry_message': () => renderLawyerOptions('lawyer_dni'),

    'projects/customer/status_meet': () => {
      const meetings = all(meetingsSql("'pendiente', 'confirmada', 'en proceso'"), [session.get().dni]);
      document.querySelector('.card-body > .row').innerHTML = meetings.map((m) => `
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">${h(m.nombres + ' ' + m.apellidos)}</h5>
              <p class="card-text"><strong>Mensaje:</strong> ${h(m.mensaje)}</p>
              <p class="card-text"><strong>Fecha del servicio:</strong> ${h(m.fecha_servicio)}</p>
              <p class="card-text"><strong>Hora:</strong> ${h(m.hora_servicio)}</p>
              <p class="card-text"><strong>Estado:</strong>
                <span class="badge ${m.estado === 'pendiente' ? 'bg-warning' : 'bg-success'}">${h(ucfirst(m.estado))}</span>
              </p>
              ${m.link_videollamada
                ? `<a href="${h(m.link_videollamada)}" class="btn btn-primary" target="_blank">Ir a la videollamada</a>`
                : '<button class="btn btn-secondary" disabled>No disponible</button>'}
            </div>
          </div>
        </div>`).join('');
    },

    'projects/customer/status_message': () => {
      const messages = all(
        `SELECT m.id, m.asunto, m.mensaje, m.respuesta, m.fecha_consulta, m.estado,
                c.nombres AS client_name, a.nombres AS lawyer_name
         FROM servicio_consultas_mensajes m
         LEFT JOIN usuarios c ON m.dni_cliente = c.dni
         LEFT JOIN usuarios a ON m.dni_abogado = a.dni
         WHERE m.dni_cliente = ?`,
        [session.get().dni],
      );
      const row = document.querySelector('.card-body > .row');
      if (!messages.length) {
        row.innerHTML = `<div class="col-12">
          <div class="alert alert-info">No hay consultas registradas en este momento.</div>
        </div>`;
        return;
      }
      row.innerHTML = messages.map((m) => {
        const answered = m.estado === 'respondida';
        return `
        <div class="col-md-4 mb-4">
          <div class="card border-${answered ? 'success' : 'secondary'} h-100">
            <div class="card-body">
              <h5 class="card-title text-${answered ? 'success' : 'secondary'}">Consulta de ${h(m.client_name)}</h5>
              <p class="card-text"><strong>Fecha de consulta:</strong> ${h(m.fecha_consulta)}</p>
              <p class="card-text"><strong>Asunto:</strong> ${h(m.asunto)}</p>
              <p class="card-text"><strong>Problema Legal:</strong> ${h(m.mensaje)}</p>
              <p class="card-text"><strong>Respuesta:</strong> ${h(m.respuesta || 'No respondida aún')}</p>
              <p class="card-text"><strong>Estado:</strong>
                <span class="badge bg-${answered ? 'success' : 'warning'}">${ucfirst(m.estado)}</span>
              </p>
            </div>
          </div>
        </div>`;
      }).join('');
    },

    'projects/customer/history_meet': () => {
      const meetings = all(meetingsSql("'cancelada', 'finalizada'"), [session.get().dni]);
      document.querySelector('ul.list-group').innerHTML = meetings.map((m) => `
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Consulta: ${h(m.mensaje)}</h6>
            <p class="mb-0"><strong>Cliente:</strong> ${h(m.nombres + ' ' + m.apellidos)}</p>
            <p class="mb-0"><strong>Fecha:</strong> ${h(m.fecha_servicio)}</p>
            <p class="mb-0"><strong>Hora:</strong> ${h(m.hora_servicio)}</p>
            <p class="mb-0"><strong>Estado:</strong>
              <span class="badge ${m.estado === 'finalizada' ? 'bg-success' : 'bg-danger'}">${h(ucfirst(m.estado))}</span>
            </p>
          </div>
          ${m.link_videollamada
            ? `<a href="${h(m.link_videollamada)}" target="_blank" class="btn btn-link">Ver grabación</a>`
            : '<span class="text-muted">N/A</span>'}
        </li>`).join('');
    },
  };

  ready.then(() => {
    if (renderers[PAGE]) renderers[PAGE]();
    demoBar.mount();
  }).catch((error) => {
    console.error('ARXATEC demo: the database could not be loaded.', error);
    domReady.then(() => demoBar.mount('The demo database could not be loaded in this browser.'));
  });

  /* ------------------------------------------------------------------ */
  /* Demo bar: the only element added to the original interface          */
  /* ------------------------------------------------------------------ */

  function unsupported() {
    demoBar.notify('This action needs the original PHP backend, so it is not part of the static demo.');
  }

  function signInAs(account) {
    const user = one('SELECT * FROM usuarios WHERE correo_electronico = ? COLLATE NOCASE', [account.email]);
    if (!user) return demoBar.notify('This account no longer exists. Reset the demo data to restore it.');
    session.set({ user_id: user.id, user_type: user.tipo_usuario, dni: user.dni });
    location.href = panelUrl(user.tipo_usuario);
  }

  async function resetDemo() {
    if (!window.confirm('Reset the demo? Everything you created in this browser will be deleted.')) return;
    await storage.clear();
    session.clear();
    location.href = ROOT + 'auth/';
  }

  const BAR_STYLES = `
    :host { all: initial; }
    *, *::before, *::after { box-sizing: border-box; }
    .bar { --ink: #1c1f33; --muted: #5b6075; --line: #e3e4ee; --surface: #ffffff; --accent: #3f3ab8; --accent-ink: #ffffff;
      font: 14px/1.45 system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: var(--ink); }
    .tab { position: fixed; top: 50%; right: 0; transform: translateY(-50%); z-index: 2147483000;
      min-width: 44px; min-height: 96px; padding: 12px 10px; border: 0; border-radius: 10px 0 0 10px;
      background: var(--accent); color: var(--accent-ink); font: 600 13px/1 system-ui, sans-serif; letter-spacing: .08em;
      text-transform: uppercase; writing-mode: vertical-rl; cursor: pointer; box-shadow: -2px 4px 16px rgb(20 20 60 / .25); }
    .tab:focus-visible, button:focus-visible, a:focus-visible { outline: 3px solid #f2b705; outline-offset: 2px; }
    .panel { position: fixed; top: 16px; right: 16px; bottom: 16px; z-index: 2147483001; width: min(360px, calc(100vw - 32px));
      overflow-y: auto; padding: 20px; border-radius: 14px; background: var(--surface); border: 1px solid var(--line);
      box-shadow: 0 18px 48px rgb(20 20 60 / .28); transition: transform .22s ease, opacity .22s ease; }
    .panel[hidden] { display: block; visibility: hidden; opacity: 0; transform: translateX(24px); pointer-events: none; }
    @media (prefers-reduced-motion: reduce) { .panel { transition: none; } }
    header { display: flex; align-items: start; justify-content: space-between; gap: 12px; }
    .eyebrow { margin: 0; color: var(--accent); font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
    h2 { margin: 2px 0 0; font-size: 18px; line-height: 1.25; }
    h3 { margin: 18px 0 8px; font-size: 13px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .06em; }
    p { margin: 10px 0 0; color: var(--muted); }
    .close { min-width: 44px; min-height: 44px; border: 0; border-radius: 10px; background: #f1f1f7; color: var(--ink);
      font-size: 22px; line-height: 1; cursor: pointer; }
    ul { list-style: none; margin: 0; padding: 0; display: grid; gap: 8px; }
    .account { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 10px 12px;
      border: 1px solid var(--line); border-radius: 10px; }
    .account strong { display: block; font-size: 14px; }
    .account code { font: 12px/1.4 ui-monospace, SFMono-Regular, Consolas, monospace; color: var(--muted); word-break: break-all; }
    .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 44px; padding: 0 14px; border-radius: 10px;
      border: 1px solid var(--accent); background: var(--accent); color: var(--accent-ink); font: 600 13px/1 system-ui, sans-serif;
      text-decoration: none; cursor: pointer; white-space: nowrap; }
    .btn.secondary { background: transparent; color: var(--accent); }
    .btn.danger { border-color: #b42318; background: transparent; color: #b42318; }
    .links { display: flex; flex-wrap: wrap; gap: 8px; }
    footer { margin-top: 20px; padding-top: 14px; border-top: 1px solid var(--line); color: var(--muted); font-size: 13px; }
    footer a { color: var(--accent); font-weight: 600; }
    .toast { position: fixed; left: 50%; bottom: 20px; z-index: 2147483002; width: min(420px, calc(100vw - 32px));
      transform: translateX(-50%); padding: 12px 16px; border-radius: 10px; background: var(--ink); color: #fff;
      box-shadow: 0 10px 30px rgb(0 0 0 / .3); }
    .toast[hidden] { display: none; }
  `;

  const demoBar = {
    root: null,

    mount(errorMessage) {
      if (this.root) return;
      const host = document.createElement('arxatec-demo');
      const shadow = host.attachShadow({ mode: 'open' });
      const current = session.get();
      const signedIn = current.user_id && db
        ? one('SELECT nombres, apellidos, correo_electronico FROM usuarios WHERE id = ?', [current.user_id])
        : null;

      shadow.innerHTML = `
        <style>${BAR_STYLES}</style>
        <div class="bar">
          <button class="tab" type="button" aria-expanded="false" aria-controls="demo-panel">Demo</button>
          <aside class="panel" id="demo-panel" role="dialog" aria-modal="false" aria-labelledby="demo-title" hidden>
            <header>
              <div>
                <p class="eyebrow">ARXATEC MVP · 2024</p>
                <h2 id="demo-title">Live demo</h2>
              </div>
              <button class="close" type="button" aria-label="Close demo panel">×</button>
            </header>
            <p>${errorMessage
              ? h(errorMessage)
              : 'A static replica of the original PHP app. Everything you create is saved in a SQLite database inside your browser and never leaves your device.'}</p>
            ${signedIn ? `
              <h3>Signed in</h3>
              <div class="account">
                <span><strong>${h(signedIn.nombres + ' ' + signedIn.apellidos)}</strong><code>${h(signedIn.correo_electronico)}</code></span>
                <a class="btn secondary" href="${ROOT}auth/middleware/logout.html">Sign out</a>
              </div>` : ''}
            <h3>Demo accounts</h3>
            <ul>
              ${DEMO_ACCOUNTS.map((account, i) => `
                <li class="account">
                  <span><strong>${account.label}</strong><code>${account.email} / ${account.password}</code></span>
                  <button class="btn" type="button" data-account="${i}" ${db ? '' : 'disabled'}>Sign in</button>
                </li>`).join('')}
            </ul>
            <h3>Explore</h3>
            <div class="links">
              <a class="btn secondary" href="${ROOT}web/index.html">Public website</a>
              <a class="btn secondary" href="${ROOT}auth/">Login page</a>
              <a class="btn secondary" href="${SOURCE_URL}" target="_blank" rel="noopener">Source code</a>
              <button class="btn danger" type="button" data-reset>Reset demo data</button>
            </div>
            <footer>Built by <a href="${AUTHOR_URL}" target="_blank" rel="noopener">Yemis Paredez</a></footer>
          </aside>
          <div class="toast" role="status" aria-live="polite" hidden></div>
        </div>`;

      const tab = shadow.querySelector('.tab');
      const panel = shadow.querySelector('.panel');
      const toggle = (open, moveFocus = true) => {
        panel.hidden = !open;
        tab.setAttribute('aria-expanded', String(open));
        if (open && moveFocus) shadow.querySelector('.close').focus();
      };
      tab.addEventListener('click', () => toggle(panel.hidden));
      shadow.querySelector('.close').addEventListener('click', () => { toggle(false); tab.focus(); });
      panel.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') { toggle(false); tab.focus(); }
      });
      shadow.querySelectorAll('[data-account]').forEach((button) => {
        button.addEventListener('click', () => signInAs(DEMO_ACCOUNTS[button.dataset.account]));
      });
      shadow.querySelector('[data-reset]').addEventListener('click', resetDemo);

      document.body.appendChild(host);
      this.root = shadow;

      // Open the panel once on the first visit so the demo accounts are visible.
      let seen = true;
      try { seen = localStorage.getItem(SEEN_KEY) === '1'; localStorage.setItem(SEEN_KEY, '1'); } catch { /* private mode */ }
      if (!seen || errorMessage) toggle(true, false);
    },

    notify(message) {
      if (!this.root) return;
      const toast = this.root.querySelector('.toast');
      toast.textContent = message;
      toast.hidden = false;
      clearTimeout(this.timer);
      this.timer = setTimeout(() => { toast.hidden = true; }, 5000);
    },
  };
})();
