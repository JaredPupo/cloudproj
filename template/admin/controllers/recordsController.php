<?php
session_start();

require_once '../models/recordsModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $recordController = new recordController();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "addStudent") {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $email = $_POST['email'];
        $numero = $_POST['numero'];
        $axo = $_POST['axo'];

        // Aquí debes agregar la lógica para insertar el estudiante en la base de datos

        $result = $recordController->insertStudent($conn, $nombre, $apellidoP, $email, $numero, $axo);
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Número de estudiantes por página
    $perPage = 3;

    // Inicializar el término de búsqueda
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Obtén los estudiantes de la página actual y el total de estudiantes con el término de búsqueda
    list($students, $totalStudents) = $recordController->getStudentsByPage($conn, $page, $perPage, $searchTerm);

    // Llamar a la vista y pasar los datos de los estudiantes
    include '../views/recordsView.php';
}

class recordController {
    public function getStudentsByPage($conn, $page, $perPage, $searchTerm) {
        $students = StudentsModel::getStudentsByPage($conn, $page, $perPage, $searchTerm);
        $totalStudents = StudentsModel::getTotalStudents($conn, $searchTerm); // Modificar para incluir el término de búsqueda
        return array($students, $totalStudents);
    }
    
    public function insertStudent($conn, $nombre, $apellidoP, $email, $numero, $axo) {
        $results = StudentsModel::insertStudentModel($conn, $nombre, $apellidoP, $email, $numero, $axo); // Modificar para incluir el término de búsqueda
        return $results;
    }
}
?>