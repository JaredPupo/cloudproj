<?php
class VerMatriculaModel {
    public static function getEnrollmentDetails($conn, $student_id) {
        // You will need to adjust this query based on your database schema
        $sql = "
            SELECT
                enrollment.student_id AS student_id,
                enrollment.course_id AS course_id,
                enrollment.section_id AS section_id,
                enrollment.timestamp AS timestamp,
                enrollment.status AS status,
                course.title AS course_title,
                section.capacity AS capacity
            FROM
                enrollment
            JOIN
                course ON enrollment.course_id = course.course_id
            JOIN
                section ON enrollment.section_id = section.section_id
            WHERE
                enrollment.student_id = $student_id";

        $result = $conn->query($sql);

        if ($result) {
            $enrollmentDetails = [];
            while ($row = $result->fetch_assoc()) {
                $enrollmentDetails[] = $row;
            }
            return $enrollmentDetails;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
}
?>
