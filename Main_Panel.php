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
     echo $Le_Message;
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
                 <?php 
            }else{
                ?>
                    <input type="submit" name="prestar1" value="Solicitar Préstamo de un Libro">
                    <input type="submit" name="prestar3" value="Revisar sus Préstamos Actuales">
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
                        mysqli_query($conexion,$query3);
                    }
            //break;
                // $query2="UPDATE libros SET existencia_p = $newP WHERE id='$libro'";
            //echo $dia;
    }
}
        //echo $data['id'];
?>