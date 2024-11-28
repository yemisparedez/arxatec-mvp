<?php
// Configuración de la conexión a la base de datos
$connection = mysqli_connect("localhost", "root", "", "arxatec");

// Verificar la conexión
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
