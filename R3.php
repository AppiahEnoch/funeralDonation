<?php
require_once 'config.php';
require('fpdf/fpdf.php');
header("Content-Type: application/pdf");
error_reporting(E_ERROR| E_PARSE);
$donation_list[0]="";
$grandDonors=0;
$grandTotalDonation=0;
$subs=10;
$subsWant=9;


$sumTotal=0;
$numberOfDonor=0;

$ctr=1;


$overallForDonation=0;
$overallNoForDonors=0;
$overallForExpense=0;
$overallNoForExpense=0;



$sql = "SELECT * FROM donation_date";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

    $donation_list[$ctr]=$row["donation_date"];
    $ctr++;
  }



}

$expect_list[0]="";
$grandNoExpense=0;
$grandTotalExpense=0;
$subs2=10;
$subsWant2=9;


$sumTotal2=0;
$numberOfDonor2=0;

$ctr2=1;


$sql = "SELECT * FROM expense_date";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

    $expect_list[$ctr2]=$row["record_date"];

   // echo ": ".$expect_list[$ctr2];
    $ctr2++;
  }



}



$size=sizeof($donation_list);
$size2=sizeof($expect_list);




$pdf = new FPDF();



//Add a new page
$pdf->AddPage();
// Set the font for the text
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100,6,date("l jS \of F Y h:i:s A"));
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(100,6,"FUNERAL SUMMARY REPORT");

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);



foreach ($donation_list as $value) {

    selectData($value);

    $grandDonors=  $grandDonors+ $numberOfDonor;
    $grandTotalDonation=$grandTotalDonation+$sumTotal;

  }

$overallForDonation =$grandTotalDonation;
$overallNoForDonors =$grandDonors;

  foreach ($expect_list as $value2) {
   // echo " : $value2 ".'44';
    selectData2($value2);
   

   $grandNoExpense=  $grandNoExpense+ $numberOfDonor;
    $grandTotalExpense=$grandTotalExpense+$sumTotal;

  }
  
$overallForExpense=$grandTotalExpense;
$overallNoForExpense=$grandNoExpense;


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor(0,0,255);
$pdf->Cell(100,6,"SUMMARY");
$pdf->Ln();

$pdf->Cell(100,6,"--------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();
$pdf->SetTextColor(0,0,0);

$pdf->Ln();
$pdf->Cell(50,6,"TOTAL NUMBER OF DONORS:");
$pdf->Ln();
$pdf->Cell(50,6,"    ".$overallNoForDonors."  DONORS");
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(50,6," GRAND TOTAL DONATION:");
$pdf->Ln();
$pdf->Cell(50,6,"   GHS ".$overallForDonation);
$pdf->Ln();




$pdf->Ln();
$pdf->Cell(50,6,"TOTAL NUMBER OF EXPENSE:");
$pdf->Ln();
$pdf->Cell(50,6,"    ".$overallNoForExpense."  EXPENSES");
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(50,6," GRAND TOTAL EXPENSE:");
$pdf->Ln();
$pdf->Cell(50,6,"   GHS ".$overallForExpense);
$pdf->Ln();




$p=(($overallForDonation) - ($overallForExpense));
$pdf->Ln();


$lb="";
if($p>0){
    $lb="PROFIT ";
    $pdf->SetTextColor(0,0,255);
$pdf->Cell(50,6,"PROFIT");
}
else{
    $lb="DEBT ";
    $pdf->SetTextColor(255,0,0);
    $pdf->Cell(50,6,"DEBT");

}

$pdf->SetTextColor(0,0,0);


$pdf->Ln();
$pdf->Cell(50,6,"   GHS ".$overallForDonation." - ".$overallForExpense);
$pdf->Ln();

if($p>0){
    $pdf->SetTextColor(0,0,255);
}
else {
    $pdf->SetTextColor(255,0,0);
}
$pdf->Cell(50,6,$lb.(($overallForDonation) - ($overallForExpense)));
$pdf->Ln();


//chmod("REPORT/DONATION_REPORT.pdf", 0755);
  //deleteDirectory('REPORT');
  //mkdir('REPORT');
  
  //ob_end_clean();
 $pdf->Output("SUMMARY_REPORT.pdf", 'I');
  //$pdf->Output("REPORT/DONATION_REPORT.pdf", 'D');
 
  


$conn->close();




function selectData($donation_date){
    global $pdf,$conn,$sumTotal,$numberOfDonor,$subs,$subsWant;

    $sumTotal=0;
    $numberOfDonor=0;

$sql = "SELECT * FROM donation where date( donationDate)='$donation_date'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row


  $pdf->SetFont('Times', 'BIU');
  $pdf->Cell(50,6,$donation_date);
  $pdf->Ln();
  $pdf->SetFont('Arial', 'B', 12);

 
  $pdf->Cell(30,6,"ID",1,0);
  $pdf->Cell(30,6,"DONOR",1,0);
  $pdf->Cell(30,6,"MOBILE",1,0);
  $pdf->Cell(30,6,"AMOUNT",1,0);
  $pdf->Cell(30,6,"MEMBER",1,0);

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

    $pdf->Ln();
  }
  $pdf->Ln();
  $pdf->Cell(50,6,"NUMBER OF DONORS:");
  $pdf->Cell(50,6,$numberOfDonor);
  $pdf->Ln();


  $pdf->Cell(50,6,"TOTAL DONATION:");
  $pdf->Cell(50,6,$sumTotal);
  $pdf->Ln();


  $pdf->Cell(50,6,$donation_date);
  $pdf->Ln();
  $pdf->Cell(100,6,"**********************************************************************************************************");
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln();
}

}

function selectData2($value2){
   
   
    global $pdf,$conn,$sumTotal,$numberOfDonor,$subs,$subsWant;

    $sumTotal=0;
    $numberOfDonor=0;
   

    

$sql = "SELECT * FROM expense where date(record_date)='$value2'";


$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row


  $pdf->SetFont('Times', 'BIU');
  $pdf->Cell(50,6,$value2);
  $pdf->Ln();
  $pdf->SetFont('Arial', 'B', 12);

 
  $pdf->Cell(30,6,"ID",1,0);
  $pdf->Cell(30,6,"AMOUNT",1,0);
  $pdf->Cell(90,6,"DESCRIPTION",1,0);
  $pdf->Cell(30,6,"CONTACT",1,0);
  $pdf->Ln();
  while($row = mysqli_fetch_assoc($result)) {

    $id=$row["id"];
    $donorAmount=$row["amount"];
    $familyMember=$row["description"];
    $donorMobile=$row["contact"];

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
    $pdf->Cell(30,6,$donorAmount,1,0);
    $pdf->Cell(90,6,$shortMember,1,0);
    $pdf->Cell(30,6,$donorMobile,1,0);

    $pdf->Ln();
  }
  $pdf->Ln();
  $pdf->Cell(50,6,"NUMBER OF EXPENSE:");
  $pdf->Cell(50,6,$numberOfDonor);
  $pdf->Ln();


  $pdf->Cell(50,6,"TOTAL EXPENSE:");
  $pdf->Cell(50,6,$sumTotal);
  $pdf->Ln();


  $pdf->Cell(50,6,$exp_date);
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