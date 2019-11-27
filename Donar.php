<?php
        session_start();
        if($_SESSION['id']==null){
           header("location: NotDataLogin.html");
           die();
        }
        $var_usuario=$_SESSION['id'];
        if($var_usuario=="" || $var_usuario==null){
            header("location: Refuse.html");
            die();
        }
        $servidor="localhost";
        $usuario="root";
        $contrasena="";
        $db="biblioteca";
    
        $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);

        $query="SELECT * FROM libros WHERE existencia_a != 0";

        $answer=mysqli_query($conexion,$query);

        $data=mysqli_fetch_array($answer);

        $iterator=1;

?>
<!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head>
<body>
    <form action="Aplicar_Donacion.php" method="post">
        <?php
        if($data['id']==""){?>
        <h2>"No se tienen libros disponibles para Donar</h2>
        <a href="Main_Panel.php">Regresar al Menú Principal</a>
        <?php
        }else{?>
        <h2>Se encontraron los Siguientes Libros los Cuales se tienen ejemplares disponibles</h2>
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
            <?php
                $answer=mysqli_query($conexion,$query);
                while($datas=mysqli_fetch_array($answer)){
            ?>
                <tr>
                <td><?php echo $iterator?></td>
                <?php $iterator++;?>
                <td><?php echo $datas['id']?></td>
                <td><?php echo $datas['nombre']?></td>
                <td><?php echo $datas['autor']?></td>
                <td><?php echo $datas['asignatura']?></td>
                <td><?php echo $datas['existencia_t']?></td>
                <td><?php echo $datas['existencia_a']?></td>
                <td><?php echo $datas['existencia_p']?></td>
                <td><?php echo $datas['editorial']?></td>
                <td><?php echo $datas['ano']?></td>
                <td><?php echo $datas['ubicacion']?></td>
                <td><?php echo $datas['volumen']?></td>

            <?php
                }
            ?> 
    </table>
        <?php

        }?>
        <label for="book">Escoja el ID del Libro a Donar</label>
        <select name="libro_elegido">
        <?php
            $answer=mysqli_query($conexion,$query);
            while($valores = mysqli_fetch_array($answer)){
            echo "<option value='".$valores['id']."'>".$valores['id']."</option>";
            }
        ?> 
        <input type="submit" value="Donar el Libro" />
        <a href="Main_Panel.php">Regresar al Menú Principal</a>
    </form>
</body>
</html>