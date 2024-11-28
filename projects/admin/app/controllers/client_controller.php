<?php
include '../../database/connection/connect.php';
include 'app/models/client_model.php';

class ClientController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new ClientModel($connection);
    }

    // Función para obtener la lista de clientes y enviarla a la vista
    public function getClientList()
    {
        return $this->model->getClientUsers();
    }
}
