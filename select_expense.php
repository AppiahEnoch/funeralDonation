<?php
require_once "config.php";

$totalAmount="";
$totalToday="";

try {

  $return_arr[] = null;

  $sql = "SELECT SUM(amount) AS total_amount FROM expense";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    if($row = mysqli_fetch_assoc($result)) {
        $totalAmount= $row ["total_amount"];

    }

  
  
  }
} catch (\Throwable $th) {

}


/*
$sql = "SELECT SUM(amount) AS total_amount FROM `expense_today`";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  if($row = mysqli_fetch_assoc($result)) {

      $totalToday= $row ["total_amount"];


  }



}

*/



echo "$totalToday|$totalAmount";


$conn->close();
?> 
