<?php
session_start();
         if($_SESSION['id']==null){
            header("location: NotDataLogin.html");
            die();
         }



require 'fpdf/fpdf.php';
$db=new PDO('mysql:host=localhost;port=3306;dbname=biblioteca','root','');

class PDF extends FPDF{
	function header(){
		$this->Image('Styles/Images/uaa.png',10,6,50,25);
		$this->SetFont('Arial','B',16);
		$this->Cell(276,5,'Biblioteca de la Universidad Autonoma de Aguascalientes',0,0,'C');
		$this->Ln(10);
		$this->SetFont('Times','',14);
		$this->Cell(276,10,'Reporte de total de libros',0,0,'C');
		$this->Ln(15);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->SetFont('Times','B',10);
		$this->Cell(15,8,'ID',1,0,'C');
		$this->Cell(50,8,'Nombre',1,0,'C');
		$this->Cell(50,8,'Autor',1,0,'C');
		$this->Cell(26,8,'Asignatura',1,0,'C');
		$this->Cell(16,8,'E.Total',1,0,'C');
		$this->Cell(18,8,'E.Actual',1,0,'C');
		$this->Cell(18,8,'E.Presta',1,0,'C');
		$this->Cell(25,8,'Editorial',1,0,'C');
		$this->Cell(14,8,utf8_decode("Año"),1,0,'C');
		$this->Cell(20,8,'Ciudad',1,0,'C');
		$this->Cell(10,8,'Vol.',1,0,'C');
		$this->Ln();
	}
	function viewTable($db){
		$this->SetFont('Times','',8);
		$stnt= $db->query('SELECT * from libros');
		while($data=$stnt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(15,8,$data->id,1,0,'C');
		$this->Cell(50,8,$data->nombre,1,0,'C');
		$this->Cell(50,8,$data->autor,1,0,'C');
		$this->Cell(26,8,$data->asignatura,1,0,'C');
		$this->Cell(16,8,$data->existencia_t,1,0,'C');
		$this->Cell(18,8,$data->existencia_a,1,0,'C');
		$this->Cell(18,8,$data->existencia_p,1,0,'C');
		$this->Cell(25,8,$data->editorial,1,0,'C');
		$this->Cell(14,8,$data->ano,1,0,'C');
		$this->Cell(20,8,$data->ubicacion,1,0,'C');
		$this->Cell(10,8,$data->volumen,1,0,'C');
		$this->Ln();	
		}
	}
	
}

$pdf= new PDF();
$pdf->AliasNBPages();
$pdf->AddPage('L','Letter',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','Reporte de total de libros.pdf','false');

?>