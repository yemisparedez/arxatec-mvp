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
        <!-- Panel Principal -->
        <li class="menu-item <?php echo ($page == 'dashboard') ? 'active open' : ''; ?>">
            <a href="?page=dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>

        <!-- Áreas -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Áreas</span>
        </li>

        <!-- Consultas -->
        <li class="menu-item <?php echo ($page == 'private_consult' || $page == 'public_consult') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-conversation"></i>
                <div class="text-truncate">Aceptar Consultas</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo ($page == 'private_consult') ? 'active' : ''; ?>">
                    <a href="?page=private_consult" class="menu-link">
                        <div class="text-truncate">Privadas</div>
                    </a>
                </li>
                <li class="menu-item <?php echo ($page == 'public_consult') ? 'active' : ''; ?>">
                    <a href="?page=public_consult" class="menu-link">
                        <div class="text-truncate">Públicas</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Reunión -->
        <li class="menu-item <?php echo ($page == 'verify_meet') ? 'active' : ''; ?>">
            <a href="?page=verify_meet" class="menu-link">
                <i class="menu-icon tf-icons bx bx-link"></i>
                <div class="text-truncate">Acceso a Reunión</div>
            </a>
        </li>

        <li class="menu-item <?php echo ($page == 'contratiempo') ? 'active' : ''; ?>">
            <a href="?page=contratiempo" class="menu-link">
                <i class="menu-icon tf-icons bx bx-error"></i>
                <div class="text-truncate">Contratiempo</div>
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