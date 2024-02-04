<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Details</title>
    <!-- Include your CSS and Bootstrap if needed -->
</head>
<body>

<?php
session_start();

require_once '../models/iniciarmatriculaModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // Redirect to the login page if the user is not logged in as an admin
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

    // Check if the course_id and section_id are provided in the query parameters
    if (isset($_GET['course_id']) && isset($_GET['section_id'])) {
        $course_id = $_GET['course_id'];
        $section_id = $_GET['section_id'];

        // Get the enrollment details for the course section
        $enrollmentDetails = IniciarMatriculaModel::getEnrollmentDetails($conn, $course_id, $section_id);

        // Display the enrollment details in a table
        echo '<h1>Enrollment Details</h1>';
        echo '<table border="1">';
        echo '<thead><tr><th>Student ID</th><th>Course ID</th><th>Section ID</th><th>Timestamp</th><th>Status</th></tr></thead>';
        echo '<tbody>';
        foreach ($enrollmentDetails as $enrollment) {
            echo '<tr>';
            echo '<td>' . $enrollment['student_id'] . '</td>';
            echo '<td>' . $enrollment['course_id'] . '</td>';
            echo '<td>' . $enrollment['section_id'] . '</td>';
            echo '<td>' . $enrollment['timestamp'] . '</td>';
            echo '<td>' . getStatusText($enrollment['status']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Error: Missing course_id or section_id in the query parameters.</p>';
    }
}

function getStatusText($status) {
    switch ($status) {
        case 0:
            return 'Aprobación Pendiente...';
        case 1:
            return 'Aceptado';
        case 2:
            return 'Cancelado por cupo';
        default:
            return 'Unknown Status';
    }
}
?>

<!-- Include your JavaScript or additional HTML content here -->

</body>
</html>
