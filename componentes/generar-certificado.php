<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('PDF_PAGE_ORIENTATION_LANDSCAPE', 'L');

// Incluye la librería TCPDF
require_once('../tcpdf/tcpdf.php');

// Incluye Libreria de Generador QR
require_once ('../phpqrcode/phpqrcode.php');

// Obtiene el ID del certificado de la URL
$certificate_id = $_GET['id'];

// Establece una conexión a la base de datos
include "../database/conexion.php";

// Selecciona los datos del certificado de la base de datos
$sql = "SELECT c.id, DATE_FORMAT(c.emision, '%d-%m-%Y') AS emision, u.nombre, u.apellido, cr.nombre_curso as nombre_curso FROM certificados c INNER JOIN usuarios u ON c.id_usuario = u.id INNER JOIN cursos cr ON c.id_curso = cr.id WHERE c.id = '$certificate_id'";
$result = mysqli_query($conexion, $sql);
$certificate_data = mysqli_fetch_assoc($result);

$text = 'https://certificado.acreditacionesprofesionales.com/componentes/generar-certificado.php?id=' . $certificate_id;
QRcode::png($text, 'qr.png', QR_ECLEVEL_L, 4);

// Crea una nueva instancia de la clase TCPDF
$pdf = new TCPDF('L', 'mm', '900,600', true, 'UTF-8', false);

$pdf->SetTitle('Certificado de' . " " . $certificate_data['nombre'] . " " . "en" . " " . $certificate_data['nombre_curso']);

// Establece los margenes del documento
$pdf->SetMargins(0, 0, 0, 0);

$pdf->SetAutoPageBreak(false, 0);

// Agrega una página
$pdf->AddPage();

// Agrega la imagen como fondo del certificado
$pdf->Image('../assets/img/certificado.jpg', 0, 0, 298, 210, '', '', '', false, 300, '', false, false, 0);

$pdf->SetFont('helvetica', 'B', 45);

$pdf->Ln(30);

$pdf->Cell(0, 0, "CERTIFICADO", 0, 1, 'C', 0, '', 0, false, 'M', 'M');

// Establece el tipo de fuente y el tamaño del texto
$pdf->SetFont('helvetica', '', 16);

$pdf->Ln(10);

// Agrega el nombre y apellido del titular del certificado al PDF
$pdf->Cell(0, 0, $certificate_data['nombre'] . " " . $certificate_data['apellido'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');

$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 36);

// Agrega el nombre del curso al PDF
$pdf->Cell(0, 0, $certificate_data['nombre_curso'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');

$pdf->SetFont('helvetica', '', 12);

$pdf->Ln(10);

$pdf->Cell(0, 0, 'Código de Certificado: ' . $certificate_data['id'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');

$pdf->Ln(10);

$pdf->Cell(0, 0, "Fecha de Emisión: " . $certificate_data['emision'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');

$pdf->Image('qr.png', 245, 30, 30, 30, '', '', '', false, 300, '', false, false, 0);

// Output the document
$pdf->Output('certificado.pdf', 'I');

// Cierra la conexión a la base de datos
mysqli_close($conexion);

exit;
?>