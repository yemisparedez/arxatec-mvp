<?php
include '../../database/connection/connect.php';

class ClientModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Función para obtener solo usuarios con rol de 'cliente'
    public function getClientUsers()
    {
        $sql = "SELECT * FROM usuarios WHERE tipo_usuario = 'cliente'";
        return $this->connection->query($sql);
    }
}
