<?php
require_once "config.php";

$username=cleanInput($_POST["username"]);
try {


    $sql = "SELECT * FROM _user WHERE username=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo 1;
        exit;
    }
    else{
      
      
    }
    $sql = "SELECT * FROM `admin` WHERE username=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo 1;
        exit;
    }
    else{
      echo 0;
      
    }

  

} catch (Throwable $th) {

}






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
