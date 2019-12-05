<?php
         session_start();
         if($_SESSION['id']==null){
            header("location: NotDataLogin.html");
            die();
         }
/*
    session_start();
    $var_usuario=$_SESSION['id'];
    if($var_usuario=="" || $var_usuario==null){
        header("location: Refuse.html");
    }*/
?>
<!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head>
<body>
    <div class="Cajita" alt="Logo">
    <link rel="stylesheet" href="Styles/Success_AU_Styles.css" />
    <img class="logo" src="Styles/Images/EasterEgg.png" />
    <form action="Conductor.php" method="post">
        <h1>Éxito Al Agregar</h1>
        <input type="submit" name="panel1"value= "Regresar a la Página Principal">
    </form>
    </div>
</body>
</html>