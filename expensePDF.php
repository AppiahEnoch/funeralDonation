<?php
require_once 'config.php';
require('fpdf/fpdf.php');
header("Content-Type: application/pdf");
error_reporting(E_ERROR| E_PARSE);
$memberList[0]="";
$grandDonors=0;
$grandTotalDonation=0;
$subs=90;
$subsWant=89;


$sumTotal=0;
$numberOfRecord=0;

$ctr=1;



$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

    $memberList[$ctr]=$row["contact"];
    $ctr++;
  }



}

$size=sizeof($memberList);

$pdf = new FPDF();




//Add a new page
$pdf->AddPage();
// Set the font for the text
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100,6,date("l jS \of F Y h:i:s A"));
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(100,6,"FUNERAL EXPENDITURE REPORT");

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);


foreach ($memberList as $value) {

    selectData($value);

    $grandDonors=  $grandDonors+ $numberOfRecord;
    $grandTotalDonation=$grandTotalDonation+$sumTotal;

  }


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(100,6,"SUMMARY OF ALL EXPENSES");
$pdf->Ln();
$pdf->Cell(100,6,"**************************************");
$pdf->Ln();


$pdf->Ln();
$pdf->Cell(50,6,"TOTAL NUMBER OF RECORDED EXPENSES:");
$pdf->Ln();
$pdf->Cell(50,6,"    ".$grandDonors."  EXPENSES");
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(50,6," GRAND TOTAL COST:");
$pdf->Ln();
$pdf->Cell(50,6,"   GHS ".$grandTotalDonation);
$pdf->Ln();



//chmod("REPORT/DONATION_REPORT.pdf", 0755);
  //deleteDirectory('REPORT');
  //mkdir('REPORT');
  
  ob_end_clean();

  $pdf->Output("EXPENDITURE_REPORT.pdf", 'I');
  //$pdf->Output("REPORT/DONATION_REPORT.pdf", 'D');
 
  exit();


$conn->close();




function selectData($contact){
    global $pdf,$conn,$sumTotal,$numberOfRecord,$subs,$subsWant;

    $sumTotal=0;
    $numberOfRecord=0;

$sql = "SELECT * FROM expense where contact='$contact'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row

  $pdf->SetFont('Times', 'BIU', 14);
  $pdf->Cell(50,6,$contact);
  $pdf->Ln();
  $pdf->SetFont('Arial', 'B', 12);

 
  $pdf->Cell(30,6,"ID",1,0);
  $pdf->Cell(30,6,"AMOUNT",1,0);
  $pdf->Cell(92,6,"DESCRIPTION",1,0);
  $pdf->Cell(45,6,"DATE",1,0);
  $pdf->Ln();



  while($row = mysqli_fetch_assoc($result)) {

  
    $amount=$row["amount"];
    $description=$row["description"];
    $recordDate=$row["record_date"];
    $id=$row["id"];

    try {
      $t=(float) $amount;
      $sumTotal= $sumTotal+$t;
    } catch (Throwable $th) {
        //throw $th;
    }
    $numberOfRecord++;
    $shortMember=$description;


    
    if(strlen($description)>$subs){
        $shortMember=substr($description,0,$subsWant);

    }
    



    $pdf->Cell(30,6,$id,1,0);
    $pdf->Cell(30,6,$amount,1,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(92,6,$shortMember,1,0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(45,6,$recordDate,1,0);
    $pdf->Ln();
  }
  $pdf->Ln();
  $pdf->Cell(50,6,"NUMBER OF RECORDS:");
  $pdf->Cell(50,6,$numberOfRecord);
  $pdf->Ln();


  $pdf->Cell(50,6,"TOTAL COST:");
  $pdf->Cell(50,6,$sumTotal);
  $pdf->Ln();


  $pdf->Cell(50,6,$fname);
  $pdf->Ln();
  $pdf->Cell(100,6,"**********************************************************************************************************");
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln();
}

}




function cleanInput($data){
    try {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
      } catch(Exception $e) {

      
        
      }
     return $data;
}








exit;
?>