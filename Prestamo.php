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
            $variable=0;
            $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
            $query="SELECT * from prestamos where id_Persona='$var_usuario' and status_libro='$variable'";
            $answer=mysqli_query($conexion,$query);
            if($data=mysqli_fetch_array($answer)){
            header("location: LoanRefuse.html");
    }
            //Si no se hizo la conexion
                if(!$conexion){
                echo "Error: No se puede conectar a la DB".PHP_EOL;
                echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
                echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
                exit;
                }
                $consulta="SELECT nombre FROM asignatura ";
                $resultado=mysqli_query($conexion,$consulta);
?>
<!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head>
<body>
    <form action="Solicita_Prestamo.php" method="post">
        <input type="text" name="titulo" placeholder="Título" />
        <input type="text" name="autor" placeholder="Autor" />
        <select name=asignatura>
            
            <option>Asignatura</option>
            <?php
                  while($valores = mysqli_fetch_array($resultado)){
                    echo "<option value='".$valores['nombre']."'>".$valores['nombre']."</option>";
                 }
            ?>
        <input type="submit" value="Solicitar">
    </form>
</body>
</html>