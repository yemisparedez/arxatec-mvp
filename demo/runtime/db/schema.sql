-- SQLite translation of database/sql.txt (MySQL/MariaDB).
-- Same tables, columns and constraints; ENUM columns become CHECK constraints
-- and MySQL date/time defaults use SQLite's local date/time functions.

PRAGMA foreign_keys = ON;

CREATE TABLE planes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre_plan VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    consultas_videollamadas INTEGER NOT NULL,
    consultas_mensajes INTEGER NOT NULL,
    asesorias INTEGER NOT NULL,
    procedimientos INTEGER NOT NULL,
    fecha_creacion DATE DEFAULT (date('now', 'localtime')),
    hora_creacion TIME DEFAULT (time('now', 'localtime'))
);

CREATE TABLE usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    tipo_usuario TEXT NOT NULL CHECK (tipo_usuario IN ('admin', 'cliente', 'abogado')),
    imagen_perfil VARCHAR(255),
    dni VARCHAR(20) UNIQUE NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    telefono_adicional VARCHAR(20),
    genero TEXT CHECK (genero IN ('Masculino', 'Femenino', 'Otro', 'Ninguno')),
    fecha_nacimiento DATE,
    estado TEXT NOT NULL DEFAULT 'activo' CHECK (estado IN ('activo', 'suspendido')),
    fecha_hora_creacion TIMESTAMP DEFAULT (datetime('now', 'localtime'))
);

CREATE TABLE abogados_datos (
    dni VARCHAR(20) PRIMARY KEY,
    cedula_colegiatura VARCHAR(50) NOT NULL,
    FOREIGN KEY (dni) REFERENCES usuarios(dni) ON DELETE CASCADE
);

CREATE TABLE clientes_datos (
    dni VARCHAR(20) PRIMARY KEY,
    id_plan INTEGER NOT NULL,
    FOREIGN KEY (dni) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (id_plan) REFERENCES planes(id)
);

CREATE TABLE admins_datos (
    dni VARCHAR(20) PRIMARY KEY,
    notas TEXT,
    FOREIGN KEY (dni) REFERENCES usuarios(dni) ON DELETE CASCADE
);

CREATE TABLE clientes_servicios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dni VARCHAR(20) NOT NULL,
    consultas_videollamadas_disponibles INTEGER NOT NULL,
    consultas_mensajes_disponibles INTEGER NOT NULL,
    asesorias_disponibles INTEGER NOT NULL,
    procedimientos_disponibles INTEGER NOT NULL,
    FOREIGN KEY (dni) REFERENCES usuarios(dni) ON DELETE CASCADE
);

CREATE TABLE servicio_consultas_videollamadas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dni_cliente VARCHAR(20) NOT NULL,
    dni_abogado VARCHAR(20) NULL,
    asunto VARCHAR(255) NOT NULL,
    fecha_servicio DATE NOT NULL,
    hora_servicio TIME NOT NULL,
    descripcion TEXT NOT NULL,
    tipo_consulta TEXT NOT NULL DEFAULT 'publico' CHECK (tipo_consulta IN ('publico', 'privado', 'propio')),
    estado TEXT NOT NULL DEFAULT 'pendiente'
        CHECK (estado IN ('confirmada', 'pendiente', 'cancelada', 'en proceso', 'finalizada')),
    fecha_creacion DATE DEFAULT (date('now', 'localtime')),
    hora_creacion TIME DEFAULT (time('now', 'localtime')),
    link_videollamada VARCHAR(255),
    mensaje TEXT,
    FOREIGN KEY (dni_cliente) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (dni_abogado) REFERENCES usuarios(dni) ON DELETE CASCADE
);

CREATE TABLE servicio_consultas_mensajes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dni_cliente VARCHAR(20) NOT NULL,
    dni_abogado VARCHAR(20) NULL,
    asunto VARCHAR(255) NOT NULL,
    mensaje TEXT NOT NULL,
    respuesta TEXT,
    fecha_consulta DATE NOT NULL DEFAULT (date('now', 'localtime')),
    hora_consulta TIME NOT NULL DEFAULT (time('now', 'localtime')),
    estado TEXT NOT NULL DEFAULT 'pendiente' CHECK (estado IN ('pendiente', 'respondida', 'finalizada')),
    fecha_creacion DATE DEFAULT (date('now', 'localtime')),
    hora_creacion TIME DEFAULT (time('now', 'localtime')),
    FOREIGN KEY (dni_cliente) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (dni_abogado) REFERENCES usuarios(dni) ON DELETE CASCADE
);

CREATE TABLE historial_compras_planes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dni_cliente VARCHAR(20) NOT NULL,
    id_plan INTEGER NOT NULL,
    fecha_compra DATE NOT NULL DEFAULT (date('now', 'localtime')),
    estado TEXT NOT NULL DEFAULT 'pagado' CHECK (estado IN ('pagado', 'pendiente', 'cancelado', 'reembolsado')),
    FOREIGN KEY (dni_cliente) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (id_plan) REFERENCES planes(id)
);
