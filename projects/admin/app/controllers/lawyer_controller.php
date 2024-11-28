<?php
include '../../database/connection/connect.php';
include 'app/models/lawyer_model.php';

class LawyerController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new LawyerModel($connection);
    }

    // Función para manejar el registro de un nuevo abogado
    public function registerLawyer($name, $surname, $email, $password, $dni, $phone, $address, $lawyerLicense)
    {
        // Intentar agregar el abogado en la tabla 'usuarios'
        $resultUser = $this->model->addLawyer($name, $surname, $email, $password, $dni, $phone, $address);

        // Si se agregó correctamente, registrar también los datos adicionales
        if ($resultUser) {
            return $this->model->addLawyerData($dni, $lawyerLicense);
        } else {
            return false;
        }
    }

    // Función para manejar la lógica del formulario de registro
    public function handleLawyerFormSubmission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dni = $_POST['dni'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $lawyerLicense = $_POST['lawyer_license'];

            // Intentar registrar el nuevo abogado
            $result = $this->registerLawyer($name, $surname, $email, $password, $dni, $phone, $address, $lawyerLicense);

            // Devolver un mensaje basado en el resultado
            if ($result) {
                return "<div class='alert alert-success'>Abogado registrado con éxito.</div>";
            } else {
                return "<div class='alert alert-danger'>Hubo un error al registrar al abogado.</div>";
            }
        }
        return "";
    }

    // Función para obtener la lista de abogados y enviarla a la vista
    public function getLawyerList()
    {
        return $this->model->getLawyerUsers();
    }
}
