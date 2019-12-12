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
            
            $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);

            $query="SELECT * from prestamos";

            $answer=mysqli_query($conexion,$query);

            $data=mysqli_fetch_array($answer);

            
?>
                <!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
    <link rel="stylesheet" href="Styles/ShowAllPenaltysStyles.css" />
</head>
<body>
    <div class="Cajota">
    <form action="Conductor.php" method="post">
    <?php if($data['id']==""){?>
        <h2>No existe algún libro Prestado</h2>
        <input type="submit" name="panel1" value="Regresar al Menú Principal" />
                <?php
            }else{ $answer=mysqli_query($conexion,$query); ?>
                <h1>Se encontraron los Siguientes Préstamos:</h1>
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
               <?php }?>
            </table>
            <input type="submit" name="panel1" value="Regresar al Menú Principal">
                <?php
            }
                ?>
    </form>
           </div>
</body>
</html>
