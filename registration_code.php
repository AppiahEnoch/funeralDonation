<?php
require_once 'config.php';


// add pdf class

require('fpdf/fpdf.php');
$pdf = new FPDF();
//Add a new page
$pdf->AddPage();
// Set the font for the text
$pdf->SetFont('Arial', 'B', 10);



$sql = "SELECT * FROM _code";
$stmt = $conn->prepare($sql); 

$stmt->execute();
$result = $stmt->get_result();
$pdf->Cell(100,6,date("l jS \of F Y h:i:s A"));
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(100,6," USER REGISTRATION CODES ");

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
while ($row = $result->fetch_assoc()) {

    $code= $row["code"];
    $level= $row["level"];

    $lv=" ";
    if($level==1){
        $lv="Expense user";
    }

    $pdf->Cell(30,6,$code,1,0);
    $pdf->Cell(30,6,$lv,1,0);
    $pdf->Ln();
   
}


$pdf->Output('Registration_code.pdf','I');

exit;

$conn->close();

function cleanInput($data){
    try {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
      } catch(Exception $e) {

      
        
      }
     return $data;
}



?>