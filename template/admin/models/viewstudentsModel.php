<?php
class ViewStudentsModel {
    public static function getEnrolledStudents($conn, $course_id) {
        // Use prepared statement to prevent SQL injection
        $sql = "
            SELECT
                enrollment.student_id AS student_id,
                student.name AS name,
                student.lastName AS lastName,
                student.year_of_study AS year_of_study
            FROM
                enrollment
            JOIN
                student ON enrollment.student_id = student.student_id
            WHERE
                enrollment.course_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $enrolledStudents = $result->fetch_all(MYSQLI_ASSOC);
            return $enrolledStudents;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
}

?>