<?php
include '../../database/connection/connect.php';
include 'app/models/admin_model.php';

class AdminController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new AdminModel($connection);
    }

    // Función para manejar el registro de un nuevo administrador
    public function registerAdmin($name, $surname, $email, $password, $dni, $phone, $address, $notes)
    {
        // Intentar agregar el administrador en la tabla 'usuarios'
        $resultUser = $this->model->addAdmin($name, $surname, $email, $password, $dni, $phone, $address);

        // Si se agregó correctamente, registrar también los datos adicionales
        if ($resultUser) {
            return $this->model->addAdminData($dni, $notes);
        } else {
            return false;
        }
    }

    // Función para manejar la lógica del formulario de registro
    public function handleAdminFormSubmission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dni = $_POST['dni'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $notes = $_POST['notes'];

            // Intentar registrar el nuevo administrador
            $result = $this->registerAdmin($name, $surname, $email, $password, $dni, $phone, $address, $notes);

            // Devolver un mensaje basado en el resultado
            if ($result) {
                return "<div class='alert alert-success'>Administrador registrado con éxito.</div>";
            } else {
                return "<div class='alert alert-danger'>Hubo un error al registrar al administrador.</div>";
            }
        }
        return "";
    }
    // Función para obtener la lista de administradores desde el modelo
    public function getAdminList()
    {
        return $this->model->getAdminList();
    }
}
