<?php
    session_start();
    if($_POST['alta2']){
        header("location: Add_user.html");
    }
    if($_POST['alta1']){
        header("location: BookAdd.php");
    }
    if($_POST['salir']){
        header("location: Cerrar_Sesion.php");
    }
    if($_POST['alta3']){
        header("location: Add_Subject.html");
    }
    if($_POST['consulta1']){
        header("location: ConsultaTotal.php");
    }
    if($_POST['consulta2']){
        header("location: CheckAutor.html");
    }
    if($_POST['panel1']){
        header("location: Main_Panel.php");
    }
    if($_POST['alta_book']){
        header("location: Alta_Libro.php");
    }
    if($_POST['fail'] || $_SESSION['id']==null){
        header("location: index.html");
        die();
    }
    if($_POST['consulta3']){
        header("location: CheckName.html");
    }
    if($_POST['consulta4']){
        header("location: CheckBySubject.html");
    }
    if($_POST['prestar1']){
        header("location: Prestamo.php");
    }
    if($_POST['prestar2']){
        header("location: ShowAllLoans.php");
    }
    if($_POST['prestar3']){
        header("location: ShowMyLoans.php");
    }
    if($_POST['donar1']){
        header("location: Donar.php");
    }
    if($_POST['multas1']){
        header("location: ShowMyPenaltys.php");
    }
    if($_POST['multas2']){
        header("location: ShowAllPenaltys.php");
    }
    if($_POST['renovar1']){
        header("location: Solicita_Renovar.php");
    }
    if($_POST['renovar2']){
        header("location: CheckRenovationRequests.php");
    }
    if($_POST['renovar3']){
        header("location: SendRequest.php");
    }
    if($_POST['repo1']){
        header("location: Reposition_Loan.php");
    }
?>