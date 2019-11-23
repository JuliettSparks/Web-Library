<?php
     session_start();
     if($_SESSION['id']==null){
        header("location: NotDataLogin.html");
        die();
     }
    $var_usuario=$_SESSION['id'];
    if($var_usuario=="" || $var_usuario==null){
        echo "Usted no ha iniciado una sesión";
        die();
    }
    session_destroy();
    header("location: index.html");
?>