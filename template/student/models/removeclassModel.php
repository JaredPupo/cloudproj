<?php
class RemoveClassModel {
    public static function removeClass($conn, $student_id, $course_id, $section_id, $timestamp, $status) {
        $sql = "DELETE FROM enrollment WHERE student_id = ? AND course_id = ? AND section_id = ? AND timestamp = ? AND status = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $student_id, $course_id, $section_id, $timestamp, $status);
        
        if ($stmt->execute()) {
            return true;
        } else {
            die("Error in the query: " . $stmt->error);
        }
    }
}
?>
