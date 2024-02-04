<?php
class StudentsModel {
    public static function getStudentsByPage($conn, $page, $perPage, $searchTerm) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT student_id, name, lastName, year_of_study FROM student WHERE CONCAT(name, ' ', lastName) LIKE '%$searchTerm%' LIMIT $perPage OFFSET $offset";
        $result = $conn->query($sql);
    
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
            return $students;
        } else {
            die("Error en la consulta: " . $conn->error);
        }
    }
    
    public static function getTotalStudents($conn, $searchTerm) {
        $sql = "SELECT COUNT(*) as total FROM student WHERE CONCAT(name, ' ', lastName) LIKE '%$searchTerm%'";
        $result = $conn->query($sql);
    
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            die("Error en la consulta: " . $conn->error);
        }
    }
    
    public static function insertStudentModel($conn, $nombre, $apellidoP, $email, $numero, $axo) {
        // Asigna una contraseña predefinida ("lkj")
        $password = "lkj";

        // Construye la consulta SQL para insertar el estudiante
        $sql = "INSERT INTO student (name, lastName, email, student_id, year_of_study, password) VALUES ('$nombre', '$apellidoP', '$email', '$numero', '$axo', '$password')";

        // Ejecuta la consulta
        $result = $conn->query($sql);

        // Devuelve el resultado de la inserción
        return $result;
    }
}
?>