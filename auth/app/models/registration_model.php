<?php

class RegistrationModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function registerUser($data)
    {
        $data['tipo_usuario'] = 'cliente';

        $sql = "INSERT INTO usuarios (nombres, apellidos, correo_electronico, contraseña, tipo_usuario, dni, estado) 
                VALUES (?, ?, ?, ?, ?, ?, 'activo')";
        $stmt = $this->connection->prepare($sql);

        if (!$stmt) {
            error_log("Error en la preparación de la consulta: " . $this->connection->error);
            return false;
        }

        $stmt->bind_param(
            "ssssss",
            $data['nombres'],
            $data['apellidos'],
            $data['correo_electronico'],
            $data['contraseña'],
            $data['tipo_usuario'],
            $data['dni']
        );

        if ($stmt->execute()) {
            $userId = $this->connection->insert_id;
            $stmt->close();
            return $userId;
        } else {
            error_log("Error al ejecutar la consulta: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function checkEmailExists($email)
    {
        $sql = "SELECT * FROM usuarios WHERE correo_electronico = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    }

    public function checkDniExists($dni)
    {
        $sql = "SELECT * FROM usuarios WHERE dni = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    }
}
