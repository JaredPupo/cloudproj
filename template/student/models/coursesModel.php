<?php
class CoursesModel {
    public static function getCoursesByPage($conn, $page, $perPage, $searchTerm) {
        $offset = ($page - 1) * $perPage;
        $sql = "
            SELECT
                course.title AS title,
                course.course_id AS course_id,
                course.credits AS credits,
                section.capacity AS capacity,
                section.section_id AS section_id
            FROM
                course
            JOIN
                section ON course.course_id = section.course_id";
    
        if (!empty($searchTerm)) {
            $sql .= " WHERE course.title LIKE '%$searchTerm%'";
        }
    
        $sql .= " LIMIT $perPage OFFSET $offset";
    
        $result = $conn->query($sql);
    
        if ($result) {
            $courses = [];
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
            return $courses;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
    public static function getEnrolledCourses($conn, $student_id) {
        $sql = "SELECT course_id FROM enrollment WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $enrolledCourses = [];
            while ($row = $result->fetch_assoc()) {
                $enrolledCourses[] = $row['course_id'];
            }
            return $enrolledCourses;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
    public static function isCourseEnrolled($conn, $student_id, $course_id, $section_id) {
        $sql = "SELECT COUNT(*) as count FROM enrollment WHERE student_id = ? AND course_id = ? AND section_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $student_id, $course_id, $section_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
        
    public static function getTotalCourses($conn) {
        $sql = "SELECT COUNT(*) as total FROM course";
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