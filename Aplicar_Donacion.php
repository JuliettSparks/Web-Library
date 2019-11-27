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

            $id=$_POST["libro_elegido"];

            $query="SELECT * FROM libros WHERE id='$id'";

            $answer=mysqli_query($conexion,$query);

            $data=mysqli_fetch_array($answer);

            $LeCantActualF=($data['existencia_a'])-1;

            $LeCantActualT=($data['existencia_t'])-1;

            $query2="UPDATE libros SET existencia_a = $LeCantActualF WHERE id='$id'";

            $query3="UPDATE libros SET existencia_t = $LeCantActualT WHERE id='$id'";

            mysqli_query($conexion,$query2);

            mysqli_query($conexion,$query3);

            header("location: SuccessDonation.html");

?>