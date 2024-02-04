<?php 
    $titulo = "Actualizar contrasena";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $titulo; ?></title>
        <link rel="stylesheet" href="php.css">
    </head>
    
    <body>
    	<div>
            <h1>Tema principal de la página</h1>
			<?php
                include_once"db_connect.php";
                $pass = "contra123";
                $hash = password_hash($pass, PASSWORD_DEFAULT);

                $query = "UPDATE admins
                          SET password='$hash';";
                if ($conn->query($query) === TRUE)
                {
                    echo"<h3>contrasena acutalizada correctamente.<h3>";
                }
                else
                {
                    echo "<h3>Query error: " . $conn->error . "</h3>";
                }
            ?>
    	</div> 
    </body>
</html>