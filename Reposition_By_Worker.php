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

    $query="SELECT * from libros";

    $query2="SELECT COUNT(*) total from libros";

    $answer=mysqli_query($conexion,$query);

    $value=mysqli_query($conexion,$query2);

    $index=mysqli_fetch_assoc($value);

    //echo "Se tiene un Total de ".$index['total']." Libros";

    $iterator=1;

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
    <h1>Se tienen los Siguientes Libros:</h1>
    <div class="Cajota">
    <form action="Apply_Repo_by_Worker.php" method="post">
    <table border="1">
        <tr>
            <td>Índice:</td>
            <td>ID:</td>
            <td>Nombre:</td> 
            <td>Autor:</td> 
            <td>Asignatura:</td> 
            <td>Existencia Total:</td> 
            <td>Existencia Presente:</td>
            <td>Existencia Prestada:</td>
            <td>Editorial:</td>
            <td>Año de Publicación:</td>
            <td>Lugar de Publicación:</td>
            <td>Volumen:</td>  
</tr>
            <?php
                while($data=mysqli_fetch_array($answer)){
            ?>
                <tr>
                <td><?php echo $iterator?></td>
                <?php $iterator++;?>
                <td><?php echo $data['id']?></td>
                <td><?php echo $data['nombre']?></td>
                <td><?php echo $data['autor']?></td>
                <td><?php echo $data['asignatura']?></td>
                <td><?php echo $data['existencia_t']?></td>
                <td><?php echo $data['existencia_a']?></td>
                <td><?php echo $data['existencia_p']?></td>
                <td><?php echo $data['editorial']?></td>
                <td><?php echo $data['ano']?></td>
                <td><?php echo $data['ubicacion']?></td>
                <td><?php echo $data['volumen']?></td>
                </tr>
                <?php
                }
            ?>
                
    </table>
    <label for="book">Escoja el ID del Libro a Añadir Ejemplares</label>
            <select name="book">
            <?php
                $answer=mysqli_query($conexion,$query);
                  while($valores = mysqli_fetch_array($answer)){
                    echo "<option value='".$valores['id']."'>".$valores['id']."</option>";

                 }
            ?> 
        <input type="submit" value="Aplicar">
            </form> 
            </div>
    
</body>
</html>
