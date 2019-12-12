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
        
             $idLoan=$_POST['loanSelected'];

             $conexion=mysqli_connect('127.0.0.1','externo','qwerty123','biblioteca',3307);
            
             date_default_timezone_set("America/Mexico_City");

             $now=time();
        //$later=strtotime("+4 day",$now);
            $later=strtotime("+4 day",$now);
            $date=date("Y-m-d H:i:s",$now);
            $plazo=date("Y-m-d H:i:s",$later);

             $query="INSERT INTO solicitudes(id_Persona,id_Prestamo,fecha) VALUES ('$user','$idLoan','$date')";
            
             $query2="SELECT * FROM solicitudes WHERE id_Prestamo= '$idLoan'";

             $answer=mysqli_query($conexion,$query2);

             $data=mysqli_fetch_array($answer);
             if($data['id_Prestamo']==""){
                mysqli_query($conexion,$query);
                header("location: Application_Sent_Successfully.html");
             }else{
                 header("location: Fail_Sending_Application.html");
             }
             
?>