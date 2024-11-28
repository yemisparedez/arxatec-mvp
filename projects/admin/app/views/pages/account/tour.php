<?php
include 'app/controllers/profile_controller.php';

// Crear una instancia del controlador
$controller = new ProfileController($connection);

// Obtener los datos del perfil del usuario logueado
$user = $controller->getLoggedUserProfile();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Perfil y Configuración</h5>
                <small class="text-muted float-end">Editar información</small>
                <!-- Botón para iniciar el tutorial -->
                <button onclick="startIntro()" class="btn btn-secondary">Iniciar Tour</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Primer cuadro (Cambiar perfil) -->
                    <div class="col-lg-6 mb-4" data-intro="Aquí puedes cambiar tu foto de perfil." data-step="1">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-start">Cambiar perfil</h5>
                                <p class="card-text text-start">Cambia tu foto de perfil desde aquí</p>
                                <div class="text-center mb-4" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; margin: auto;">
                                    <img src="<?php echo htmlspecialchars($user['imagen_perfil']) ?: '../shared/assets/img/avatars/1.png'; ?>" alt="Avatar" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="d-flex justify-content-center mb-4">
                                    <form action="?page=profile" method="post" enctype="multipart/form-data">
                                        <input type="file" name="profile_image" class="form-control mb-2" accept="image/jpeg, image/png, image/jpg">
                                        <button type="submit" name="upload_image" class="btn btn-primary me-2">Subir</button>
                                    </form>
                                </div>
                                <small class="text-muted d-block mt-8 text-center">Se permiten archivos JPG o PNG. Tamaño máximo de 800 K</small>
                            </div>
                        </div>
                    </div>

                    <!-- Segundo cuadro (Cambiar la contraseña) -->
                    <div class="col-lg-6 mb-4" data-intro="Aquí puedes cambiar tu contraseña." data-step="2">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-start">Cambiar la contraseña</h5>
                                    <p class="card-text text-start">Para cambiar su contraseña, confirme aquí</p>
                                    <form action="?page=profile" method="post">
                                        <div class="mb-3">
                                            <label for="current-password" class="form-label">Contraseña actual</label>
                                            <input type="password" class="form-control" name="current_password" id="current-password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="new-password" class="form-label">Nueva contraseña</label>
                                            <input type="password" class="form-control" name="new_password" id="new-password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm-password">
                                        </div>
                                        <button type="submit" name="change_password" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <!-- Tercer cuadro (Datos personales) -->
                    <div class="col-lg-12 mb-4" data-intro="Aquí puedes editar tus datos personales." data-step="3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Datos personales</h5>
                                <p class="card-text">Para cambiar sus datos personales, edítelos y guárdelos desde aquí</p>
                                <form action="?page=actualizar_datos" method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="profile-name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombres" id="profile-name" value="<?php echo htmlspecialchars($user['nombres']); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="profile-lastname" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos" id="profile-lastname" value="<?php echo htmlspecialchars($user['apellidos']); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="dni" class="form-label">DNI</label>
                                            <input type="text" class="form-control" name="dni" id="dni" value="<?php echo htmlspecialchars($user['dni']); ?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="location" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" id="location" value="<?php echo htmlspecialchars($user['direccion']); ?>">
                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function startIntro() {
        introJs().start();
    }
</script>

<?php
// Llamada al controlador para manejar la subida de imagen si el botón fue presionado
if (isset($_POST['upload_image'])) {
    $controller->uploadProfileImage($_FILES['profile_image']);
}

// Llamada al controlador para cambiar la contraseña
if (isset($_POST['change_password'])) {
    $controller->changePassword($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password']);
}
?>