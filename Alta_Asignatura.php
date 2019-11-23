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

    $name=$_POST['nombre'];
    $prefix=$_POST['prefix'];
    if($name==""){
        header("location: FailNotEnoughData.html");
        die();
    }
    $result = "SELECT * FROM asignatura WHERE nombre LIKE '$name'";
    $answer=mysqli_query($conexion,$result);
    if($row=mysqli_fetch_array($answer)){
        header("location: RefuseSubject.html");
    }else{
    $alta="INSERT INTO asignatura(nombre,prefijo) VALUES ('$name','$prefix')";
    mysqli_query("SET NAMES 'utf8'");
	mysqli_query($conexion,$alta);
	mysqli_close($conexion);
	header("location: Success_AU.php");
    }

?>