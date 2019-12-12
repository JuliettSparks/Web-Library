<?php
    session_start();
         if($_SESSION['id']==null){
            header("location: NotDataLogin.html");
            die();
         }
    $servidor="localhost";
    $usuario="root";
    $contrasena="";
    $db="biblioteca";

    $LeID=$_POST['book'];
    $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);

    $_SESSION['Modify']=$LeID;

    $query="SELECT nombre,existencia_t from libros where id='$LeID'";

    $answer=mysqli_query($conexion,$query);

    $data=mysqli_fetch_array($answer);

?>
<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Styles/Pre_Apply_Worker_Styles.css" />
    <title>Hotel</title>
</head>
<body>
    <div class="Cajita" alt="Logo">
        <img class="logo" src="Styles/Images/EasterEgg.png" />
        <form action="Apply_To_Database_W.php" method="post">
            <h1><?php echo "Del Libro ".$data['nombre'].", Se tienen: ".$data['existencia_t']." Ejemplares" ?> </h1>
            <label for="cant">Monto a Añadir</label>
            <input type="number" name="cant" />
            <input type="submit" value="Actualizar" />
        </form>
    </div>
</body>
</html>
