<body>
    <section class="py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center">
                        <div class="col-12 col-xl-9 fade-in">
                            <img class="img-fluid rounded mb-4 img-enhanced" loading="lazy" src="assets/img/nde.png" width="245" height="80" alt="Logo de BootstrapBrain">
                            <hr class="border-primary-subtle mb-4">
                            <h2 class="h1 mb-4 text-white d-none d-md-block">Resuelve tus inquietudes con asistencia jurídica personalizada.</h2>
                            <p class="lead mb-5 text-white d-none d-lg-block">Consulta con expertos, recibe asesoramiento especializado y sigue el progreso de tus procedimientos legales de manera segura y eficiente.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4" id="login-form">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3>Iniciar sesión</h3>
                                        <p>No tienes una cuenta? <a href="index.php?page=register" id="load-register">Regístrate</a></p>
                                    </div>
                                    <!-- Mostrar mensaje de error si existe -->
                                    <?php if (isset($_GET['error'])): ?>
                                        <div class="alert alert-danger">
                                            <?= htmlspecialchars($_GET['error']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <form method="POST" action="">
                                <div class="row gy-3 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="nombre@ejemplo.com" required>
                                            <label for="email" class="form-label">Correo Electrónico</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                            <label for="password" class="form-label">Contraseña</label>
                                            <i class="fas fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="toggleConfirmPassword" style="cursor: pointer; color: grey;"></i>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                                            <label class="form-check-label text-secondary" for="remember_me">
                                                Mantenerme conectado
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg" type="submit">Iniciar sesión ahora</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end mt-3">
                                        <a href="index.php?page=forgot_password">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>