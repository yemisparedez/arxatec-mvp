<?php
// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia a tu usuario de base de datos
$password = ""; // Cambia a tu contraseña de base de datos
$dbname = "arxatec";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_plan = $_POST['planName'];
    $descripcion = $_POST['description'];
    $precio = $_POST['price'];
    $consultas = $_POST['consultas'];
    $asesorias = $_POST['asesorias'];
    $procedimientos = $_POST['procedimientos'];

    // Consulta para insertar el nuevo plan
    $sql = "INSERT INTO planes (nombre_plan, descripcion, precio, consultas, asesorias, procedimientos, fecha_creacion, hora_creacion) 
            VALUES ('$nombre_plan', '$descripcion', '$precio', '$consultas', '$asesorias', '$procedimientos', CURRENT_DATE, CURRENT_TIME)";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Plan creado exitosamente.</p>";
    } else {
        echo "<p>Error al crear el plan: " . $conn->error . "</p>";
    }
}

// Cerrar la conexión
$conn->close();
?>

<div class="container-xxl">
    <div class="col-xxl">
        <div class="card mb-6 mt-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Crear Nuevo Plan - ArxaTEC</h5>
                <small class="text-muted float-end">Completa el formulario para crear un nuevo plan</small>
            </div>
            <div class="card-body">
                <form action="create_plan.php" method="POST">
                    <div class="mb-3">
                        <label for="planName" class="form-label">Nombre del Plan</label>
                        <input type="text" class="form-control" id="planName" name="planName" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="consultas" class="form-label">Consultas</label>
                        <input type="number" class="form-control" id="consultas" name="consultas" required>
                    </div>
                    <div class="mb-3">
                        <label for="asesorias" class="form-label">Asesorías</label>
                        <input type="number" class="form-control" id="asesorias" name="asesorias" required>
                    </div>
                    <div class="mb-3">
                        <label for="procedimientos" class="form-label">Procedimientos</label>
                        <input type="number" class="form-control" id="procedimientos" name="procedimientos" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Plan</button>
                </form>
            </div>
        </div>
    </div>
</div>