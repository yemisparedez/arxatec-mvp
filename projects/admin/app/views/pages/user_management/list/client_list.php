<?php
include 'app/controllers/client_controller.php';

// Inicializar el controlador de clientes
$clientController = new ClientController($connection);

// Obtener la lista de clientes
$clients = $clientController->getClientList();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Listado de Clientes - ArxaTEC</h5>
                <small class="text-muted float-end">Visualiza y gestiona los usuarios con rol de cliente</small>
            </div>
            <div class="card-body">
                <!-- Tabla para mostrar la lista de clientes -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Completo</th>
                                <th>Correo Electrónico</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($clients->num_rows > 0) {
                                $index = 1;
                                while ($row = $clients->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $index++ . "</td>
                                        <td>" . htmlspecialchars($row['nombres']) . " " . htmlspecialchars($row['apellidos']) . "</td>
                                        <td>" . htmlspecialchars($row['correo_electronico']) . "</td>
                                        <td>" . htmlspecialchars($row['telefono']) . "</td>
                                        <td>" . htmlspecialchars($row['direccion']) . "</td>
                                        <td>
                                            <a href='index.php?page=view_client&id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Ver</a>
                                            <a href='index.php?page=edit_client&id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Editar</a>
                                            <a href='index.php?page=suspend_client&id=" . $row['id'] . "' class='btn btn-sm btn-secondary'>Suspender</a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No hay clientes disponibles.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>