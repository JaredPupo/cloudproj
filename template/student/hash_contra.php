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
                $pass = "lkj";
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $query = "UPDATE student
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