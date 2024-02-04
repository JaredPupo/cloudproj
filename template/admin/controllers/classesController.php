<?php
session_start();

require_once '../models/classesModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $classesController = new classesController();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "addCourse") {
        // Obtener los datos del formulario
        $codigo = $_POST['codigo'];
        $titulo = $_POST['titulo'];
        $creditos = $_POST['creditos'];

        // Aquí debes agregar la lógica para insertar el estudiante en la base de datos

        $result = $classesController->insertCourse($conn, $codigo, $titulo, $creditos);
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Número de estudiantes por página
    $perPage = 3;

    // Inicializar el término de búsqueda
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Obtén los estudiantes de la página actual y el total de estudiantes con el término de búsqueda
    list($classes, $totalClasses) = $classesController->getClassesByPage($conn, $page, $perPage, $searchTerm);

    // Llamar a la vista y pasar los datos de los estudiantes
    include '../views/classesView.php';
}

class classesController {
    public function getClassesByPage($conn, $page, $perPage, $searchTerm) {
        $classes = classesModel::getClassesByPage($conn, $page, $perPage, $searchTerm);
        $totalClasses = classesModel::getTotalClasses($conn, $searchTerm); // Modificar para incluir el término de búsqueda
        return array($classes, $totalClasses);
    }
    
    public function insertCourse($conn, $codigo, $titulo, $creditos) {
        $results = classesModel::insertCoursetModel($conn, $codigo, $titulo, $creditos); // Modificar para incluir el término de búsqueda
        return $results;
    }
}
?>