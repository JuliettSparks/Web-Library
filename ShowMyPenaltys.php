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

    $query="SELECT * from multas WHERE id_Persona='$user'";

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
    <?php if($data['id_Persona']==""){?>
        <h2>No se tienen Multas asignadas a este usuario</h2>
        <input type="submit" name="panel1" value="Regresar al Menú Principal" />
                <?php
            }else{
                $answer=mysqli_query($conexion,$query); ?>
                <h2>Se encontraron las Siguientes Deudas:</h2>
                <table border="1">
                <tr>
                    <td>ID del Préstamo:</td>
                    <td>ID del Usuario Solicitante:</td>
                    <td>ID del Libro:</td>
                    <td>Días de Multa:</td>
                    <td>Días Antes de Reposición Obligatoria:</td>
                    <td>Multa:</td>
            </tr>
                <?php while($data=mysqli_fetch_array($answer)){
                    $idLoan=$data['id_Prestamo_Causante'];
                    $query2="SELECT id_Prestado from prestamos WHERE id='$idLoan'";
                    $answer2=mysqli_query($conexion,$query2);
                    $dataL=mysqli_fetch_array($answer2);
                    ?>
                    <tr>
                        <td><?php echo $data['id_Prestamo_Causante']?></td>
                        <td><?php echo $data['id_Persona']?></td>
                        <td><?php echo $dataL['id_Prestado']?></td>
                        <td><?php echo $data['dias_multa']?></td>
                        <td><?php echo $data['days_repo']?> </td>
                        <td><?php echo $data['multa']?></td>
                </tr>
               <?php }?>
            </table>
            <input type="submit" name="panel1" value="Regresar al Menú Principal">
                <?php
            }
                ?>
    </form>
</body>
</html>