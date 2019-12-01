<?php
     session_start();
     if($_SESSION['id']==null){
        header("location: NotDataLogin.html");
        die();
     }
     $var_usuario=$_SESSION['id'];
     if($var_usuario=="" || $var_usuario==null){
        //echo "Usted no ha iniciado una sesión";
        die();
        header("location: NotDataLogin.html");
    }
     $servidor="localhost";
     $usuario="root";
     $contrasena="";
     $db="biblioteca";
     $user=$_SESSION['id'];
     $Le_Message=$_SESSION['welcome'];
     //echo $Le_Message;
     $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
     $consulta="SELECT * FROM personas WHERE id='$user'";
     $resultado= mysqli_query($conexion,$consulta);
     $Le_Info=mysqli_fetch_array($resultado);
     Check_Day($var_usuario,$conexion);
     
?>
    <!DOCTYPE html>
    <html lang="es-mx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Biblioteca</title>
    </head>
    <body>
    <form action="Conductor.php" method="post">
        <h1><?php echo $Le_Message ?></h1>
    <input type="submit" name="consulta1" value="Consulta de Todos los Libros">
    <input type="submit" name="consulta2" value="Consultar Libros por Autor">
    <input type="submit" name="consulta3" value="Consultar Libros por Nombre">
    <input type="submit" name="consulta4" value="Consultar Libros por Asignatura">
        <?php
            
            if($Le_Info['puesto']=="Admin" || $Le_Info['puesto']=="Personal"){?>
                <input type="submit" name="alta1" value="Dar de Alta Libros" />
                <input type="submit" name="alta2" value="Alta Nuevo Usuario"/>
                <input type="submit" name="alta3" value="Dar de Alta Asignaturas"/>
                <input type="submit" name="prestar2" value="Mostrar todos los Préstamos">
                <input type="submit" name="donar1" value="Donar libros">
                <input type="submit" name="multas2" value="Revisar todas las Multas">
                <input type="submit" name="renovar2" value="Revisar Solicitudes de Renovación">
                 <?php 
            }else{
                ?>
                    <input type="submit" name="prestar1" value="Solicitar Préstamo de un Libro">
                    <input type="submit" name="prestar3" value="Revisar sus Préstamos Actuales">
                    <input type="submit" name="multas1" value="Revisar sus Multas">
                    <input type="submit" name="renovar1" value="Solicitar Renovación de Préstamos">
                    <?php
            }
                ?>
                
                <input type="submit" name="salir" value="Cerrar Sesión">
    </form> 
    </body>
    </html>
