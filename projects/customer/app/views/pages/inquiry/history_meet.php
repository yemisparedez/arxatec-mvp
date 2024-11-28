<?php
include 'app/controllers/meet_controller.php';

// Create a controller instance
$controller = new MeetController($connection);

// Fetch the meeting data
$meetings = $controller->getMeetingsData();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Historial de Videollamadas</h5>
                <small class="text-muted float-end">Seguimiento de videollamadas del cliente</small>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($meetings as $meeting) : ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Consulta: <?= htmlspecialchars($meeting['mensaje']) ?></h6>
                                <p class="mb-0"><strong>Cliente:</strong> <?= htmlspecialchars($meeting['nombres'] . ' ' . $meeting['apellidos']) ?></p>
                                <p class="mb-0"><strong>Fecha:</strong> <?= htmlspecialchars($meeting['fecha_servicio']) ?></p>
                                <p class="mb-0"><strong>Hora:</strong> <?= htmlspecialchars($meeting['hora_servicio']) ?></p>
                                <p class="mb-0"><strong>Estado:</strong>
                                    <span class="badge <?= $meeting['estado'] == 'finalizada' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= htmlspecialchars(ucfirst($meeting['estado'])) ?>
                                    </span>
                                </p>
                            </div>
                            <?php if (!empty($meeting['link_videollamada'])) : ?>
                                <a href="<?= htmlspecialchars($meeting['link_videollamada']) ?>" target="_blank" class="btn btn-link">Ver grabación</a>
                            <?php else : ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>