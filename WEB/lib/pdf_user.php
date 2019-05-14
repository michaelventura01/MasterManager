<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT * FROM ticket WHERE serie= '$id'");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

class PDF extends FPDF{
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(5,0);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);
$pdf->Image('../img/cabecera.png',2,3,-295);

$pdf->Cell (10,50,utf8_decode('Fecha y Hora'),0,1,'C');
$pdf->Cell (80,-50,utf8_decode(' :'),0,10,'C');
$pdf->Cell (120,50,utf8_decode($reg['fecha']),0,0,'C');

$pdf->Cell (-238,70,utf8_decode('Memo #'),0,1,'C');
$pdf->Cell (80,-70,utf8_decode(':'),0,10,'C');
$pdf->Cell (102,70,utf8_decode('1415-19'),0,1,'C');

$pdf->Cell (-1,-50,utf8_decode('Al (a)'),0,1,'C');
$pdf->Cell (80,50,utf8_decode(':'),0,10,'C');
$pdf->Cell (124,-50,utf8_decode('MTRO. JUAN MATOS,'),0,10,'C');
$pdf->Cell (158,60,utf8_decode('Director de Recursos Humanos Académicos'),0,10,'C');
$pdf->Cell (112,-50,utf8_decode('Su Despacho.'),0,10,'C');

$pdf->Cell (-5,70,utf8_decode('Vía'),0,1,'C');
$pdf->Cell (80,-70,utf8_decode(':'),0,10,'C');
$pdf->Cell (150,70,utf8_decode('MTRO. NURIS BASTARDO ZORRILLA,'),0,10,'C');
$pdf->Cell (175,-60,utf8_decode('Directora General de Recursos Humanos Académicos.'),0,10,'C');

$pdf->Cell (3,80,utf8_decode('Atención'),0,10,'C');
$pdf->Cell (80,-80,utf8_decode(':'),0,10,'C');
$pdf->Cell (128,80,utf8_decode('LIC. ANA HERNANDEZ'),0,10,'C');

$pdf->Cell (1,-60,utf8_decode('Asunto'),0,10,'C');
$pdf->Cell (80,60,utf8_decode(':'),0,10,'C');
$acum = "";
$asunto = $reg['asunto'] . "asjkdrrewereeeeeejgsadlijigsdiul";
//$pdf->Cell (1,-60,utf8_decode($asunto),0,0,'C');
for($i=0; $i<100; $i++){
    if($i<50 && $i<strlen($asunto)){
        $acum .= $asunto{$i};
    }else if($i>=strlen($asunto)&&$i==50){
        $pdf->Cell (150,-60,utf8_decode($acum),0,10,'C');
        $acum = '';
    }else if($i<50){
        $acum .= ' ';
    }else if($i>50&&$i<strlen($asunto)){
        //$acum .= $asunto{$i};
    }else if($i>=strlen($asunto)&&$i==99){
        //$pdf->Cell (150 + strlen($reg['asunto']),-50,utf8_decode($acum),0,10,'C');
    }else{
        //$acum .= ' ';
    }
}

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


/*$pdf->Cell (35,10,'Fecha',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['fecha']),1,1,'L');
$pdf->Cell (35,10,'Serie',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['serie']),1,1,'L');
$pdf->Cell (35,10,'Estado',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['estado_ticket']),1,1,'L');
$pdf->Cell (35,10,'Nombre',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['nombre_usuario']),1,1,'L');
$pdf->Cell (35,10,'Email',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['email_usuario']),1,1,'L');
$pdf->Cell (35,10,'Departamento',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['documentType']),1,1,'L');
$pdf->Cell (35,10,'Asunto',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['asunto']),1,1,'L');
$pdf->Cell (35,15,'Problema',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['mensaje']),1,1,'L');
$pdf->Cell (35,15,'Solucion',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['solucion']),1,1,'L');*/

$pdf->Ln();
$pdf->output();