<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="bx bx-menu bx-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search bx-md"></i>
                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Buscar..." aria-label="Buscar..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Notifications Icon -->
            <li class="nav-item dropdown dropdown-animated ms-3">
                <a class="nav-link p-1 dropdown-toggle hide-arrow" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="24" height="24" viewBox="0 0 24 24" class="iconify iconify--solar">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M18.75 9.71v-.705C18.75 5.136 15.726 2 12 2S5.25 5.136 5.25 9.005v.705a4.4 4.4 0 0 1-.692 2.375L3.45 13.81c-1.011 1.575-.239 3.716 1.52 4.214a25.8 25.8 0 0 0 14.06 0c1.759-.498 2.531-2.639 1.52-4.213l-1.108-1.725a4.4 4.4 0 0 1-.693-2.375Z"></path>
                            <path stroke-linecap="round" d="M7.5 19c.655 1.748 2.422 3 4.5 3s3.845-1.252 4.5-3M12 6v4"></path>
                        </g>
                    </svg>
                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-dropdown mt-3" aria-labelledby="notificationsDropdown">
                    <li class="p-4 dropdown-content">
                        <h5 class="mb-3">Notificaciones</h5>
                        <div class="notification-item mb-2 d-flex align-items-center">
                            <i class="bx bx-calendar bx-md me-3 text-primary"></i>
                            <div>
                                <strong>Audiencia Programada</strong>
                                <p class="mb-1">La audiencia del caso *Gómez vs. Hernández* está programada para el 25 de octubre a las 10:00 AM en la sala 3.</p>
                                <small class="text-muted">Hace 2 horas</small>
                            </div>
                        </div>
                        <div class="notification-item mb-2 d-flex align-items-center">
                            <i class="bx bx-file bx-md me-3 text-success"></i>
                            <div>
                                <strong>Nuevo Documento Cargado</strong>
                                <p class="mb-1">El cliente *Martínez & Asociados* ha subido un nuevo documento para el caso *Contrato Comercial*.</p>
                                <small class="text-muted">Hace 5 horas</small>
                            </div>
                        </div>
                        <div class="notification-item d-flex align-items-center">
                            <i class="bx bx-alarm bx-md me-3 text-warning"></i>
                            <div>
                                <strong>Recordatorio de Vencimiento</strong>
                                <p class="mb-1">El plazo para responder a la solicitud de pruebas en el caso *Lopez vs. Empresa XYZ* vence mañana.</p>
                                <small class="text-muted">Hace 1 día</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

            <!-- Messages Icon -->
            <li class="nav-item dropdown dropdown-animated ms-3">
                <a class="nav-link p-1 dropdown-toggle hide-arrow" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="24" height="24" viewBox="0 0 24 24" class="iconify iconify--solar">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M22 12c0 5.523-4.477 10-10 10H2V12C2 6.477 6.477 2 12 2s10 4.477 10 10m-15-3h9m-9 4h9m-9 4h5"></path>
                        </g>
                    </svg>
                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-dropdown mt-3" aria-labelledby="messagesDropdown">
                    <li class="p-4 dropdown-content ">
                        <h5 class="mb-3">Mensajes</h5>
                        <div class="message-item mb-2 d-flex align-items-center">
                            <img src="../shared/assets/img/avatars/2.png" alt="Consulta Legal" class="rounded-circle me-3" width="50" height="50">
                            <div>
                                <strong>Consulta Legal</strong>
                                <p class="mb-1">"Hola, necesito una consulta sobre la cláusula de confidencialidad en un contrato de trabajo. ¿Podemos agendar una llamada?"</p>
                                <small class="text-muted">Hace 3 horas</small>
                            </div>
                        </div>
                        <div class="message-item mb-2 d-flex align-items-center">
                            <img src="../shared/assets/img/avatars/3.png" alt="Respuesta del Cliente" class="rounded-circle me-3" width="50" height="50">
                            <div>
                                <strong>Respuesta del Cliente</strong>
                                <p class="mb-1">"Gracias por el análisis del caso. Estoy de acuerdo con las modificaciones propuestas. ¿Cuál sería el siguiente paso?"</p>
                                <small class="text-muted">Hace 6 horas</small>
                            </div>
                        </div>
                        <div class="message-item d-flex align-items-center">
                            <img src="../shared/assets/img/avatars/4.png" alt="Pregunta sobre Contrato" class="rounded-circle me-3" width="50" height="50">
                            <div>
                                <strong>Pregunta sobre Contrato</strong>
                                <p class="mb-1">"¿Podemos revisar la sección 5 del contrato antes de enviarlo al cliente? Creo que hay un detalle que debemos ajustar."</p>
                                <small class="text-muted">Hace 1 día</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown dropdown-animated ms-3">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-online">
                            <img src="../shared/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                    <li class="p-4 dropdown-content">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Info Cuenta</h5>
                            <div class="d-flex justify-content-center align-items-center close-button">
                                <i class="bx bx-x text-muted"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="../shared/assets/img/avatars/1.png" alt="perfil" class="rounded-circle profile-img">
                            <div class="ms-3">
                                <h5 class="mb-0">Mike Nielsen</h5>
                                <small class="text-muted">Admin</small>
                                <div class="d-flex align-items-center mt-2">
                                    <i class="bx bx-envelope me-1"></i>
                                    <small class="text-muted">info@spikeadmin.com</small>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider my-3"></div>
                        <ul class="list-unstyled">
                            <!-- Mi Perfil -->
                            <li class="mb-3">
                                <a class="d-flex align-items-center py-2 link-item" href="?page=profile" data-link="profile">
                                    <div class="icon-container profile-icon">
                                        <i class="bx bx-user text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <span class="d-block">Mi Perfil</span>
                                        <small class="text-muted">Datos personales</small>
                                    </div>
                                </a>
                            </li>
                            <!-- Configuración -->
                            <li class="mb-3">
                                <a class="d-flex align-items-center py-2 link-item" href="?page=settings" data-link="settings">
                                    <div class="icon-container notes-icon">
                                        <i class="bx bx-cog text-success"></i>
                                    </div>
                                    <div class="ms-3">
                                        <span class="d-block">Configuración</span>
                                        <small class="text-muted">Preferencias del sistema</small>
                                    </div>
                                </a>
                            </li>
                            <!-- Plan de Facturación -->
                            <li class="mb-3">
                                <a class="d-flex align-items-center py-2 link-item" href="?page=subscription" data-link="subscription">
                                    <div class="icon-container tasks-icon">
                                        <i class="bx bx-credit-card text-warning"></i>
                                    </div>
                                    <div class="ms-3">
                                        <span class="d-block">Mi Suscripción</span>
                                        <small class="text-muted">Pagos y tarifas</small>
                                    </div>
                                </a>
                            </li>
                            <!-- Cerrar Sesión -->
                            <li class="mt-4">
                                <a class="btn btn-primary d-flex align-items-center justify-content-center py-2 px-4 text-white rounded-pill" href="../../auth/middleware/logout.php">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Cerrar Sesión</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->