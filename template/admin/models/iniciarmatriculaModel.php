<?php
class IniciarMatriculaModel {
    public static function iniciarMatricula($conn) {
        // Get all enrollments with status 0, ordered by year_of_study (highest first) and timestamp
        $sql = "
            SELECT *
            FROM enrollment
            WHERE status = 0
            ORDER BY
                (SELECT year_of_study FROM student WHERE student_id = enrollment.student_id) DESC,
                timestamp ASC";
        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Get the total capacity for the section
                $totalCapacity = self::getTotalCapacity($conn, $row['course_id'], $row['section_id']);

                // Get the current number of enrolled students
                $enrolledStudents = self::getTotalEnrolledStudents($conn, $row['course_id'], $row['section_id']);

                // Check if the total enrolled students exceed the total capacity
                if ($enrolledStudents < $totalCapacity) {
                    // If not, update the status to 1 (Enrolled)
                    $status = 1;
                } else {
                    // If yes, update the status to 2 (Cancelled)
                    $status = 2;
                }

                // Perform the UPDATE query
                $updateSql = "UPDATE enrollment SET status = $status WHERE student_id = '{$row['student_id']}' AND course_id = '{$row['course_id']}' AND section_id = '{$row['section_id']}'";
                $updateResult = $conn->query($updateSql);

                if (!$updateResult) {
                    die("Error in the query: " . $conn->error);
                }
            }
        } else {
            die("Error in the query: " . $conn->error);
        }
    }

    // Function to get total capacity for the section
    private static function getTotalCapacity($conn, $course_id, $section_id) {
        $sql = "SELECT capacity FROM section WHERE course_id = '$course_id' AND section_id = '$section_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['capacity'];
        } else {
            return 0;
        }
    }

    // Function to get total enrolled students
    private static function getTotalEnrolledStudents($conn, $course_id, $section_id) {
        $sql = "SELECT COUNT(*) as total FROM enrollment WHERE course_id = '$course_id' AND section_id = '$section_id' AND status = 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }
}
?>
