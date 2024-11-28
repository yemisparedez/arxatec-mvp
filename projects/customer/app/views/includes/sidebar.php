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

        <!-- Consultas -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Consultas</span>
        </li>
        <li class="menu-item <?php echo ($page == 'inquiry_meet' || $page == 'inquiry_message') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-conversation"></i>
                <div class="text-truncate">Solicitar</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo ($page == 'inquiry_meet') ? 'active' : ''; ?>">
                    <a href="?page=inquiry_meet" class="menu-link">
                        <div class="text-truncate">Vía Videollamada</div>
                    </a>
                </li>
                <li class="menu-item <?php echo ($page == 'inquiry_message') ? 'active' : ''; ?>">
                    <a href="?page=inquiry_message" class="menu-link">
                        <div class="text-truncate">Vía Mensaje</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Verificar Meet -->
        <li class="menu-item <?php echo ($page == 'status_meet') ? 'active' : ''; ?>">
            <a href="?page=status_meet" class="menu-link">
                <i class="menu-icon tf-icons bx bx-link"></i>
                <div class="text-truncate">Acceso a Reunión</div>
            </a>
        </li>

        <!-- Verificar Mensaje -->
        <li class="menu-item <?php echo ($page == 'status_message') ? 'active' : ''; ?>">
            <a href="?page=status_message" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-rounded"></i>
                <div class="text-truncate">Respuesta</div>
            </a>
        </li>

        <!-- Historial -->
        <li class="menu-item <?php echo ($page == 'history_meet') ? 'active' : ''; ?>">
            <a href="?page=history_meet" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div class="text-truncate">Historial Meet</div>
            </a>
        </li>

        <!-- Misceláneo -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Misceláneo</span>
        </li>
        <li class="menu-item <?php echo ($page == 'support') ? 'active' : ''; ?>">
            <a href="?page=support" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div class="text-truncate" data-i18n="Support">Soporte</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->