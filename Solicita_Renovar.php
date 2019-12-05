<?php
                  session_start();
                  if($_SESSION['id']==null){
                     header("location: NotDataLogin.html");
                     die();
                  }
                  $user=$_SESSION['id'];
                  $servidor="localhost";
                  $usuario="root";
                  $contrasena="";
                  $db="biblioteca";
                  
                  $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
      
                  $query="SELECT * from prestamos WHERE id_Persona='$user' and dias_restantes =1";
  
                  $answer=mysqli_query($conexion,$query);
  
                  $data=mysqli_fetch_array($answer);


?>
<!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head>
<body>
    <form action="Conductor.php" method="post">
    <?php if($data['id']==""){?>
        <h2>No se tienen Registrados Préstamos para este Usuario</h2>
        <input type="submit" name="panel1" value="Regresar">
               <?php     
                }else{$answer=mysqli_query($conexion,$query); ?>
                    <h2>Se tienen los Siguientes Préstamos Registrados de este Usuario, Los cuáles son candidatos a una renovación</h2>
                <table border="1">
                <tr>
                    <td>ID del Préstamo:</td>
                    <td>ID del Usuario Solicitante:</td>
                    <td>ID del Libro Solicitado:</td>
                    <td>Fecha de Inicio del Préstamo:</td>
                    <td>Fecha del Fin de Préstamo:</td>
                    <td>Días Restantes:</td>
                    <td>Estado del Libro:</td>
            </tr>
                    <?php while($data=mysqli_fetch_array($answer)){?>
                        <tr>
                        <td><?php echo $data['id']?></td>
                        <td><?php echo $data['id_Persona']?></td>
                        <td><?php echo $data['id_Prestado']?></td>
                        <td><?php echo $data['fecha_prestado']?></td>
                        <td><?php echo $data['fecha_fin']?> </td>
                        <td><?php echo $data['dias_restantes']?></td>
                        <td><?php echo $data['status_libro']?></td>
                </tr>   
                    <?php
                    }?>
                </table>
                <label for="book">Escoja el ID del Libro deseado</label>
                <select name="loanSelected">
                <?php
                    $answer=mysqli_query($conexion,$query);
                  while($valores = mysqli_fetch_array($answer)){
                    echo "<option value='".$valores['id']."'>".$valores['id']."</option>";

                 }
            ?>    </select>
                <input type="submit" name="renovar1"value="Enviar Solicitud">
                <a href="Main_Panel.php">Regresar al Menú Principal</a>
                <?php
                }?>
    </form>
</body>
</html>