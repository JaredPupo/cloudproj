<?php
session_start();

require_once '../models/viewstudentsModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

        // Get the course ID from the form submission
        $course_id = $_POST['course_id'];

        // Get the students enrolled in the course
        $enrolledStudents = ViewStudentsModel::getEnrolledStudents($conn, $course_id);

        // Include the view to display enrolled students
        include '../views/viewstudents.php';

}

?>
