<?php
require_once "config.php";

$email=cleanInput($_POST["email"]);
try {


    $sql = "SELECT * FROM _user WHERE email=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $username=$row["username"];
        $password=$row["password"];

        echo "$username|$password";
        exit;
    }
    else{
      
      
    }
    $sql = "SELECT * FROM `admin` WHERE email=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $username=$row["username"];
        $password=$row["password"];

        echo "$username|$password";
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
