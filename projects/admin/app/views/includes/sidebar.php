<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../shared/assets/img/branding/logo_adjunto.png" width="50">
            </span>
            <span class="app-brand-text demo menu-text fw-bold" style="font-size: 1.5rem; line-height: 1;">
                <span style="color: rgb(166, 166, 166);">Arxa</span><span style="color: rgb(58, 53, 160);">TEC</span>
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item <?php echo ($page == 'dashboard') ? 'active open' : ''; ?>">
            <a href="?page=dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>

        <!-- Gestión de Usuarios -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Control Accesos</span>
        </li>
        <li class="menu-item <?php echo ($page == 'add_admin' || $page == 'add_lawyer') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div class="text-truncate">Miembros</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo ($page == 'add_admin') ? 'active' : ''; ?>">
                    <a href="?page=add_admin" class="menu-link">
                        <div class="text-truncate">Nuevo Admin</div>
                    </a>
                </li>
                <li class="menu-item <?php echo ($page == 'add_lawyer') ? 'active' : ''; ?>">
                    <a href="?page=add_lawyer" class="menu-link">
                        <div class="text-truncate">Nuevo Abogado</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item <?php echo ($page == 'admin_list' || $page == 'lawyer_list' || $page == 'client_list') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div class="text-truncate">Panel de Contactos</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo ($page == 'admin_list') ? 'active' : ''; ?>">
                    <a href="?page=admin_list" class="menu-link">
                        <div class="text-truncate">Administradores</div>
                    </a>
                </li>
                <li class="menu-item <?php echo ($page == 'lawyer_list') ? 'active' : ''; ?>">
                    <a href="?page=lawyer_list" class="menu-link">
                        <div class="text-truncate">Red de Abogados</div>
                    </a>
                </li>
                <li class="menu-item <?php echo ($page == 'client_list') ? 'active' : ''; ?>">
                    <a href="?page=client_list" class="menu-link">
                        <div class="text-truncate">Base de Clientes</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Estadísticas</span>
        </li>
        <li class="menu-item <?php echo ($page == 'lawyer_ranking') ? 'active open' : ''; ?>">
            <a href="?page=lawyer_ranking" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div class="text-truncate">Ranking</div>
            </a>
        </li>

        <!-- Nuevos Planes -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestión de Planes</span>
        </li>
        <li class="menu-item <?php echo ($page == 'create_plan') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div class="text-truncate">Planes</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo ($page == 'create_plan') ? 'active' : ''; ?>">
                    <a href="?page=create_plan" class="menu-link">
                        <div class="text-truncate">Crear Nuevo Plan</div>
                    </a>
                </li>
                <!-- Aquí puedes agregar más opciones de submenú si es necesario -->
            </ul>
        </li>
    </ul>
</aside>
<!-- / Menu -->