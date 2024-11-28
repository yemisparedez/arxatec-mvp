<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Configuración del Sistema</h5>
                <small class="text-muted float-end">Opciones de configuración</small>
            </div>
            <div class="card-body">
                <form>
                    <!-- Campo para seleccionar el idioma -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-language">Idioma</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-language2" class="input-group-text"><i class="bx bx-globe"></i></span>
                                <select id="basic-icon-default-language" class="form-control">
                                    <option value="es">Español</option>
                                    <option value="en">Inglés</option>
                                    <option value="fr">Francés</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Campo para el tema -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-theme">Tema</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-theme2" class="input-group-text"><i class="bx bx-palette"></i></span>
                                <select id="basic-icon-default-theme" class="form-control">
                                    <option value="light">Claro</option>
                                    <option value="dark">Oscuro</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Campo para habilitar notificaciones -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-notifications">Notificaciones</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-notifications2" class="input-group-text"><i class="bx bx-bell"></i></span>
                                <input type="checkbox" id="basic-icon-default-notifications" class="form-check-input" checked>
                                <label for="basic-icon-default-notifications" class="form-check-label">Habilitar notificaciones</label>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Guardar -->
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Guardar Configuración</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>