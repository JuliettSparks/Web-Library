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
		$this->Cell(276,10,'Reporte de multas actuales',0,0,'C');
		$this->Ln(20);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->SetFont('Times','B',10);
		$this->Cell(30,8,'ID Prestamo',1,0,'C');
		$this->Cell(30,8,'ID Usuario',1,0,'C');
		$this->Cell(30,8,'ID Libro',1,0,'C');
		$this->Cell(50,8,'Dias de multa',1,0,'C');
		$this->Cell(50,8,'Dias antes de reposicion',1,0,'C');
		$this->Cell(30,8,'Multa',1,0,'C');
		$this->Ln();
	}
	function viewTable($db){
		$this->SetFont('Times','',10);
		$idLoan=$data->id_Prestamo_Causante;
		$stnt= $db->query('SELECT multas.id_Prestamo_Causante AS IDP, multas.id_Persona AS Persona, prestamos.id_Prestado AS Prestamo, multas.dias_multa AS DM, multas.days_repo AS DR, multas.multa AS Multa FROM multas JOIN prestamos ON multas.id_Prestamo_Causante=prestamos.id');
		
		
		while($data=$stnt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(30,8,$data->IDP,1,0,'C');
		$this->Cell(30,8,$data->Persona,1,0,'C');
		$this->Cell(30,8,$data->Prestamo,1,0,'C');
		$this->Cell(50,8,$data->DM,1,0,'C');
		$this->Cell(50,8,$data->DR,1,0,'C');
		$this->Cell(30,8,$data->Multa,1,0,'C');
		$this->Ln();	
		}
	}
	
}

$pdf= new PDF();
$pdf->AliasNBPages();
$pdf->AddPage('L','Letter',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','Reporte de multas actuales.pdf','false');

?>