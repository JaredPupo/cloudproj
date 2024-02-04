<?php
session_start();
// Destruye todas las variables de sesión si la sesión está iniciada
//if (session_status() == PHP_SESSION_ACTIVE) {
//    session_unset();
//    session_destroy();
//}

session_unset();
session_destroy();

// Redirige a la página de inicio de sesión o a donde desees después de cerrar sesión
header("Location: ../../");
exit();
?>
