<?php
include '../../database/connection/connect.php';
include 'app/controllers/admin_controller.php';

// Crear una instancia del controlador
$controller = new AdminController($connection);

// Procesar el formulario y obtener el mensaje de resultado
$formMessage = $controller->handleAdminFormSubmission();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Registro de Nuevo Administrador - ArxaTEC</h5>
                <small class="text-muted float-end">Completa los datos para registrar un administrador</small>
            </div>
            <div class="card-body">
                <!-- Mostrar mensaje del resultado del formulario -->
                <?php if ($formMessage): ?>
                    <?= $formMessage ?>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Ingresa el apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa el correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa la contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingresa el DNI" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Ingresa el número de teléfono" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Ingresa la dirección" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notas</label>
                        <textarea class="form-control" id="notes" name="notes" placeholder="Notas adicionales sobre el administrador"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Administrador</button>
                </form>
            </div>
        </div>
    </div>
</div>