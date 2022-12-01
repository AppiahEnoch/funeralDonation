<?php
require_once "config.php";

$delName= cleanInput($_POST['nameToDelete']);




$sql = "DELETE  FROM familymember  where fullname='$delName'";
$result = mysqli_query($conn, $sql);
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