<?php
class CourseModel {
    public static function getCourseInfoModel($courseId, $conn) {
        // Lógica para obtener la información completa del estudiante desde la base de datos
        // Utiliza $conn para la conexión a la base de datos
        // ...

        // Ejemplo de consulta (ajusta según tu base de datos):
        $query = "SELECT * FROM course WHERE course_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $courseId);
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }
    public static function updateCourseModel($courseId, $title, $credits, $conn) {
        try {
            // Preparar la consulta SQL con marcadores de posición
            $sql = "UPDATE course SET title = ?, credits = ? WHERE course_id = ?";
        
            // Preparar la declaración
            $stmt = $conn->prepare($sql);
        
            // Ejecutar la consulta con los valores directamente en execute
            $stmt->execute([$title, $credits, $courseId]);
    
        } catch (mysqli_sql_exception $e) {
            echo "Error al actualizar el curso: " . $e->getMessage();
        }
    } 
    
    public static function getCourseSectionsModel($courseId, $conn) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM section WHERE course_id = ?";
    
        // Preparar la declaración
        $stmt = $conn->prepare($query);
    
        // Bind de parámetros
        $stmt->bind_param('s', $courseId);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener los resultados
        $result = $stmt->get_result();
    
        // Obtener los resultados como un array asociativo
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    
        // Liberar los recursos
        $stmt->close();
    
        // Devolver el resultado
        return $rows;
    }
    
    public static function updateSectionModel($courseId, $new_sectionId, $capacity, $old_section, $conn) {
        try {
            // Preparar la consulta SQL con marcadores de posición
            $sql = "UPDATE section SET section_id = ?, capacity = ? WHERE course_id = ? AND section_id = ?";
            
            // Preparar la declaración
            $stmt = $conn->prepare($sql);
    
            // Vincular los parámetros
            $stmt->bind_param("ssss", $new_sectionId, $capacity, $courseId, $old_section);
    
            // Ejecutar la consulta
            $stmt->execute();
            
            // Verificar si la consulta fue exitosa
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
    
        } catch (mysqli_sql_exception $e) {
            echo "Error al actualizar la sección: " . $e->getMessage();
        }
    }
    
    public static function insertSectionModel($courseId, $sectionId, $capacity, $conn) {
        try {
            // Preparar la consulta SQL con marcadores de posición
            $sql = "INSERT INTO section(course_id, section_id, capacity) VALUES (?, ?, ?)";
            
            // Preparar la declaración
            $stmt = $conn->prepare($sql);
    
            // Vincular los parámetros
            $stmt->bind_param("sss", $courseId, $sectionId, $capacity);
    
            // Ejecutar la consulta
            $stmt->execute();
            
            // Verificar si la consulta fue exitosa
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
    
        } catch (mysqli_sql_exception $e) {
            echo "Error al actualizar la sección: " . $e->getMessage();
        }
    }
}
?>
