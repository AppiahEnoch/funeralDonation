<?php
require_once 'config.php';


$memberList[0]="";

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
echo $size;

exit();




$level=cleanInput($_POST["level"]);
$code="";
$staffID="";

// add pdf class
ob_end_clean();
require('fpdf/fpdf.php');
$pdf = new FPDF();
//Add a new page
$pdf->AddPage();
// Set the font for the text
$pdf->SetFont('Arial', 'B', 10);



$sql = "SELECT * FROM authentication WHERE level=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $level);
$stmt->execute();
$result = $stmt->get_result();
$pdf->Cell(100,6,date("l jS \of F Y h:i:s A"));
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(100,6,"LEVEL ".$level." AUTHENTICATION CODES");

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
while ($row = $result->fetch_assoc()) {
    $staffID= $row["staffID"];
    $code= $row["code"];

    
    $pdf->Cell(80,6,$staffID,1,0);
    $pdf->Cell(80,6,$code,1,0);
    $pdf->Ln();


  
  
  
   
   
}

$pdf->Output('F', 'AUTHENTICATION_CODES.pdf');

echo $code;









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