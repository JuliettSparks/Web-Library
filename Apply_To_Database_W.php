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

   $LeId=$_SESSION['Modify'];

   $LeNewCant=$_POST['cant'];

   //echo $LeNewCant;
   $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);

   $query="SELECT existencia_a,existencia_t from libros where id='$LeId'";

   $answer=mysqli_query($conexion,$query);

   $data=mysqli_fetch_array($answer);

   $LeMody=$data['existencia_t']+$LeNewCant;

   $LeMody2=$data['existencia_a']+$LeNewCant;

   $query2="UPDATE libros set existencia_t='$LeMody',existencia_a='$LeMody2' where id='$LeId'";

   mysqli_query($conexion,$query2);

   header("location: SuccessRepo.html");


?>