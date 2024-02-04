<?php
session_start();

require_once '../models/reportsModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $reports = new reportsController();

    $totalStudents = $reports->getStudentTotal($conn);
    $totalCourses = $reports->getCourseTotal($conn);
    $denideStudent = $reports->getDenideStudents($conn);
    $enrolledStudents = $reports->getEntrolledStudents($conn);
    include '../views/reportsView.php';
}

class reportsController {
    public function getStudentTotal($conn) {
        $results = ReportsModel::getTotalStudentModel($conn);
        return $results;
    }

    public function getCourseTotal($conn) {
        $results = ReportsModel::getTotalCoursesModel($conn);
        return $results;
    }

    public function getDenideStudents($conn) {
        $results = ReportsModel::getDenideStudentsModel($conn);
        return $results;
    }

    public function getEntrolledStudents($conn) {
        $results = ReportsModel::getEnrolledStudentsModel($conn);
        return $results;
    }
}
?>
