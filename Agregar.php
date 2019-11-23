<?php
    /*
    if($_POST['id']==""){
        header("location: Add_user.html");
    }else{*/
        session_start();
        if($_SESSION['id']==null){
           header("location: NotDataLogin.html");
           die();
        }
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $apellido_pat=$_POST['apellido_pat'];
        $apellido_mat=$_POST['apellido_mat'];
        $puesto=$_POST['puesto'];
        //echo $puesto;
        $pass=$_POST['password'];
        if($nombre==""){
            header("location: FailNotEnoughData.html");
            die();
        }
    $servidor="localhost";
    $usuario="root";
    $contrasena="";
    $db="biblioteca";

    $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
    if(!$conexion){
        echo "Error: No se puede conectar a la DB".PHP_EOL;
        echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
        echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
        exit;
    }
    //Mandar llamar al Script que Validará la entrada del ID
    /*$row = mysql_fetch_array($result)*/
    $result = "SELECT * FROM personas WHERE id LIKE '$id'";
    $answer=mysqli_query($conexion,$result);
    if($row=mysqli_fetch_array($answer)){
        header("location: Refuse.html");
    }else{
    $alta="INSERT INTO personas(id,nombre,apellido_pat,apellido_mat,puesto,pass) VALUES ('$id','$nombre','$apellido_pat','$apellido_mat','$puesto','$pass')";
    mysqli_query("SET NAMES 'utf8'");
	mysqli_query($conexion,$alta);
	mysqli_close($conexion);
	header("location: Success_AU.php");
    }
?>
