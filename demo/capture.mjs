// Captures the HTML that the original PHP app renders, page by page, so the
// static demo shows exactly the same interface.
//
// Requires the local Docker environment to be running (see docker/). Capture
// from a fresh database so no local test data is saved (see README.md).
// Usage: node demo/capture.mjs [baseUrl]   (default http://localhost:8090)

import { mkdir, writeFile } from 'node:fs/promises';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const BASE = (process.argv[2] ?? 'http://localhost:8090').replace(/\/$/, '');
const OUT = join(dirname(fileURLToPath(import.meta.url)), 'pages');

const PUBLIC_PAGES = {
  'auth/index.html': '/auth/',
  'auth/register.html': '/auth/index.php?page=register',
  'auth/forgot_password.html': '/auth/index.php?page=forgot_password',
  'auth/app/views/pages/legal/terms.html': '/auth/app/views/pages/legal/terms.php',
  'auth/app/views/pages/legal/privacy.html': '/auth/app/views/pages/legal/privacy.php',
  'web/index.html': '/web/index.php',
};

// Pages each panel router knows (projects/<panel>/app/views/core/router.php).
const PANELS = {
  admin: {
    login: ['admin@gmail.com', 'admin'],
    pages: ['profile', 'settings', 'subscription', 'add_admin', 'add_lawyer', 'admin_list',
      'lawyer_list', 'client_list', 'lawyer_ranking', 'create_plan'],
  },
  customer: {
    login: ['cliente@gmail.com', 'cliente'],
    pages: ['profile', 'settings', 'subscription', 'support', 'inquiry_meet', 'inquiry_message',
      'status_meet', 'status_message', 'history_meet'],
  },
  lawyer: {
    login: ['abogado@gmail.com', 'abogado'],
    pages: ['profile', 'settings', 'subscription', 'private_consult', 'public_consult',
      'verify_meet', 'contratiempo', 'support'],
  },
};

const PHP_ERROR = /<b>(Warning|Fatal error|Notice|Deprecated|Parse error)<\/b>/;

async function get(path, cookie) {
  const res = await fetch(BASE + path, { headers: cookie ? { cookie } : {}, redirect: 'manual' });
  if (res.status !== 200) throw new Error(`${path} -> HTTP ${res.status}`);
  const html = await res.text();
  if (PHP_ERROR.test(html)) throw new Error(`${path} rendered a PHP error`);
  return html;
}

async function login(email, password) {
  const res = await fetch(`${BASE}/auth/index.php`, {
    method: 'POST',
    body: new URLSearchParams({ email, password }),
    redirect: 'manual',
  });
  const cookie = res.headers.getSetCookie().map((c) => c.split(';')[0]).join('; ');
  if (res.status !== 302 || !cookie) throw new Error(`login failed for ${email}`);
  return cookie;
}

async function save(file, html) {
  const target = join(OUT, file);
  await mkdir(dirname(target), { recursive: true });
  await writeFile(target, html, 'utf8');
  console.log('captured', file);
}

for (const [file, path] of Object.entries(PUBLIC_PAGES)) {
  await save(file, await get(path));
}

for (const [panel, { login: [email, password], pages }] of Object.entries(PANELS)) {
  const cookie = await login(email, password);
  await save(`projects/${panel}/index.html`, await get(`/projects/${panel}/`, cookie));
  for (const page of pages) {
    await save(`projects/${panel}/${page}.html`, await get(`/projects/${panel}/index.php?page=${page}`, cookie));
  }
}
