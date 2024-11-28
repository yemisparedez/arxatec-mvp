<?php
include '../../database/connection/connect.php';
include 'app/models/profile_model.php';

class ProfileController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new ProfileModel($connection);
    }

    public function getLoggedUserProfile()
    {
        if (isset($_SESSION['dni'])) {
            $dni = $_SESSION['dni'];
            return $this->model->getUserProfile($dni);
        }
        return null;
    }

    public function uploadProfileImage($file)
    {
        if (!isset($_SESSION['dni'])) {
            return false;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 800 * 1024; // 800 KB
        if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxSize) {
            $dni = $_SESSION['dni'];
            $filename = $dni . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
            $uploadDir = '../shared/uploads/profile_images/admin/';
            $uploadPath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $imagePath = $uploadPath;
                return $this->model->updateUserProfileImage($dni, $imagePath);
            }
        }
        return false;
    }

    public function changePassword($currentPassword, $newPassword, $confirmPassword)
    {
        if (!isset($_SESSION['dni'])) {
            return false;
        }

        if ($newPassword !== $confirmPassword) {
            echo "Error: Las contraseñas no coinciden.";
            return false;
        }

        $dni = $_SESSION['dni'];
        $user = $this->model->getUserProfile($dni);

        if ($user['contraseña'] === $currentPassword) {
            return $this->model->updateUserPassword($dni, $newPassword);
        } else {
            echo "Error: La contraseña actual no es correcta.";
            return false;
        }
    }
}

// Procesamiento AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProfileController($connection);

    if (isset($_FILES['profile_image'])) {
        $controller->uploadProfileImage($_FILES['profile_image']);
        exit();
    }

    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $controller->changePassword($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password']);
        exit();
    }
}
