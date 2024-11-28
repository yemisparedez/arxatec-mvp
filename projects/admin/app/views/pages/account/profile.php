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
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Primer cuadro (Cambiar perfil) -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-start">Cambiar perfil</h5>
                                <p class="card-text text-start">Cambia tu foto de perfil desde aquí</p>
                                <!-- Contenedor de imagen con tamaño fijo -->
                                <div class="text-center mb-4" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; margin: auto;">
                                    <img id="profileImage" src="<?php echo htmlspecialchars($user['imagen_perfil']) ?: '../shared/assets/img/avatars/1.png'; ?>" alt="Avatar" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="d-flex justify-content-center mb-4">
                                    <form id="profileImageForm" enctype="multipart/form-data">
                                        <input type="file" name="profile_image" class="form-control mb-2" accept="image/jpeg, image/png, image/jpg">
                                        <button type="button" id="uploadImageBtn" class="btn btn-primary me-2">Subir</button>
                                    </form>
                                </div>
                                <small class="text-muted d-block mt-8 text-center">Se permiten archivos JPG o PNG. Tamaño máximo de 800 K</small>
                            </div>
                        </div>
                    </div>

                    <!-- Segundo cuadro (Cambiar la contraseña) -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-start">Cambiar la contraseña</h5>
                                    <p class="card-text text-start">Para cambiar su contraseña, confirme aquí</p>
                                    <form id="passwordChangeForm">
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
                                        <button type="button" id="changePasswordBtn" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <!-- Tercer cuadro (Datos personales) -->
                    <div class="col-lg-12 mb-4">
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

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" name="correo_electronico" id="email" value="<?php echo htmlspecialchars($user['correo_electronico']); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Teléfono</label>
                                            <input type="tel" class="form-control" name="telefono" id="phone" value="<?php echo htmlspecialchars($user['telefono']); ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="additional-phone" class="form-label">Teléfono adicional</label>
                                            <input type="tel" class="form-control" name="telefono_adicional" id="additional-phone" value="<?php echo htmlspecialchars($user['telefono_adicional']); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="gender" class="form-label">Género</label>
                                            <input type="text" class="form-control" name="genero" id="gender" value="<?php echo htmlspecialchars($user['genero']); ?>" readonly>
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

                <!-- Toast de confirmación -->
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="confirmationToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body" id="confirmationToastBody">
                                <!-- Este texto se actualiza dinámicamente -->
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <!-- Fin del Toast de confirmación -->

            </div>
        </div>
    </div>
</div>

<script>
    // Función para mostrar el toast de confirmación con el mensaje adecuado
    function showConfirmationToast(message) {
        document.getElementById('confirmationToastBody').innerText = message;
        var confirmationToast = new bootstrap.Toast(document.getElementById('confirmationToast'));
        confirmationToast.show();
    }

    // Función para subir la imagen de perfil mediante AJAX
    document.getElementById('uploadImageBtn').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('profileImageForm'));

        fetch('?page=profile', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Recarga la página desde el servidor con un parámetro para indicar éxito
                window.location.href = '?page=profile&image_updated=true';
            })
            .catch(error => {
                console.error('Error:', error);
                showConfirmationToast('Error al subir la imagen');
            });
    });

    // Mostrar la notificación si la imagen se actualizó correctamente
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('image_updated') === 'true') {
            showConfirmationToast('Imagen subida con éxito');
            // Quitar el parámetro de la URL para que no vuelva a mostrar el mensaje si se recarga
            history.replaceState(null, '', window.location.pathname + '?page=profile');
        }
    });

    // Función para cambiar la contraseña mediante AJAX
    document.getElementById('changePasswordBtn').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('passwordChangeForm'));

        fetch('?page=profile', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                showConfirmationToast('Contraseña actualizada con éxito');
            })
            .catch(error => {
                console.error('Error:', error);
                showConfirmationToast('Error al cambiar la contraseña');
            });
    });
</script>