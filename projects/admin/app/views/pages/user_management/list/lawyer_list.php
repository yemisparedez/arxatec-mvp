<?php
include 'app/controllers/lawyer_controller.php';

// Inicializar el controlador de abogados
$lawyerController = new LawyerController($connection);

// Obtener la lista de abogados
$lawyers = $lawyerController->getLawyerList();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Listado de Abogados - ArxaTEC</h5>
                <small class="text-muted float-end">Visualiza y gestiona los usuarios con rol de abogado</small>
            </div>
            <div class="card-body">
                <!-- Tabla para mostrar la lista de abogados -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Completo</th>
                                <th>Correo Electrónico</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($lawyers->num_rows > 0) {
                                $index = 1;
                                while ($row = $lawyers->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $index++ . "</td>
                                        <td>" . htmlspecialchars($row['nombres']) . " " . htmlspecialchars($row['apellidos']) . "</td>
                                        <td>" . htmlspecialchars($row['correo_electronico']) . "</td>
                                        <td>" . htmlspecialchars($row['telefono']) . "</td>
                                        <td>
                                            <a href='index.php?page=view_lawyer&id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Ver</a>
                                            <a href='index.php?page=edit_lawyer&id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Editar</a>
                                            <a href='index.php?page=suspend_lawyer&id=" . $row['id'] . "' class='btn btn-sm btn-secondary'>Suspender</a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay abogados disponibles.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>