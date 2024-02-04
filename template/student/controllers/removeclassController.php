<?php
session_start();

require_once '../models/removeclassModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'student')) {
    // Redirect to the login page if the user is not logged in as a student
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

    $removeClassController = new RemoveClassController();

    if (isset($_POST['eliminar'])) {
        // Get the values from the form submission
        $student_id = $_POST['student_id'];
        $course_id = $_POST['course_id'];
        $section_id = $_POST['section_id'];
        $timestamp = $_POST['timestamp'];
        $status = $_POST['status'];

        // Remove the class
        $removeClassController->removeClass($conn, $student_id, $course_id, $section_id, $timestamp, $status);
        
        // Redirect back to the classes page
        header("Location: ../views/cursosMatriculados.php");
        exit();
    } else {
        // Redirect back to the classes page if 'eliminar' is not set
        header("Location: ../views/cursosMatriculados.php");
        exit();
    }
}

class RemoveClassController {
    public function removeClass($conn, $student_id, $course_id, $section_id, $timestamp, $status) {
        RemoveClassModel::removeClass($conn, $student_id, $course_id, $section_id, $timestamp, $status);
    }
}
?>
