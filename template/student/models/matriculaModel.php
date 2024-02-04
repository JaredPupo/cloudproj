<?php
class EnrollmentModel {
    public static function getEnrollmentsByPage($conn, $page, $perPage, $searchTerm, $student_id) {
        $offset = ($page - 1) * $perPage;
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
            WHERE student_id = '$student_id'";

        if (!empty($searchTerm)) {
            $sql .= " AND course.title LIKE '%$searchTerm%'";
        }

        $sql .= " LIMIT $perPage OFFSET $offset";

        $result = $conn->query($sql);

        if ($result) {
            $enrollments = [];
            while ($row = $result->fetch_assoc()) {
                $enrollments[] = $row;
            }
            return $enrollments;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }

    public static function getTotalEnrollments($conn, $student_id) {
        $sql = "SELECT COUNT(*) as total FROM enrollment WHERE student_id = '$student_id'";

        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
}
?>