<!-- courses.php -->
<?php
session_start();

require_once '../models/coursesModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'student')) {
    // La sesión no está iniciada o el usuario no tiene el rol de estudiante, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $courseController = new CourseController();

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscribir'])) {
        $course_id = $_POST['course_id'];
        $student_id = $_SESSION['user_id'];
        $courseController->enrollInCourse($conn, $student_id, $course_id);
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Número de cursos por página
    $perPage = 10;

    // Obtén el término de búsqueda si existe
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Obtén los cursos de la página actual y el total de cursos con el término de búsqueda
    list($courses, $totalCourses) = $courseController->getCoursesByPage($conn, $page, $perPage, $searchTerm);

    // Llamar a la vista y pasar los datos de los cursos
    include '../views/classes.php';
}
?>
