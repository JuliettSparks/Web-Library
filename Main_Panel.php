<?php
     session_start();
     if($_SESSION['id']==null){
        header("location: NotDataLogin.html");
        die();
     }
     $var_usuario=$_SESSION['id'];
     if($var_usuario=="" || $var_usuario==null){
        //echo "Usted no ha iniciado una sesión";
        die();
        header("location: NotDataLogin.html");
    }
     $servidor="localhost";
     $usuario="root";
     $contrasena="";
     $db="biblioteca";
     $user=$_SESSION['id'];
     $Le_Message=$_SESSION['welcome'];
     echo $Le_Message;
     $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
     $consulta="SELECT * FROM personas WHERE id='$user'";
     $resultado= mysqli_query($conexion,$consulta);
     $Le_Info=mysqli_fetch_array($resultado);
     
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
    <form action="Conductor.php" method="post">
    <input type="submit" name="consulta1" value="Consulta de Todos los Libros">
    <input type="submit" name="consulta2" value="Consultar Libros por Autor">
        <?php
            
            if($Le_Info['puesto']=="Admin" || $Le_Info['puesto']=="Personal"){?>
                <input type="submit" name="alta1" value="Dar de Alta Libros" />
                <input type="submit" name="alta2" value="Alta Nuevo Usuario"/>
                <input type="submit" name="alta3" value="Dar de Alta Asignaturas"/>
                 <?php //Preguntar si las Asignaturas de los Libros serán fijas o no 
            }else{
                ?>
                    
                    <?php
            }
                ?>
                
                <input type="submit" name="salir" value="Cerrar Sesión">
    </form> 
    </body>
    </html>