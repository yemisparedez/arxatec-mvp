<?php
include 'app/controllers/message_controller.php';
include '../../database/connection/connect.php';

// Initialize the controller
$controller = new MessageController($connection);

// Fetch all messages
$messages = $controller->getMessagesByClient();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Consultas Legales por Mensaje</h5>
                <small class="text-muted">Seguimiento de consultas legales respondidas por mensaje</small>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if ($messages->num_rows > 0): ?>
                        <?php while ($row = $messages->fetch_assoc()): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card border-<?php echo ($row['estado'] == 'respondida') ? 'success' : 'secondary'; ?> h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-<?php echo ($row['estado'] == 'respondida') ? 'success' : 'secondary'; ?>">
                                            Consulta de <?php echo htmlspecialchars($row['client_name']); ?>
                                        </h5>
                                        <p class="card-text"><strong>Fecha de consulta:</strong> <?php echo htmlspecialchars($row['fecha_consulta']); ?></p>
                                        <p class="card-text"><strong>Asunto:</strong> <?php echo htmlspecialchars($row['asunto']); ?></p>
                                        <p class="card-text"><strong>Problema Legal:</strong> <?php echo htmlspecialchars($row['mensaje']); ?></p>
                                        <p class="card-text"><strong>Respuesta:</strong> <?php echo htmlspecialchars($row['respuesta'] ?: 'No respondida aún'); ?></p>
                                        <p class="card-text"><strong>Estado:</strong>
                                            <span class="badge bg-<?php echo ($row['estado'] == 'respondida') ? 'success' : 'warning'; ?>">
                                                <?php echo ucfirst($row['estado']); ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info">No hay consultas registradas en este momento.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>