<?php
include '../../database/connection/connect.php';
include 'app/models/meet_model.php';

class MeetController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new MeetModel($connection);
    }

    // Función para manejar el registro de una nueva consulta
    public function registerMeeting($client_dni, $lawyer_dni, $subject, $date, $time, $description)
    {
        // Intentar agregar la consulta en la tabla 'servicio_consultas_videollamadas'
        return $this->model->addMeeting($client_dni, $lawyer_dni, $subject, $date, $time, $description);
    }

    // Función para manejar la lógica del formulario de consulta
    public function handleMeetingFormSubmission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subject = $_POST['asunto'];
            $description = $_POST['descripcion'];
            $date = $_POST['fecha'];
            $time = $_POST['hora'];
            $lawyer_dni = $_POST['dni_abogado'];

            // Recuperar el DNI del cliente autenticado desde la sesión
            if (isset($_SESSION['dni'])) {
                $client_dni = $_SESSION['dni'];
            } else {
                return "<div class='alert alert-danger'>Error: No está autenticado.</div>";
            }

            // Intentar registrar la nueva consulta
            $result = $this->registerMeeting($client_dni, $lawyer_dni, $subject, $date, $time, $description);

            // Devolver un mensaje basado en el resultado
            if ($result) {
                return "<div class='alert alert-success'>Consulta enviada exitosamente.</div>";
            } else {
                return "<div class='alert alert-danger'>Hubo un error al enviar la consulta.</div>";
            }
        }
        return "";
    }

    // Función para obtener la lista de abogados desde el modelo
    public function getLawyersList()
    {
        return $this->model->getLawyersList();
    }

    public function getFilteredMeetingsData()
    {
        // Recuperar el DNI del cliente autenticado desde la sesión
        if (isset($_SESSION['dni'])) {
            $client_dni = $_SESSION['dni'];
        } else {
            return []; // O manejar el error como prefieras
        }

        $result = $this->model->getFilteredMeetings($client_dni);
        $meetings = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $meetings[] = $row;
            }
        }

        return $meetings;
    }


    public function getMeetingsData()
    {
        // Verificar si el cliente está autenticado
        if (isset($_SESSION['dni'])) {
            $client_dni = $_SESSION['dni'];
        } else {
            return []; // O manejar el error como prefieras
        }

        // Obtener las reuniones filtradas por el cliente autenticado y los estados
        $result = $this->model->getMeetings($client_dni);
        $meetings = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $meetings[] = $row;
            }
        }

        return $meetings;
    }
}
