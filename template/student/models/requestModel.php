<?php
class RequestModel {
    public static function enrollStudent($conn, $student_id, $course_id, $section_id) {
        $timestamp = date("Y-m-d");
        $status = 0; // Assuming status 0 for "Aprobación pendiente"

        $sql = "INSERT INTO enrollment (student_id, course_id, section_id, timestamp, status)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $student_id, $course_id, $section_id, $timestamp, $status);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
}
?>