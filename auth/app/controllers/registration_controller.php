<?php
include 'app/models/registration_model.php';

class RegistrationController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new RegistrationModel($connection);
    }

    public function handleRegistrationRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['page']) && $_GET['page'] == 'register') {
            // Verificar si las contraseñas coinciden
            if ($_POST['contraseña'] !== $_POST['confirm_password']) {
                header("Location: index.php?page=register&error=Las contraseñas no coinciden");
                exit();
            }

            // Recolectar los datos del formulario
            $data = [
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'correo_electronico' => $_POST['correo_electronico'],
                'contraseña' => $_POST['contraseña'], // Sin encriptar como solicitaste
                'dni' => $_POST['dni']
            ];

            // Llamada al modelo para registrar el usuario
            $userId = $this->register($data);
            if ($userId) {
                $this->loginUser($userId, $data['correo_electronico'], $data['dni']);
                header("Location: ../projects/customer/");
                exit();
            } else {
                header("Location: index.php?page=register&error=Error en el registro");
                exit();
            }
        } elseif (isset($_GET['checkEmail'])) {
            $email = $_GET['checkEmail'];
            $exists = $this->model->checkEmailExists($email);
            echo json_encode(['email_exists' => $exists]);
            exit();
        } elseif (isset($_GET['checkDni'])) {
            $dni = $_GET['checkDni'];
            $exists = $this->model->checkDniExists($dni);
            echo json_encode(['dni_exists' => $exists]);
            exit();
        }
    }

    public function register($data)
    {
        return $this->model->registerUser($data);
    }

    private function loginUser($userId, $email, $dni)
    {
        session_start();
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_email'] = $email;
        $_SESSION['dni'] = $dni; // Guardar el DNI en la sesión
        $_SESSION['logged_in'] = true;
    }
}
