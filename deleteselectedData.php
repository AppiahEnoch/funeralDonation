<?php
require_once "config.php";

$id= cleanInput($_POST['id']);


$sql = "DELETE  FROM donation  where id='$id'";
$result = mysqli_query($conn, $sql);
$conn->close();

echo 1;


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