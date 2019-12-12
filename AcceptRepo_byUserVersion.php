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

    $idLoan=$_POST['prestamo'];
    $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
    //$query3="UPDATE prestamos SET dias_restantes= $diasA WHERE fecha_prestado='$date3'";
    $query="SELECT id_Prestado from prestamos where id='$idLoan'";
    $answer=mysqli_query($conexion,$query);
    $data=mysqli_fetch_array($answer);
    $idBook=$data['id_Prestado'];
    //echo $idBook;
    $query2="SELECT * from libros where id='$idBook'";
    $answer2=mysqli_query($conexion,$query2);
    $data2=mysqli_fetch_array($answer2);
    $LeNewExistA=$data2['existencia_a']+1;
    $LeNewExistP=$data2['existencia_p']-1;

    $query3="UPDATE libros SET existencia_a='$LeNewExistA', existencia_p='$LeNewExistP'";

    $query4="DELETE from prestamos where id='$idLoan'";

    $query5="DELETE from multas where id_Prestamo_Causante='$idLoan'";

    mysqli_query($conexion,$query3);

    mysqli_query($conexion,$query4);

    mysqli_query($conexion,$query5);

    header("location: SuccessRepo.html");
?>