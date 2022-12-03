<?php
require_once 'config.php';


$memberList[0]="";
$grandDonors=0;
$grandTotalDonation=0;
$subs=10;
$subsWant=9;




$sumTotal=0;
$numberOfDonor=0;

$ctr=1;



$sql = "SELECT * FROM familymember";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

    $memberList[$ctr]=$row["fullname"];
    $ctr++;
  }



}

$size=sizeof($memberList);



//ob_end_clean();
require('fpdf/fpdf.php');
$pdf = new FPDF();




//Add a new page
$pdf->AddPage();
// Set the font for the text
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100,6,date("l jS \of F Y h:i:s A"));
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(100,6,"FUNERAL DONATIONS REPORT");

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);


foreach ($memberList as $value) {

    selectData($value);

    $grandDonors=  $grandDonors+ $numberOfDonor;
    $grandTotalDonation=$grandTotalDonation+$sumTotal;

  }


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(100,6,"SUMMARY OF ALL DONATIONS");
$pdf->Ln();
$pdf->Cell(100,6,"**************************************");
$pdf->Ln();


$pdf->Ln();
$pdf->Cell(50,6,"TOTAL NUMBER OF DONORS:");
$pdf->Ln();
$pdf->Cell(50,6,"    ".$grandDonors."  DONORS");
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(50,6," GRAND TOTAL DONATION:");
$pdf->Ln();
$pdf->Cell(50,6,"   GHS ".$grandTotalDonation);
$pdf->Ln();

  $pdf->Output('MM/DONATION_REPORT.pdf','F');

$conn->close();



function selectData($fname){
    global $pdf,$conn,$sumTotal,$numberOfDonor,$subs,$subsWant;

    $sumTotal=0;
    $numberOfDonor=0;

$sql = "SELECT * FROM donation where familyMember='$fname'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row

  $pdf->SetFont('Times', 'BIU');
  $pdf->Cell(50,6,$fname);
  $pdf->Ln();
  $pdf->SetFont('Arial', 'B', 12);

 
  $pdf->Cell(30,6,"ID",1,0);
  $pdf->Cell(30,6,"DONOR",1,0);
  $pdf->Cell(30,6,"MOBILE",1,0);
  $pdf->Cell(30,6,"AMOUNT",1,0);
  $pdf->Cell(30,6,"MEMBER",1,0);
  $pdf->Cell(45,6,"DATE",1,0);
  $pdf->Ln();



  while($row = mysqli_fetch_assoc($result)) {

    $donorName=$row["donor"];
    $donorMobile=$row["donormobile"];
    $donorAmount=$row["amount"];
    $familyMember=$row["familyMember"];
    $donationDate=$row["donationDate"];
    $id=$row["id"];

    try {
      $t=(float) $donorAmount;
      $sumTotal= $sumTotal+$t;
    } catch (Throwable $th) {
        //throw $th;
    }
    $numberOfDonor++;
    $shortDonor=$donorName;
    $shortMember=$familyMember;

    if(strlen($donorName)>$subs){
        $shortDonor=substr($donorName,0,$subsWant);
 
    }
    
    if(strlen($familyMember)>$subs){
        $shortMember=substr($familyMember,0,$subsWant);

    }
    



    $pdf->Cell(30,6,$id,1,0);
    $pdf->Cell(30,6,$shortDonor,1,0);
    $pdf->Cell(30,6,$donorMobile,1,0);
    $pdf->Cell(30,6,$donorAmount,1,0);
    $pdf->Cell(30,6,$shortMember,1,0);
    $pdf->Cell(45,6,$donationDate,1,0);
    $pdf->Ln();
  



  }
  $pdf->Ln();
  $pdf->Cell(50,6,"NUMBER OF DONORS:");
  $pdf->Cell(50,6,$numberOfDonor);
  $pdf->Ln();


  $pdf->Cell(50,6,"TOTAL DONATION:");
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
?>