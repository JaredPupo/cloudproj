<?php
session_start();
require_once '../db_connect.php';
require_once '../models/iniciarmatriculaModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    header("Location: ../../");
    exit();
} else {
    // Perform the matriculation process
    IniciarMatriculaModel::iniciarMatricula($conn);

    header("Location: classesController.php");
    exit();
}
?>
