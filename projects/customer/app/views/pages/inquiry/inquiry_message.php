<?php
include 'app/controllers/message_controller.php';

// Create an instance of the controller
$controller = new MessageController($connection);

// Handle the form submission
$message = $controller->handleMessageFormSubmission();

// Get the list of lawyers
$lawyers = $controller->getLawyersList();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Formulario de Consulta</h5>
                <small class="text-muted float-end">Solo mensaje</small>
            </div>
            <div class="card-body">
                <?php echo $message; ?>
                <form method="POST" action="">
                    <!-- Asunto de la Consulta -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-subject">Asunto</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-subject2" class="input-group-text"><i class="bx bx-book"></i></span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="basic-icon-default-subject"
                                    name="subject"
                                    placeholder="Asunto del mensaje"
                                    aria-label="Asunto del mensaje"
                                    aria-describedby="basic-icon-default-subject2"
                                    required />
                            </div>
                        </div>
                    </div>

                    <!-- Campo para la pregunta o consulta -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-message">Tu Consulta</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea
                                    id="basic-icon-default-message"
                                    name="message"
                                    class="form-control"
                                    placeholder="Escribe tu consulta aquí"
                                    aria-label="Escribe tu consulta aquí"
                                    aria-describedby="basic-icon-default-message2"
                                    required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Selección de Abogado -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-lawyer">Seleccione un Abogado</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-lawyer2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <select
                                    id="basic-icon-default-lawyer"
                                    name="lawyer_dni"
                                    class="form-control"
                                    aria-label="Seleccione un Abogado"
                                    aria-describedby="basic-icon-default-lawyer2"
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