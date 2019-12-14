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
		$this->Cell(276,10,'Reporte de prestamos actuales',0,0,'C');
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
		$this->Cell(50,8,'Fecha de inicio de prestamo',1,0,'C');
		$this->Cell(50,8,'Fecha de retorno de prestamo',1,0,'C');
		$this->Cell(30,8,'Dias restantes',1,0,'C');
		$this->Cell(30,8,'Estado de libro',1,0,'C');
		$this->Ln();
	}
	function viewTable($db){
		$this->SetFont('Times','',10);
		$stnt= $db->query('SELECT * from prestamos');
		while($data=$stnt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(30,8,$data->id,1,0,'C');
		$this->Cell(30,8,$data->id_Persona,1,0,'C');
		$this->Cell(30,8,$data->id_Prestado,1,0,'C');
		$this->Cell(50,8,$data->fecha_prestado,1,0,'C');
		$this->Cell(50,8,$data->fecha_fin,1,0,'C');
		$this->Cell(30,8,$data->dias_restantes,1,0,'C');
		$this->Cell(30,8,$data->status_libro,1,0,'C');
		$this->Ln();	
		}
	}
	
}

$pdf= new PDF();
$pdf->AliasNBPages();
$pdf->AddPage('L','Letter',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','Reporte de prestamos actuales.pdf','false');

?>