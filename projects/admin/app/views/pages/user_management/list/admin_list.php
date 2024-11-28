<?php
include 'app/controllers/admin_controller.php';

// Inicializar el controlador de admin
$adminController = new AdminController($connection);

// Obtener la lista de administradores
$admins = $adminController->getAdminList();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Listado de Administradores - ArxaTEC</h5>
                <small class="text-muted float-end">Visualiza y gestiona los usuarios con rol de administrador</small>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Completo</th>
                                <th>Correo Electrónico</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($admins->num_rows > 0) {
                                $index = 1;
                                while ($row = $admins->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $index++ . "</td>
                                        <td>" . htmlspecialchars($row['nombres']) . " " . htmlspecialchars($row['apellidos']) . "</td>
                                        <td>" . htmlspecialchars($row['correo_electronico']) . "</td>
                                        <td>" . htmlspecialchars($row['telefono']) . "</td>
                                        <td>" . htmlspecialchars($row['tipo_usuario']) . "</td>
                                        <td>
                                            <a href='index.php?page=view_admin&id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Ver</a>
                                            <a href='index.php?page=edit_admin&id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Editar</a>
                                            <a href='index.php?page=suspend_admin&id=" . $row['id'] . "' class='btn btn-sm btn-secondary'>Suspender</a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No hay administradores disponibles.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>