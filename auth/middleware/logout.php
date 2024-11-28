<?php
session_start(); // Iniciar la sesión

// Destruir todas las variables de sesión
$_SESSION = array();

// Si es necesario, eliminar la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redirigir al formulario de inicio de sesión después de cerrar sesión
header("Location: ../../auth/");
exit();
