<?php
session_start();

require_once '../models/editEstuModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $editEstu = new editEstuController();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
        $action = $_POST["action"];

        switch ($action) {
            case "viewStudent":
                // Obtener el ID del estudiante
                $studentId = $_POST['student_id'];

                // Obtener la información completa del estudiante desde el modelo
                $studentInfo = $editEstu->getStudentInfoController($studentId, $conn);

                // Cargar la vista para mostrar la información completa del estudiante
                include '../views/studentView.php';
                break;

            case "updateStudent":
                // Lógica para actualizar la información del estudiante
                $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';
                error_log("Pase por el update: \n", 3, $archivoRegistro);
                $studentId = $_POST['studenId'];
                $name = $_POST['name'];
                $lastName = $_POST['last_name'];
                $email = $_POST['email'];
                $axo = $_POST['axo'];

                $result = $editEstu->updateStudentController($studentId, $name, $lastName, $email, $axo, $conn);
                $studentInfo = $editEstu->getStudentInfoController($studentId, $conn);
                include '../views/studentView.php';
                break;

            case "pass_reset":
                $studentId = $_POST['studenId'];
                $result = $editEstu->resetPasswordController($studentId, $conn);

                $studentInfo = $editEstu->getStudentInfoController($studentId, $conn);
                include '../views/studentView.php';
                break;

            default:
                header("Location: recordsController.php");
                break;
        }
    } else {
        header("Location: recordsController.php");
    }
}

class editEstuController {
    public function getStudentInfoController($studentId, $conn) {
        // Lógica para obtener la información completa del estudiante desde el modelo
        $student = StudentModel::getStudentInfoModel($studentId, $conn);
        return $student;
    }

    public function updateStudentController($studentId, $name, $lastName, $email, $axo, $conn) {
        // Lógica para obtener la información completa del estudiante desde el modelo
        $result = StudentModel::updateStudentModel($studentId, $name, $lastName, $email, $axo, $conn);
        return $result;
    }

    public function resetPasswordController($studentId, $conn) {
        // Lógica para obtener la información completa del estudiante desde el modelo
        $result = StudentModel::resetPasswordModel($studentId, $conn);
        return $result;
    }
}
?>
