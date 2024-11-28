<?php
include '../../database/connection/connect.php';

class LawyerModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Función para agregar un nuevo abogado
    public function addLawyer($name, $surname, $email, $password, $dni, $phone, $address)
    {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo_electronico, contraseña, tipo_usuario, dni, telefono, direccion)
                VALUES (?, ?, ?, ?, 'abogado', ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssssss", $name, $surname, $email, $password, $dni, $phone, $address);
        return $stmt->execute();
    }

    // Función para agregar datos adicionales del abogado en abogados_datos
    public function addLawyerData($dni, $lawyerLicense)
    {
        $sql = "INSERT INTO abogados_datos (dni, cedula_colegiatura) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $dni, $lawyerLicense);
        return $stmt->execute();
    }

    // Función para obtener solo usuarios con rol de 'abogado'
    public function getLawyerUsers()
    {
        $sql = "SELECT * FROM usuarios WHERE tipo_usuario = 'abogado'";
        return $this->connection->query($sql);
    }
}
