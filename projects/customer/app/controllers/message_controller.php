<?php
include '../../database/connection/connect.php';
include 'app/models/message_model.php';

class MessageController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new MessageModel($connection);
    }

    // Function to handle the registration of a new message
    public function registerMessage($client_dni, $lawyer_dni, $subject, $message)
    {
        return $this->model->addMessage($client_dni, $lawyer_dni, $subject, $message);
    }

    // Function to handle the message form submission
    public function handleMessageFormSubmission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $lawyer_dni = $_POST['lawyer_dni'];
            // Recuperar el DNI del cliente autenticado desde la sesión
            if (isset($_SESSION['dni'])) {
                $client_dni = $_SESSION['dni'];
            } else {
                return "<div class='alert alert-danger'>Error: No está autenticado.</div>";
            }

            $result = $this->registerMessage($client_dni, $lawyer_dni, $subject, $message);

            if ($result) {
                return "<div class='alert alert-success'>Mensaje enviado exitosamente.</div>";
            } else {
                return "<div class='alert alert-danger'>Hubo un error al enviar el mensaje.</div>";
            }
        }
        return "";
    }

    // Function to get the list of lawyers from the model
    public function getLawyersList()
    {
        return $this->model->getLawyersList();
    }

    // Función para obtener los mensajes del cliente autenticado
    public function getMessagesByClient()
    {
        // Recuperar el DNI del cliente autenticado desde la sesión
        if (isset($_SESSION['dni'])) {
            $client_dni = $_SESSION['dni'];
        } else {
            return []; // O manejar el error como prefieras
        }

        return $this->model->getMessagesByClientDni($client_dni);
    }
}
