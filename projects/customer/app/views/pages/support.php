<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Centro de Soporte - ArxaTEC</h5>
                <small class="text-muted float-end">¿En qué podemos ayudarte?</small>
            </div>
            <div class="card-body">
                <form action="submit_support.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Ingresa tu número de teléfono" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje o Consulta</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Describe tu consulta" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Consulta</button>
                </form>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Preguntas Frecuentes y Soporte Reciente</h5>
                <small class="text-muted float-end">Explora soluciones a problemas comunes</small>
            </div>
            <div class="card-body">
                <div class="faq-section">
                    <h6>Consultas recientes</h6>
                    <div class="support-query">
                        <p><strong>Carlos Rodríguez:</strong> Tengo problemas con mi cuenta.</p>
                        <p><small class="text-muted">Respondido el 11/10/2024</small></p>
                        <p><strong>Respuesta:</strong> Para resolver problemas de acceso, por favor reinicia tu contraseña desde la sección "Olvidé mi contraseña".</p>
                    </div>
                    <div class="support-query">
                        <p><strong>Ana López:</strong> Quiero saber más sobre el plan premium.</p>
                        <p><small class="text-muted">Respondido el 09/10/2024</small></p>
                        <p><strong>Respuesta:</strong> El plan premium incluye soporte prioritario, acceso a funcionalidades avanzadas y mayores recursos en tu cuenta.</p>
                    </div>
                    <!-- Agrega más consultas y respuestas recientes -->
                </div>

                <div class="faq-section mt-4">
                    <h6>Preguntas Frecuentes</h6>
                    <div class="faq-item">
                        <p><strong>¿Cómo puedo recuperar mi contraseña?</strong></p>
                        <p>Para recuperar tu contraseña, dirígete a la página de inicio de sesión y selecciona "Olvidé mi contraseña". Sigue las instrucciones que recibirás por correo.</p>
                    </div>
                    <div class="faq-item">
                        <p><strong>¿Cuáles son los beneficios del plan premium?</strong></p>
                        <p>El plan premium ofrece soporte personalizado, acceso anticipado a nuevas funciones, y una mayor capacidad de almacenamiento de datos.</p>
                    </div>
                    <!-- Agrega más preguntas frecuentes -->
                </div>
            </div>
        </div>
    </div>
</div>