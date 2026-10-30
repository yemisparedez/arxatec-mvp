-- Seed data: the same rows as database/sql.txt, followed by a few sample
-- consultations so the client's status and history pages are not empty.

INSERT INTO planes (nombre_plan, descripcion, precio, consultas_videollamadas, consultas_mensajes, asesorias, procedimientos) VALUES
('Free', 'Plan gratuito con acceso limitado.', 0.00, 1, 2, 0, 0),
('Básico', 'Plan básico para clientes con acceso limitado.', 49.99, 6, 8, 0, 2),
('Premium', 'Plan premium con acceso completo a todos los servicios.', 99.99, 10, 15, 10, 10),
('Platinum', 'Plan platinum con beneficios exclusivos y atención personalizada.', 199.99, 3, 5, 5, 0);

INSERT INTO usuarios (nombres, apellidos, correo_electronico, contraseña, tipo_usuario, dni, direccion, telefono, telefono_adicional, genero, fecha_nacimiento, estado, imagen_perfil) VALUES
('Admin', 'Usuario', 'admin@gmail.com', 'admin', 'admin', 'ADMIN1234', '123 Calle Principal', '555-1234', '555-5678', 'Masculino', '1980-01-01', 'activo', '../shared/uploads/profile_images/admin/ADMIN1234.png'),
('Cliente', 'Usuario', 'cliente@gmail.com', 'cliente', 'cliente', 'CLI1234', 'Calle del Cliente', '555-0000', '555-1111', 'Masculino', '1985-05-05', 'activo', '../shared/uploads/profile_images/customer/CLI1234.png'),
('Rafael', 'Apellido', 'abogado@gmail.com', 'abogado', 'abogado', 'ABG1234', 'Calle del Abogado', '555-2222', '555-3333', 'Masculino', '1986-06-06', 'activo', '../shared/uploads/profile_images/lawyer/ABG1234.png');

INSERT INTO admins_datos (dni, notas) VALUES
('ADMIN1234', 'Administrador principal con acceso completo.');

INSERT INTO clientes_datos (dni, id_plan) VALUES
('CLI1234', 1);

INSERT INTO abogados_datos (dni, cedula_colegiatura) VALUES
('ABG1234', 'COLEGIO123');

INSERT INTO historial_compras_planes (dni_cliente, id_plan, estado) VALUES
('CLI1234', 2, 'pagado'),
('CLI1234', 3, 'pendiente'),
('CLI1234', 1, 'cancelado');

-- Demo-only sample consultations (not part of the original seed).
INSERT INTO servicio_consultas_videollamadas (dni_cliente, dni_abogado, asunto, fecha_servicio, hora_servicio, descripcion, estado, link_videollamada, mensaje) VALUES
('CLI1234', 'ABG1234', 'Revisión de contrato de alquiler', '2024-12-05', '10:00:00', 'Necesito revisar las cláusulas de mi contrato de alquiler antes de firmarlo.', 'confirmada', 'https://meet.jit.si/arxatec-mvp-demo', 'Revisaremos el contrato juntos, tenga el documento a la mano.'),
('CLI1234', 'ABG1234', 'Consulta sobre herencia', '2024-12-12', '16:30:00', 'Quiero saber cómo iniciar el trámite de sucesión intestada.', 'pendiente', NULL, 'Su solicitud está en revisión.'),
('CLI1234', 'ABG1234', 'Despido arbitrario', '2024-11-20', '09:00:00', 'Fui despedido sin carta de preaviso y quiero conocer mis derechos.', 'finalizada', NULL, 'Asesoría laboral completada.'),
('CLI1234', 'ABG1234', 'Divorcio de mutuo acuerdo', '2024-11-22', '11:00:00', 'Consulta sobre los requisitos del divorcio de mutuo acuerdo.', 'cancelada', NULL, 'Cancelada a solicitud del cliente.');

INSERT INTO servicio_consultas_mensajes (dni_cliente, dni_abogado, asunto, mensaje, respuesta, fecha_consulta, estado) VALUES
('CLI1234', 'ABG1234', 'Pensión de alimentos', '¿Cuál es el procedimiento para solicitar una pensión de alimentos?', 'Puede presentar la demanda ante el Juzgado de Paz Letrado de su distrito; le recomendamos reunir las partidas de nacimiento y sustentos de gastos.', '2024-11-25', 'respondida'),
('CLI1234', 'ABG1234', 'Constitución de empresa', '¿Qué documentos necesito para constituir una SAC?', NULL, '2024-11-27', 'pendiente');
