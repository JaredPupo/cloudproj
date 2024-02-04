<?php
$servername = "localhost"; // XAMPP crea el localhost
$username = "root"; // Usuario de phpMyAdmin
$password = ""; //contrasena de phpMyAdmin
$database = "4019_final_p";
/*
$servername = "136.145.29.193"; // XAMPP crea el localhost
$username = "emamarsa"; // Usuario de phpMyAdmin
$password = "ema84023"; //contrasena de phpMyAdmin
$database = "emamarsa_db"; 
*/
$conn = new mysqli($servername, $username, $password, $database); // Crear una conexión

if ($conn->connect_error) { // Si en el proceso pasa un error de coneccion
    die("Error de conexión: " . $conn->connect_error); //die es una funcion que termina el programa y printea un mensaje. el valor de connect_error es un bool.
}
?>