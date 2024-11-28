<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Perfil y Configuración</h5>
                <small class="text-muted float-end">Editar información</small>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Primer cuadro (Cambiar perfil) -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-start">Cambiar perfil</h5>
                                <p class="card-text text-start">Cambia tu foto de perfil desde aquí</p>
                                <div class="text-center mb-4">
                                    <img src="../shared/assets/img/avatars/1.png" alt="Avatar" class="img-fluid rounded-circle mb-3" width="150">
                                </div>
                                <div class="d-flex justify-content-center mb-4">
                                    <button class="btn btn-primary me-2">Subir</button>
                                    <button class="btn btn-outline-danger">Reiniciar</button>
                                </div>
                                <small class="text-muted d-block mt-8 text-center">Se permiten archivos JPG, GIF o PNG. Tamaño máximo de 800 K</small>
                            </div>
                        </div>
                    </div>

                    <!-- Segundo cuadro (Cambiar la contraseña) -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-start">Cambiar la contraseña</h5>
                                    <p class="card-text text-start">Para cambiar su contraseña por favor confirme aquí</p>
                                    <form>
                                        <div class="mb-3">
                                            <label for="current-password" class="form-label">Contraseña actual</label>
                                            <input type="password" class="form-control" id="current-password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="new-password" class="form-label">Nueva contraseña</label>
                                            <input type="password" class="form-control" id="new-password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" id="confirm-password">
                                        </div>
                                    </form>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <!-- Tercer cuadro (Datos personales) -->
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Datos personales</h5>
                                <p class="card-text">Para cambiar sus datos personales, edítelos y guárdelos desde aquí</p>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="profile-name" class="form-label">Su nombre</label>
                                            <input type="text" class="form-control" id="profile-name" value="Mike Nielsen">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="store-name" class="form-label">Nombre de la tienda</label>
                                            <input type="text" class="form-control" id="store-name" value="Maxima Studio">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="location" class="form-label">Ubicación</label>
                                            <select class="form-select" id="location">
                                                <option selected>Estados Unidos</option>
                                                <option value="1">México</option>
                                                <option value="2">Canadá</option>
                                                <option value="3">España</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="currency" class="form-label">Divisa</label>
                                            <select class="form-select" id="currency">
                                                <option selected>Dólar estadounidense ($)</option>
                                                <option value="1">Euro (€)</option>
                                                <option value="2">Peso mexicano (MX$)</option>
                                                <option value="3">Libra esterlina (£)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" id="email" value="info@modernize.com">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Teléfono</label>
                                            <input type="tel" class="form-control" id="phone" value="+9112345 65478">
                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>