<?php
    function Check_Day($user,$conexion){
        date_default_timezone_set("America/Mexico_City");
        $query2="SELECT *FROM prestamos";
        $answer=mysqli_query($conexion,$query2);
        $now=time();
        //echo $date;
        $date=date("Y-m-d H:i:s",$now);
        $FechaInt=strtotime($date);
        $diaA = date("d", $FechaInt);
        $minA= date("i",$FechaInt);
        $hrA=date("H",$FechaInt);
        $segA=date("s",$FechaInt); 
        $later=strtotime("+1 day",$now);
        $plazo=date("Y-m-d H:i:s",$later);
        
        while($data=mysqli_fetch_array($answer)){
            $SecondDate=strtotime($data['fecha_prestado']);
            $id_Data=$data['id'];
            $date3=$data['fecha_prestado'];
            $diaA = date("d", $FechaInt);
            $dia = date("d", $SecondDate);
            $min= date("i",$SecondDate);
            $hr=date("H",$SecondDate);
            $seg=date("s",$SecondDate);
            $month=date("m",$SecondDate);
            $year=date("y",$SecondDate);
            $diferenceBetween=($diaA-$dia)+1;
            $day=$dia+$diferenceBetween;
            //echo $diferenceBetween;
            $dateaux=mktime($hr,$min,$seg,$month,$day,$year);
            $later=strtotime("+2 day",$SecondDate);
            $plazo=date("Y-m-d H:i:s",$later);
            //echo $plazo."<br>";
            //echo $date3;
            $date2=date("Y-m-d H:i:s",$dateaux);
            //echo "Fecha de Préstamo: ".$date3."<br>";
            //echo "Fecha del Sistema: ".$date."<br>";
            if($data['dias_restantes']!=0){
                switch($data['dias_restantes']){
                    case 4: $later=strtotime("+1 day",$SecondDate);
                            $plazo=date("Y-m-d H:i:s",$later);
                            //echo "Plazo Nuevo:".$plazo."<br>";
                            break;
                    case 3: $later=strtotime("+2 day",$SecondDate);
                            $plazo=date("Y-m-d H:i:s",$later);
                            //echo "Plazo Nuevo :".$plazo."<br>";
                            break;
                    case 2: $later=strtotime("+3 day",$SecondDate);
                    //echo "Plazo Nuevo:".$plazo."<br>";
                            $plazo=date("Y-m-d H:i:s",$later);
                            break;
                    case 1: $later=strtotime("+4 day",$SecondDate);
                    //echo "Plazo Nuevo:".$plazo."<br>";
                            $plazo=date("Y-m-d H:i:s",$later);
                            break;
                }
                        if($date>=$plazo){
                            //echo "Entré";
                            $toSubst=$diaA-$dia;
                            $diasA=$data['dias_restantes']-1;
                            //echo $diasA;
                            if($diasA<=0){
                                $diasA=0;
                            }
                            $date3=$data['fecha_prestado'];
                            //$SecondDate=date("Y-m-d H:i:s");
                            $query3="UPDATE prestamos SET dias_restantes= $diasA WHERE fecha_prestado='$date3'";
                            $query4="UPDATE prestamos SET fecha_prestado= $date3 WHERE id='$id_Data'";
                            mysqli_query($conexion,$query3);
                            mysqli_query($conexion,$query4);
                        }
            }else{
                //
                //echo "Ya no hay días"."<br>";
                $later=strtotime("+5 day",$SecondDate);
                $plazo=date("Y-m-d H:i:s",$later);
                $idLoan=$data['id'];
                //echo $idLoan."<br>";
                $query5="SELECT * FROM multas";
                $query7="SELECT * FROM multas Where id_Prestamo_Causante = '$idLoan'";
                $idUser=$data['id_Persona'];
                $answerPost=mysqli_query($conexion,$query7);
                $data3=mysqli_fetch_array($answerPost);
                $Allow=False;
                $RepoObligatory=false;
                if($data3['id_Persona']==""){
                    //echo "No esta ese registro";
                    $Allow=true;
                    //echo $Allow;
                }
                if($date>=$plazo && $Allow==true){
                    $query6="INSERT INTO multas(id_Prestamo_Causante,id_Persona,dias_multa,days_pre_obli_repo,multa) Values ('$idLoan','$idUser','1','4','30')";
                    mysqli_query($conexion,$query6);
                }
                if($data3['id_Persona']!=""){
                    $AllowDe=false;
                    switch($data3['dias_multa']){
                        case 1: $later=strtotime("+6 day",$SecondDate);
                                $plazo=date("Y-m-d H:i:s",$later);
                                break;
                        case 2: $later=strtotime("+7 day",$SecondDate);
                                $plazo=date("Y-m-d H:i:s",$later);
                                break;
                        case 3: $later=strtotime("+8 day",$SecondDate);
                                $plazo=date("Y-m-d H:i:s",$later);
                                break;
                        case 4: $later=strtotime("+9 day",$SecondDate);
                                $plazo=date("Y-m-d H:i:s",$later);
                                break;
                    }
                    if($date>=$plazo){
                        $AllowDe=true;
                        $NewDayMu=$data3['dias_multa']+1;
                        $NewDayRepo=$date3['days_pre_obli_repo']-1;
                        $NewMulta=$date3['multa']+15;
                        if($NewDayRepo<=0){
                            $NewDayRepo=0;
                            $RepoObligatory=TRUE;
                        }
                        if($NewDayMu>=4){
                            $NewDayMu=4;
                        }
                        if($RepoObligatory==true){
                            $NewMulta=400;
                            $query11="UPDATE prestamos set status_libro= Perdido WHERE id = '$idLoan'";
                            mysqli_query($conexion,$query11);
                        }
                        $query8="UPDATE multas set dias_multa = $NewDayMu WHERE id_Prestamo_Causante ='$idLoan'";
                        $query9="UPDATE multas set days_pre_obli_repo = $NewDayRepo WHERE id_Prestamo_Causante ='$idLoan'";
                        $query10="UPDATE multas set multa = $NewMulta WHERE id_Prestamo_Causante ='$idLoan'";
                        mysqli_query($conexion,$query8);
                        mysqli_query($conexion,$query9);
                        mysqli_query($conexion,$query10);
                    }
                }
            }
            
            
            //break;
                // $query2="UPDATE libros SET existencia_p = $newP WHERE id='$libro'";
            //echo $dia;
            
    }
}

        //echo $data['id'];
?>