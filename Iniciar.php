<?php
    $servidor="localhost";
    $usuario="root";
    $contrasena="";
    $db="biblioteca";

    $user=$_POST['id'];
    $pass=$_POST['contrasena'];

    $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);

    $consulta="SELECT * FROM personas WHERE id='$user' AND pass='$pass'";
    $resultado= mysqli_query($conexion,$consulta);
    $filas=mysqli_num_rows($resultado);
    $Le_Info=mysqli_fetch_array($resultado);
    //$result = "SELECT * FROM personas WHERE id LIKE '$id'";
    session_start();

    //echo $_SESSION['dato'];

    if($filas>0){
        $_SESSION['id']=$user;
        $_SESSION['pass']=$pass;
        $_SESSION['welcome']="Bienvenid@: ".$Le_Info["nombre"]." ".$Le_Info["apellido_pat"]." ".$Le_Info["apellido_mat"]."<br>";
        header("location: Main_Panel.php");
    }else{
        header("location: BadLogin.html");
    }
    mysqli_close($conexion);
?>