<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ya está logueado y redirigir según el tipo de usuario
if (isset($_SESSION['user_type'])) {
    switch ($_SESSION['user_type']) {
        case 'admin':
            header("Location: ../projects/admin/");
            exit();
        case 'abogado':
            header("Location: ../projects/lawyer/");
            exit();
        case 'cliente':
            header("Location: ../projects/customer/");
            exit();
    }
}
// Incluir el controlador register
include 'app/controllers/registration_controller.php';
// Incluir el controlador login
include 'app/controllers/authentication_controller.php';
// Conexion a la base de datos
include '../database/connection/connect.php';

/* Register */
$registerController = new RegistrationController($connection);
$registerController->handleRegistrationRequest();

/* Login */
$authController = new AuthenticationController($connection);
$authController->handleLoginRequest();

?>


<?php
// Cargar el layout principal (header)
require 'app/views/includes/header.php';

// Cargar el enrutador de páginas
require 'routes/page_loader.php';
