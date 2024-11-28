<?php

class AuthenticationModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getUserByEmailAndPassword($email, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE correo_electronico = ? AND contraseña = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
}
