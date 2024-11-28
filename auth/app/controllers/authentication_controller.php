<?php
include 'app/models/authentication_model.php';

class AuthenticationController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new AuthenticationModel($connection);
    }

    public function handleLoginRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intentar iniciar sesión
            $loginSuccess = $this->login($email, $password);

            if (!$loginSuccess) {
                header("Location: index.php?page=login&error=Correo o contraseña incorrectos");
                exit();
            }
        }
    }

    public function login($email, $password)
    {
        $user = $this->model->getUserByEmailAndPassword($email, $password);

        if ($user) {
            // Guardar la información del usuario en la sesión
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['tipo_usuario'];
            $_SESSION['dni'] = $user['dni'];

            // Redirigir según el tipo de usuario
            switch ($user['tipo_usuario']) {
                case 'admin':
                    header("Location: ../projects/admin/");
                    exit();
                case 'abogado':
                    header("Location: ../projects/lawyer/");
                    exit();
                case 'cliente':
                    header("Location: ../projects/customer/");
                    exit();
            }
        } else {
            // Usuario no encontrado
            return false;
        }
    }
}
