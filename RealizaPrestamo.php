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

         $libro=$_POST['libro_elegido'];

         echo $libro;
?>