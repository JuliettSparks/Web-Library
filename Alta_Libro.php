<?php
    /*if($_POST['titulo']==""){
        header("location: BookAdd.html");
    }else{*/
        session_start();
        if($_SESSION['id']==null){
           header("location: NotDataLogin.html");
           die();
        }
        $var_usuario=$_SESSION['id'];
        if($var_usuario=="" || $var_usuario==null){
            //header("location: Refuse.html");
            session_destroy();
            die();
        }
        $titulo=$_POST['titulo'];
        if($titulo==""){
            //echo $titulo;
            header("location: FailNotEnoughData.html");
            die();
        }
        //echo $titulo;
        $autor=$_POST['autor'];
        $asignatura=$_POST['asignatura'];
        $editorial=$_POST['editorial'];
        $id_ubi=$_POST['id_ubi'];
        $ano=$_POST['ano'];
        $volumen=$_POST['volumen'];
        $existA=$_POST['existA'];
        $existP=$_POST['existP'];
        $existT=$existA+$existP;
        //echo $asignatura;
     $servidor="localhost";
     $usuario="root";
     $contrasena="";
     $db="biblioteca";
     /*    $LeArray=array($varFirstLetterApPat,$varFirstVocalApPat,$varFirstLetterApMat,$varFirstLetterName,$var_ano,
    $var_mes,$var_dia,$var_sexo,$var_state,$var_FirstConsonantApPat,$var_FirstConsonantApMat,$var_FirstConsonantName,$var_hclave,$var_numVer);
    $LeCurp=implode($LeArray);
    $LeCurpFinal=strtoupper($LeCurp);*/
     $Le_LibroActual=0;
     $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
     $sql = "SELECT COUNT(*) total FROM libros WHERE asignatura='$asignatura'";
     $consulta="SELECT prefijo FROM asignatura WHERE nombre='$asignatura'";
     $query="SELECT * from libros";
     $result = mysqli_query($conexion, $sql);
     $response= mysqli_query($conexion,$consulta);
     $prefix= mysqli_fetch_array($response);
    //echo $prefix['prefijo'];
     $fila = mysqli_fetch_assoc($result);
     if($fila['total']==0){
        $Le_LibroActual=100;
     }else{
        $Le_LibroActual=100+$fila['total'];
     }
     $LeArray=array($prefix['prefijo'],$Le_LibroActual,".",$volumen);
     $LeID=implode($LeArray);
     $LeIDBook=strtoupper($LeID);
     $alta="INSERT INTO libros(id,nombre,autor,asignatura,existencia_t,existencia_a,existencia_p,editorial,ano,ubicacion,volumen) VALUES ('$LeIDBook','$titulo','$autor','$asignatura','$existT','$existA','$existP','$editorial','$ano','$id_ubi','$volumen')";
     mysqli_query($conexion,$alta);
     mysqli_close($conexion);
     //session_destroy();
     header("location: Success_AU.php");
     //echo 'Número de total de registros: ' . $fila['total'];
     /*
     SELECT count(*) FROM libros
     */
?>
