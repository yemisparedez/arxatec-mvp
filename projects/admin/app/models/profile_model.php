<?php
include '../../database/connection/connect.php';

class ProfileModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getUserProfile($dni)
    {
        $sql = "SELECT nombres, apellidos, correo_electronico, dni, direccion, telefono, telefono_adicional, genero, imagen_perfil, contraseña FROM usuarios WHERE dni = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUserProfileImage($dni, $imagePath)
    {
        $sql = "UPDATE usuarios SET imagen_perfil = ? WHERE dni = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $imagePath, $dni);
        return $stmt->execute();
    }

    public function updateUserPassword($dni, $newPassword)
    {
        $sql = "UPDATE usuarios SET contraseña = ? WHERE dni = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $newPassword, $dni);
        return $stmt->execute();
    }
}
