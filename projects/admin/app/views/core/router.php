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

            // Sección de Control de Accesos
        case 'add_admin':
            include 'app/views/pages/user_management/add/add_admin.php';
            break;
        case 'add_lawyer':
            include 'app/views/pages/user_management/add/add_lawyer.php';
            break;
        case 'admin_list':
            include 'app/views/pages/user_management/list/admin_list.php';
            break;
        case 'lawyer_list':
            include 'app/views/pages/user_management/list/lawyer_list.php';
            break;
        case 'client_list':
            include 'app/views/pages/user_management/list/client_list.php';
            break;

            // Sección de Estadísticas
        case 'lawyer_ranking':
            include 'app/views/pages/statistics/lawyer_ranking.php';
            break;

            // Sección de Gestión de Planes
        case 'create_plan':
            include 'app/views/pages/plans/create_plan.php';
            break;

            // Página principal
        case 'dashboard':
        default:
            include 'app/views/pages/dashboard.php';
            break;
    }
}
