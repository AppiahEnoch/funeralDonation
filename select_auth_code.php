<?php
require_once "config.php";

$code=cleanInput($_POST["code"]);
try {


    $sql = "SELECT * FROM _code WHERE code=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo 1;
    }

  
  
  
} catch (Throwable $th) {

}




$sql  =  "DELETE FROM _code WHERE code=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $code);
$stmt->execute();



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
