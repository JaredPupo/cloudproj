<?php
class StudentModel {
    public static function getStudentInfoModel($studentId, $conn) {
        // Lógica para obtener la información completa del estudiante desde la base de datos
        // Utiliza $conn para la conexión a la base de datos
        // ...

        // Ejemplo de consulta (ajusta según tu base de datos):
        $query = "SELECT * FROM student WHERE student_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $studentId);
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }
    public static function updateStudentModel($studentId, $name, $lastName, $email, $axo, $conn) {
        // Lógica para actualizar la información del estudiante en la base de datos
        // Implementa la lógica para actualizar datos en la tabla 'student'
        $query = "UPDATE student SET name=?, lastName=?, email=?, year_of_study=? WHERE student_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $lastName, $email, $axo, $studentId);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public static function resetPasswordModel($studentId, $conn) {
        //logica para restablecer la contrasena del estuidante

        $hash = password_hash("password123", PASSWORD_DEFAULT);
        
        $query = "UPDATE student SET password=? WHERE student_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $hash, $studentId);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
?>
