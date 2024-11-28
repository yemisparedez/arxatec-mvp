<?php
include '../../database/connection/connect.php';
include 'app/controllers/meet_controller.php';

$meetController = new MeetController($connection);
$meetings = $meetController->getFilteredMeetingsData();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Estado de Videollamadas</h5>
                <small class="text-muted float-end">Seguimiento del estado de las videollamadas</small>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($meetings as $meeting): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($meeting['nombres'] . ' ' . $meeting['apellidos']); ?>
                                    </h5>
                                    <p class="card-text"><strong>Mensaje:</strong> <?php echo htmlspecialchars($meeting['mensaje']); ?></p>
                                    <p class="card-text"><strong>Fecha del servicio:</strong> <?php echo htmlspecialchars($meeting['fecha_servicio']); ?></p>
                                    <p class="card-text"><strong>Hora:</strong> <?php echo htmlspecialchars($meeting['hora_servicio']); ?></p>
                                    <p class="card-text"><strong>Estado:</strong>
                                        <span class="badge <?php echo $meeting['estado'] === 'pendiente' ? 'bg-warning' : 'bg-success'; ?>">
                                            <?php echo htmlspecialchars(ucfirst($meeting['estado'])); ?>
                                        </span>
                                    </p>
                                    <?php if (!empty($meeting['link_videollamada'])): ?>
                                        <a href="<?php echo htmlspecialchars($meeting['link_videollamada']); ?>" class="btn btn-primary" target="_blank">Ir a la videollamada</a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary" disabled>No disponible</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>