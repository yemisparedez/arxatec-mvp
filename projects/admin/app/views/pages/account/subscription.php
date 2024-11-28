<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Mi Suscripción</h5>
                <small class="text-muted float-end">Detalles de tu suscripción</small>
            </div>
            <div class="card-body">
                <form>
                    <!-- Campo para seleccionar el tipo de suscripción -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-subscription">Tipo de Suscripción</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-subscription2" class="input-group-text"><i class="bx bx-package"></i></span>
                                <select id="basic-icon-default-subscription" class="form-control">
                                    <option value="basic">Básica</option>
                                    <option value="premium">Premium</option>
                                    <option value="pro">Pro</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Campo para la duración de la suscripción -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-duration">Duración</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-duration2" class="input-group-text"><i class="bx bx-time"></i></span>
                                <select id="basic-icon-default-duration" class="form-control">
                                    <option value="1-month">1 Mes</option>
                                    <option value="6-months">6 Meses</option>
                                    <option value="1-year">1 Año</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Campo para método de pago -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-payment">Método de Pago</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-payment2" class="input-group-text"><i class="bx bx-credit-card"></i></span>
                                <select id="basic-icon-default-payment" class="form-control">
                                    <option value="credit-card">Tarjeta de Crédito</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank-transfer">Transferencia Bancaria</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Campo para activar o cancelar la suscripción -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-status">Estado de Suscripción</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-status2" class="input-group-text"><i class="bx bx-toggle-left"></i></span>
                                <select id="basic-icon-default-status" class="form-control">
                                    <option value="active">Activa</option>
                                    <option value="cancelled">Cancelada</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Guardar Cambios -->
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>