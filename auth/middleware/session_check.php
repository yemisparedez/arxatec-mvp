<?php
session_start(); // Iniciar la sesión

// Desactivar caché de navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Verificar si el usuario está en la página de registro
$current_page = isset($_GET['page']) ? $_GET['page'] : '';

if (!isset($_SESSION['user_id']) && $current_page !== 'register') { // Verifica que no esté en registro
    // Redirigir al formulario de inicio de sesión si no está autenticado y no está en registro
    header("Location: ../../auth/");
    exit();
}
