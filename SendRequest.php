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

             $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);

             $query="INSERT INTO solicitudes(id_Persona,id_Prestamo) VALUES ('$user','$idLoan')";
            
             $query2="SELECT * FROM solicitudes WHERE id_Prestamo= '$idLoan'";

             $answer=mysqli_query($conexion,$query2);

             $data=mysqli_fetch_array($answer);
             if($data['id_Persona']==""){
                mysqli_query($conexion,$query);
                header("location: Application_Sent_Successfully.html");
             }else{
                 header("location: Fail_Sending_Application.html");
             }
             
?>