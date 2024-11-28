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

            // Sección: Consultas
        case 'private_consult':
            include 'app/views/pages/consults/private_consult.php';
            break;
        case 'public_consult':
            include 'app/views/pages/consults/public_consult.php';
            break;

            // Sección: Reunión
        case 'verify_meet':
            include 'app/views/pages/meetings/verify_meet.php';
            break;

            // Sección: Contratiempo
        case 'contratiempo':
            include 'app/views/pages/incidents/contratiempo.php';
            break;

            // Página de Soporte
        case 'support':
            include 'app/views/pages/support.php';
            break;

            // Página principal
        case 'dashboard':
        default:
            include 'app/views/pages/dashboard.php';
            break;
    }
}
