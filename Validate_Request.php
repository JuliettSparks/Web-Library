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

  $conexion=mysqli_connect('127.0.0.1','externo','qwerty123','biblioteca',3307);

  $id_L=$_POST['prestamo_elegido'];

  //echo $id_L;

  $query="SELECT * from prestamos where id = '$id_L'";

  $answer=mysqli_query($conexion,$query);

  $data=mysqli_fetch_array($answer);

  //echo $data['id_Prestado'];

  $plazo_ini=$data['fecha_prestado'];

  $plazo_fin=$data['fecha_fin'];
 
  $IniFecha=strtotime($plazo_ini);

  $FinFecha=strtotime($plazo_fin);

  $laterIni=strtotime("+4 day",$IniFecha);

  $laterFin=strtotime("+4 day",$FinFecha);

  $LeIni=date("Y-m-d H:i:s",$laterIni);

  $LeFini=date("Y-m-d H:i:s",$laterFin);

  $query2="UPDATE prestamos set fecha_prestado='$LeIni', fecha_fin='$LeFini', dias_restantes='4' where id='$id_L'";

  $query3="DELETE from solicitudes where id_Prestamo = '$id_L'";

  mysqli_query($conexion,$query2);

  mysqli_query($conexion,$query3);

  header("location: AcceptRequest.html");
?>