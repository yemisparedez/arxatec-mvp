<?php
include 'app/controllers/meet_controller.php';

// Crear instancia del controlador
$controller = new MeetController($connection);

// Manejar el envío del formulario
$message = $controller->handleMeetingFormSubmission();

// Obtener la lista de abogados
$lawyers = $controller->getLawyersList();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Formulario de Consulta</h5>
                <small class="text-muted float-end">Formulario simplificado</small>
            </div>
            <div class="card-body">
                <?php echo $message; ?>
                <form method="POST" action="">
                    <!-- Asunto de la Consulta -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-subject">Asunto de la Consulta</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-subject2" class="input-group-text"><i class="bx bx-book"></i></span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="basic-icon-default-subject"
                                    name="asunto"
                                    placeholder="Escribe el asunto"
                                    aria-label="Asunto de la consulta"
                                    aria-describedby="basic-icon-default-subject2"
                                    required />
                            </div>
                        </div>
                    </div>

                    <!-- Descripción Detallada -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-description">Descripción Detallada</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-description2" class="input-group-text"><i class="bx bx-comment-detail"></i></span>
                                <textarea
                                    id="basic-icon-default-description"
                                    name="descripcion"
                                    class="form-control"
                                    placeholder="Escribe una descripción detallada"
                                    aria-label="Descripción Detallada"
                                    aria-describedby="basic-icon-default-description2"
                                    required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Selección de Abogado -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-abogado">Seleccione un Abogado</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-abogado2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <select
                                    id="basic-icon-default-abogado"
                                    name="dni_abogado"
                                    class="form-control"
                                    aria-label="Seleccione un Abogado"
                                    aria-describedby="basic-icon-default-abogado2"
                                    required>
                                    <option value="">Seleccione un abogado</option>
                                    <?php while ($lawyer = $lawyers->fetch_assoc()): ?>
                                        <option value="<?php echo $lawyer['dni']; ?>">
                                            <?php echo $lawyer['nombres'] . ' ' . $lawyer['apellidos']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Selecciona la Fecha de la Consulta -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-date">Fecha de la Consulta</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-date2" class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input
                                    type="date"
                                    id="basic-icon-default-date"
                                    name="fecha"
                                    class="form-control"
                                    aria-label="Selecciona la Fecha de la Consulta"
                                    aria-describedby="basic-icon-default-date2"
                                    required />
                            </div>
                        </div>
                    </div>

                    <!-- Selecciona la Hora de la Consulta -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-time">Hora de la Consulta</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-time2" class="input-group-text"><i class="bx bx-time"></i></span>
                                <input
                                    type="time"
                                    id="basic-icon-default-time"
                                    name="hora"
                                    class="form-control"
                                    aria-label="Selecciona la Hora de la Consulta"
                                    aria-describedby="basic-icon-default-time2"
                                    required />
                            </div>
                        </div>
                    </div>

                    <!-- Botón Enviar -->
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>