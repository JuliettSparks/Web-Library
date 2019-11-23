<?php
    session_start();
    if($_SESSION['id']==null){
       header("location: NotDataLogin.html");
       die();
    }
         $var_usuario=$_SESSION['id'];
         if($var_usuario=="" || $var_usuario==null){
            echo "Usted no ha iniciado una sesión";
            die();
            //header("location: index.html");
        }
        $servidor="localhost";
        $usuario="root";
        $contrasena="";
        $db="biblioteca";

        $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
        //Si no se hizo la conexion
            if(!$conexion){
            echo "Error: No se puede conectar a la DB".PHP_EOL;
            echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
            echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
            exit;
            }
            $consulta="SELECT nombre FROM asignatura ";
            $resultado=mysqli_query($conexion,$consulta);
            //$row=mysqli_fetch_array($resultado); 


?>
<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca</title>
</head>
<body>
    <form action="Alta_Libro.php" method="post">
        <h2>Alta de Libros</h2>
        <input type="text" name="titulo" placeholder="Título">
        <input type="text" name="autor" placeholder="Autor">
        <select name=asignatura>
            
            <option>Asignatura</option>
            <?php
                  while($valores = mysqli_fetch_array($resultado)){
                    echo "<option value='".$valores['nombre']."'>".$valores['nombre']."</option>";
                 }
            ?>
            
        </select>
        <input type="number" name="existA" placeholder="Existencia Presente">
        <input type="number" name="existP" placeholder="Libros Prestados">
        <input type="text" name="editorial" placeholder="Editorial">
        <input type="text" name="id_ubi" placeholder="Ubicación">
        <input type="number" name="ano" placeholder="Año de Publicación">
        <input type="number" name="volumen" placeholder="Volumen del Libro">
        <input type="submit" value="Dar de Alta el Libro">
        <a href="Main_Panel.php">Cierra la Sesión</a>
    </form>
</body>
</html>