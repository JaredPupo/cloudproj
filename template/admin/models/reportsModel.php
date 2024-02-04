<?php
class ReportsModel {
    public static function getTotalStudentModel($conn) {
        try {
            $query = "SELECT COUNT(DISTINCT student_id) AS total_students FROM student";
            $result = $conn->query($query);
    
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['total_students'];
            } else {
                // Manejar el error si la consulta no se ejecuta correctamente
                return false;
            }
        } catch (Exception $e) {
            // Manejar excepciones, si es necesario
            return false;
        }
    }
    
    public static function getTotalCoursesModel($conn) {
        try {
            $query = "SELECT COUNT(DISTINCT course_id) AS total_courses FROM course";
            $result = $conn->query($query);
    
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['total_courses'];
            } else {
                // Manejar el error si la consulta no se ejecuta correctamente
                return false;
            }
        } catch (Exception $e) {
            // Manejar excepciones, si es necesario
            return false;
        }
    }

    public static function getDenideStudentsModel($conn) {
        try {
            $query = "SELECT COUNT(DISTINCT student_id, course_id, section_id, status) AS denide_students FROM enrollment WHERE status = 2";
            $result = $conn->query($query);
    
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['denide_students'];
            } else {
                // Manejar el error si la consulta no se ejecuta correctamente
                return false;
            }
        } catch (Exception $e) {
            // Manejar excepciones, si es necesario
            return false;
        }
    }

    public static function getEnrolledStudentsModel($conn) {
        try {
            $query = "SELECT COUNT(DISTINCT student_id, status) AS enrolled_students FROM enrollment WHERE status = 1";
            $result = $conn->query($query);
    
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['enrolled_students'];
            } else {
                // Manejar el error si la consulta no se ejecuta correctamente
                return false;
            }
        } catch (Exception $e) {
            // Manejar excepciones, si es necesario
            return false;
        }
    }
}
?>
