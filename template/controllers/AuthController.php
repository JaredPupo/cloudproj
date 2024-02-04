<?php
require_once '../models/UserModel.php';

// Verifica si el formulario se ha enviado usando el método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $authController = new AuthController();
    $authController->login();
} else {
    // Si el método no es POST, redirige al usuario a la página de inicio
    header("Location: ../");
    exit();
}

class AuthController
{
    public function login()
    {
        //se utilizo para DEBUGG
        //$archivoRegistro = __DIR__ . '/archivo_de_registro.txt';
        //error_log("El rol del usuario es: " . $user['role'] . "\n", 3, $archivoRegistro);

        // Obtener los valores del form en el index.php osea el login
        $email = $_POST["email"];
        $pass = $_POST["password"];

        // llamada al model que regresa la contrasena del usuario con el email proveido.
        $user = UserModel::getUserByEmail($email, $pass);

        if ($user['role'] == "admin") {
            session_start();
            $_SESSION['role'] = 'admin';
            header("Location: ../admin/controllers/recordsController.php");
        } elseif ($user['role'] == "student") {
            session_start();
            $_SESSION['role'] = 'student';
            $_SESSION['student_id'] = $user['student_id'];
            header("Location: ../student/controllers/coursesController.php");
        } else {
            // Handle other roles or redirect to a default page
            header("Location: ../");
        }
       
        exit();
    } 
}

?>
