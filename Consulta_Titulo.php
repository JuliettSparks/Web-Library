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

         $titulo=$_POST['titulo'];

         $query="SELECT * from libros WHERE nombre like '$titulo%'";

         $query2="SELECT * from libros WHERE nombre like '$titulo%'";

         $answer=mysqli_query($conexion,$query);

         $data=mysqli_fetch_array($answer);
     
         $answer2=mysqli_query($conexion,$query2);
     
         $iterator=1;

?>
<!DOCTYPE html>
<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head> 
<body>
    <form action="Main_Panel.php" method="post">
    <?php if($data['id']=="" || $titulo==""){?>
        <h2>No se encontró algún libro con ese Nombre</h2>
        <input type="submit" value="Regresar" />
    <?php          
    }else{?>
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
                while($datas=mysqli_fetch_array($answer2)){
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
    <input type="submit" value="Regresar" /> 
                <?php
            }
            ?> 
    </form>
</body>
</html>