<?php

// Función para capturar la página actual desde la URL
function getCurrentPage()
{
    return isset($_GET['page']) ? $_GET['page'] : 'dashboard';
}

// Función para renderizar la página correspondiente
function renderPage($page)
{
    switch ($page) {
            # ---------------Navbar------------------- #

            // Sección: Mi Perfil
        case 'profile':
            include 'app/views/pages/account/profile.php';
            break;

            // Sección: Mi settings
        case 'settings':
            include 'app/views/pages/account/settings.php';
            break;

            // Sección: Mi subscription
        case 'subscription':
            include 'app/views/pages/account/subscription.php';
            break;

            # ---------------Sidebar------------------- #

            //Página de Soporte
        case 'support':
            include 'app/views/pages/support.php';
            break;

            //Sección de Consultas
        case 'inquiry_meet':
            include 'app/views/pages/inquiry/inquiry_meet.php';
            break;
        case 'inquiry_message':
            include 'app/views/pages/inquiry/inquiry_message.php';
            break;
        case 'status_meet':
            include 'app/views/pages/inquiry/status_meet.php';
            break;
        case 'status_message':
            include 'app/views/pages/inquiry/status_message.php';
            break;
        case 'history_meet':
            include 'app/views/pages/inquiry/history_meet.php';
            break;

            // Página principal
        case 'dashboard':
        default:
            include 'app/views/pages/dashboard.php';
            break;
    }
}
