<?php
require_once "config.php";


$return_arr[] = null;

$sql = "SELECT * FROM familymember";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

    $newname= $row ["fullname"];




    $return_arr[] = array("item" => $newname);





  }
  echo json_encode($return_arr);


}

$conn->close();
?> 
