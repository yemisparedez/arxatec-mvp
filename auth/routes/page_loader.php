<?php
// Páginas permitidas
$allowedPages = ['login', 'register', 'forgot_password'];
$page = 'login'; // Página por defecto

// Verificar si el parámetro 'page' está en la lista de páginas permitidas
if (isset($_GET['page']) && in_array($_GET['page'], $allowedPages)) {
    $page = $_GET['page'];
}

// Incluir el archivo PHP adecuado según la página seleccionada
include "app/views/pages/{$page}.php";
