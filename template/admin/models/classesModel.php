<?php
class classesModel {
    public static function getClassesByPage($conn, $page, $perPage, $searchTerm) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT course_id, title, credits FROM course WHERE CONCAT(course_id, ' ', title) LIKE '%$searchTerm%' LIMIT $perPage OFFSET $offset";
        $result = $conn->query($sql);
    
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
            return $students;
        } else {
            die("Error en la consulta: " . $conn->error);
        }
    }

    public static function getTotalClasses($conn, $searchTerm) {
        $sql = "SELECT COUNT(*) as total FROM course WHERE CONCAT(course_id, ' ', title) LIKE '%$searchTerm%'";
        $result = $conn->query($sql);
    
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            die("Error en la consulta: " . $conn->error);
        }
    }

    public static function insertCoursetModel($conn, $codigo, $titulo, $creditos) {

        // Construye la consulta SQL para insertar el estudiante
        $sql = "INSERT INTO course (course_id, title, credits) VALUES ('$codigo', '$titulo', '$creditos')";

        // Ejecuta la consulta
        $result = $conn->query($sql);

        // Devuelve el resultado de la inserción
        return $result;
    }
}
?>