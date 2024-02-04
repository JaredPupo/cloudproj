<?php
session_start();

require_once '../models/coursesModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'student')) {
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $courseController = new CourseController();

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Número de cursos por página
    $perPage = 10;

    // Obtén el término de búsqueda si existe
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Obtén los cursos de la página actual y el total de cursos con el término de búsqueda
    list($filteredCourses, $totalCourses) = $courseController->getCoursesByPage($conn, $page, $perPage, $searchTerm);

    // Llamar a la vista y pasar los datos de los cursos
    include '../views/classes.php';
}

class CourseController {
    public function getCoursesByPage($conn, $page, $perPage, $searchTerm) {
        $courses = CoursesModel::getCoursesByPage($conn, $page, $perPage, $searchTerm);
        $totalCourses = CoursesModel::getTotalCourses($conn, $searchTerm);

        // Define $filteredCourses here
        $filteredCourses = [];

        // Additional logic to filter courses based on enrollment
        $student_id = $_SESSION['student_id'];
        $enrolledCourses = CoursesModel::getEnrolledCourses($conn, $student_id);

        foreach ($courses as $course) {
            // Check if the course is already enrolled
            if (!in_array($course['course_id'], $enrolledCourses)) {
                $filteredCourses[] = $course;
            }
        }

        return array($filteredCourses, $totalCourses);
    }
}
?>
