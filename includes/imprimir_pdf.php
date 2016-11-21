<?php 
session_start();

require('../fpdf/fpdf.php');
include_once("../db_configuration.php");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('courier', '', 10);
$pdf->Cell(4, 10, '', 0);
$pdf->Image('../img/movie_icon.png' , 10 ,9.5, 12 , 12,'png');
$pdf->Cell(10,8,'',0);
$pdf->Cell(150, 10, 'Film Review', 0);
$pdf->SetFont('courier', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(18);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(80, 8, 'TUS VOTACIONES REALIZADAS', 0);
$pdf->Ln(13);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(35, 8, 'Usuario', 1,0,"C");
$pdf->Cell(35, 8, 'ID', 1,0,"C");
$pdf->Cell(50, 8, 'Pelicula', 1,0,"C");
$pdf->Cell(35, 8, 'Nota', 1,0,"C");
$pdf->Cell(35, 8, 'Fecha', 1,0,"C");
$pdf->Ln(8);
$pdf->SetFont('courier', '', 8);			
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
	if($connection->connect_errno){
		echo "<h1>Se produjo un error a la hora de conectarse a la base de datos: $connection->connect_errno</h1>";
	}				
//sql
$consulta = ("select valoraciones.nota, valoraciones.id_usuario, valoraciones.fecha, usuarios.nombre, peliculas.titulo FROM usuarios join valoraciones on usuarios.id_usuario=valoraciones.id_usuario
		join posee on valoraciones.id_valoracion=posee.id_valoracion join peliculas on posee.id_pelicula=peliculas.id_pelicula where usuarios.id_usuario=". $_SESSION['idsesion'].";");
$result = $connection->query($consulta);
$totalli = 0;
$total = 0;
while($fila = $result->fetch_object()){
	$pdf->Cell(35, 8,$fila->nombre, 1,0,"C");
	$pdf->Cell(35, 8,$fila->id_usuario,1,0,"C");
	$pdf->Cell(50, 8,$fila->titulo,1,0,"C");
    $pdf->Cell(35, 8,$fila->nota,1,0,"C");
	$pdf->Cell(35, 8,$fila->fecha,1,0,"C");
	$pdf->Ln(8);
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Output();

?>