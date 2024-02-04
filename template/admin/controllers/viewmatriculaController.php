<?php
session_start();

require_once '../models/viewmatriculaModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

   
        // Get the student ID from the form submission
        $student_id = $_POST['student_id'];

        // Get the enrollment details for the student
        $enrollmentDetails = VerMatriculaModel::getEnrollmentDetails($conn, $student_id);

        // Include the view to display enrollment details
        include '../views/vermatricula.php';
    
}
?>