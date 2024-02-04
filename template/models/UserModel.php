<?php
class UserModel {
    public static function getUserByEmail($email, $pass) {
        // Conecta a la base de datos usando el archivo db_connect.php
        require_once '../db_connect.php';

        //SE UTILIZO PARA DEBUGGING
        $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

        // Verificar si el usuario es un admin
        $sql = "SELECT * FROM admins WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password']; // Obtener el hash de la contraseña desde la base de datos
            $pass = trim($pass);
            if (password_verify($pass, $hashedPassword)) {
                $user['role'] = 'admin';
                return $user;
            }
        }

        // Si no es un admin, verificar si es un estudiante
        $sql = "SELECT * FROM student WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password']; // Obtener el hash de la contraseña desde la base de datos
            $pass = trim($pass);
            if (password_verify($pass, $hashedPassword)) {
                $user['role'] = 'student';
                return $user;
            }
        }

        return null;
    }
}
?>
