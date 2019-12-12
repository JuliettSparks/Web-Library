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
    
    $conexion=mysqli_connect('127.0.0.1','externo','qwerty123','biblioteca',3307);
    
    $query="SELECT * FROM solicitudes";

    $answer=mysqli_query($conexion,$query);

    $data=mysqli_fetch_array($answer);

    $iterator=1;

    if($data['id_Prestamo']==""){
    header("location: No_Request_Yet.html");
}

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
    <div class="Cajita">
        <form action="Validate_Request.php" method="post">
            <h1>Se tienen las Siguientes Solicitudes de Renovación:</h1>
            <table border="1">
            <tr>
            <td>Índice:</td>
            <td>ID Préstamo:</td>
            <td>ID Usuario:</td> 
            <td>Fecha de Solicitud:</td> 
</tr>
            <?php   $answer=mysqli_query($conexion,$query); 
                while($data=mysqli_fetch_array($answer)){?>
                    <tr>
                <td><?php echo $iterator?></td>
                <?php $iterator++;?>
                <td><?php echo $data['id_Prestamo']?></td>
                <td><?php echo $data['id_Persona']?></td>
                <td><?php echo $data['fecha']?></td>
                </tr>
                <?php
                }
            ?>
            </table>
             <label for="book">Escoja el Préstamo a Renovar</label>
            <select name="prestamo_elegido">
            <?php
                $answer=mysqli_query($conexion,$query);
                  while($valores = mysqli_fetch_array($answer)){
                    echo "<option value='".$valores['id_Prestamo']."'>".$valores['id_Prestamo']."</option>";
                 }
            ?>  
                   </select> 
                   <input type="submit" value="Aprobar Renovación" />
        </form>
    </div>
</body>
</html>