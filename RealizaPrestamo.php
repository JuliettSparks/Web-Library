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
    
         $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);

         $libro=$_POST['libro_elegido'];

         //echo $libro;

         $query="SELECT * FROM libros where id='$libro'";

         $answer=mysqli_query($conexion,$query);

         $data=mysqli_fetch_array($answer);

        date_default_timezone_set("America/Mexico_City");
        /*
        $ahora = time();
$unDiaEnSegundos = 24 * 60 * 60;
$manana = $ahora + $unDiaEnSegundos;
$mananaLegible = date("Y-m-d", $manana);
# ahoraLegible únicamente es para demostrar
$ahoraLegible = date("Y-m-d", $ahora);
echo "Hoy es $ahoraLegible y mañana es $mananaLegible";
$manana = strtotime("+1 day", $ahora);*/
        $now=time();
        //$later=strtotime("+4 day",$now);
        $later=strtotime("+4 day",$now);
        $date=date("Y-m-d H:i:s",$now);
        $plazo=date("Y-m-d H:i:s",$later);
         $varID1=rand(0,9);
         $varID2=rand(0,9);
         $varID3=rand(0,9);
         $varID4=rand(0,9);
         $varID5=rand(0,9);
         $aux=array($varID1,$varID2,$varID3,$varID4,$varID5);
         $LeId=implode($aux);
         //echo $data['id'];

         //echo $data['autor'];
             
        if($data['existencia_a']==0){
            header("location: NotBooksAvailable.html");
        }else{
            $newP=$data['existencia_p']+1;
            $newA=$data['existencia_a']-1;
            $query2="UPDATE libros SET existencia_p = $newP WHERE id='$libro'";
            mysqli_query($conexion,$query2);
            $query3="UPDATE libros SET existencia_a = $newA WHERE id='$libro'";
            mysqli_query($conexion,$query3);
            //mysqli_query($conexion,$query2);
            $query4="INSERT INTO prestamos(id,id_Persona,id_Prestado,fecha_prestado,fecha_fin,dias_restantes,status_libro) VALUES ($LeId,'$user','$libro','$date','$plazo','4','Seguro')";
            mysqli_query($conexion,$query4);
            header("location: PrestamoExitoso.html");
        }

?>