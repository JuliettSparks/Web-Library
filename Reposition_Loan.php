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

    $variable=0;
    $query="SELECT * from prestamos where id_Persona='$user' and status_libro='$variable'";

    $answer=mysqli_query($conexion,$query);

    if(!$data=mysqli_fetch_array($answer)){
        header("location: No_Repo_Obligatory.html");
    }
    $iterator=1;
?>
<!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head>
<body>
    <form action="AcceptRepo_byUserVersion.php" method="post">
        <h2>Se encontraron los siguientes préstamos, los cuales se deben de reponer</h2>
    <table border="1">
        <tr>
            <td>Índice:</td>
            <td>ID del Préstamo:</td> 
            <td>Usuario:</td> 
            <td>ID del Libro Prestado:</td>
            <td>Título del Libro:</td>
            <td>Fecha Inicial del Préstamo:</td> 
            <td>Fecha Final del Préstamo:</td> 
            <td>Días Restantes:</td>
            <?php
                $answer=mysqli_query($conexion,$query);
                while($datas=mysqli_fetch_array($answer)){
                $LeBook=$datas['id_Prestado'];
                $query2="SELECT nombre from libros where id='$LeBook'";
                $answer2=mysqli_query($conexion,$query2);
                $dataB=mysqli_fetch_array($answer2);
            ?>
                <tr>
                <td><?php echo $iterator?></td> 
                <td><?php echo $datas['id']?></td>
                <td><?php echo $datas['id_Persona']?></td>
                <td><?php echo $datas['id_Prestado']?></td>
                <td><?php echo $dataB['nombre']?></td>
                <td><?php echo $datas['fecha_prestado']?></td>
                <td><?php echo $datas['fecha_fin']?></td>
                <td><?php echo $datas['dias_restantes']?></td>
                <?php $iterator++;?>
            <?php
                }
            ?> 
    </table>
            <label for="book">Escoja el ID del Préstamo a Reponer</label>
            <select name="prestamo">
            <?php
                $answer=mysqli_query($conexion,$query);
                  while($valores = mysqli_fetch_array($answer)){
                    echo "<option value='".$valores['id']."'>".$valores['id']."</option>";

                 }
            ?>    
    <input type="submit" value="Solicitar" />
    <a href="Main_Panel.php">Regresa al Menú Principal</a>
    </form>
</body>
</html>