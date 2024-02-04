<?php
session_start();

require_once '../models/requestModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'student')) {
    // La sesión no está iniciada o el usuario no tiene el rol de estudiante, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

    if (isset($_POST['inscribir'])) {
        // Handle the "inscribir" button click
        $student_id = $_SESSION['student_id'];
        $course_id = $_POST['course_id'];
        $section_id = $_POST['section_id'];

        // Call the model function to enroll the student
        if (RequestModel::enrollStudent($conn, $student_id, $course_id, $section_id)) {
            // Redirect or handle success
            header("Location: ../views/classes.php");
            exit();
        } else {
            // Handle failure
            header("Location: ../views/classes.php");
            exit();
        }
    }

    // Additional logic for displaying courses, similar to coursesController.php
    $courseController = new CourseController();
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $perPage = 10;
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    list($courses, $totalCourses) = $courseController->getCoursesByPage($conn, $page, $perPage, $searchTerm);

    include '../views/classes.php'; // Assuming you have a 'classes.php' view file
}

class CourseController {
    public function getCoursesByPage($conn, $page, $perPage, $searchTerm) {
        $courses = CoursesModel::getCoursesByPage($conn, $page, $perPage, $searchTerm);
        $totalCourses = CoursesModel::getTotalCourses($conn, $searchTerm);
        return array($courses, $totalCourses);
    }
}
?>
