<?php
// Incluir la configuración de conexión
include '../../database/connection/connect.php';

class AdminModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Función para agregar un nuevo administrador
    public function addAdmin($name, $surname, $email, $password, $dni, $phone, $address)
    {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo_electronico, contraseña, tipo_usuario, dni, telefono, direccion)
                VALUES (?, ?, ?, ?, 'admin', ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssssss", $name, $surname, $email, $password, $dni, $phone, $address);
        return $stmt->execute();
    }

    // Función para agregar datos adicionales del administrador en admins_datos
    public function addAdminData($dni, $notes)
    {
        $sql = "INSERT INTO admins_datos (dni, notas) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $dni, $notes);
        return $stmt->execute();
    }
    // Función para obtener la lista de administradores
    public function getAdminList()
    {
        $sql = "SELECT * FROM usuarios WHERE tipo_usuario = 'admin'";
        $result = $this->connection->query($sql);
        return $result;
    }
}
