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
     $autor=$_POST['autor'];
     $asignatura=$_POST['asignatura'];
     if($autor=="" && $asignatura!="Asignatura"){
        $query="SELECT * FROM libros WHERE nombre like '$titulo%' and asignatura like '$asignatura%'";
     }
     if($autor!="" && $asignatura=="Asignatura"){
        $query="SELECT * FROM libros WHERE nombre like '$titulo%' and autor like '$autor%'";
     }
     if($autor!="" && $asignatura!="Asignatura" && $titulo==""){
        $query="SELECT * FROM libros WHERE autor like '$autor%' and asignatura like '$asignatura%'";
     }
     if($autor=="" && $asignatura=="Asignatura"){
        $query="SELECT * FROM libros WHERE nombre like '$titulo%'";
     }
     if($autor!="" && $asignatura!="Asignatura" && $titulo!=""){
        $query="SELECT * FROM libros WHERE nombre like '$titulo%' and asignatura like '$asignatura%' and autor like '$autor%'";
     }
     if($autor=="" && $titulo=="" && $asignatura!="Asignatura"){
        $query="SELECT * FROM libros WHERE asignatura like '$asignatura%'";
     }
     $answer=mysqli_query($conexion,$query);
     $data=mysqli_fetch_array($answer);
     $iterator=1;
     ?> <?php if($data['id']==null){?>
     <!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head>
<body>
    <form action="Main_Panel.php" method="post">
        <h2>No se encontraron libros bajo los datos Solicitados</h2>
        <input type="submit" value="Regresar al Menú Principal">
        
    </form>
</body>
</html>
    <?php  
     }else{$answer=mysqli_query($conexion,$query);?>
     <!DOCTYPE html>

<html lang="es-mx" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Biblioteca</title>
</head>
<body>
    <form action="RealizaPrestamo.php" method="post">
        <h2>Se encontraron los siguientes libros, los cuales cumplen con los criterios establecidos</h2>
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
                while($datas=mysqli_fetch_array($answer)){
            ?>
                <tr>
                <td><?php echo $iterator?></td>
                
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
                <?php $iterator++;?>
            <?php
                }
            ?> 
    </table>
            <label for="book">Escoja el ID del Libro deseado</label>
            <select name="libro_elegido">
            <?php
                $answer=mysqli_query($conexion,$query);
                  while($valores = mysqli_fetch_array($answer)){
                    echo "<option value='".$valores['id']."'>".$valores['id']."</option>";

                 }
            ?>    
    <input type="submit" value="Solicitar" />
    <a href="Main_Panel.php">Regresa al Menú Principal</a>
    </form>
    <?php
     }?>
</body>
</html>