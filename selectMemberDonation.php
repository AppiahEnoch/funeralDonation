<?php
require_once "config.php";

$memberName= $_GET["memberName"];

$sql = "SELECT * FROM donation where familyMember='$memberName' ORDER BY donationDate ASC";
 

if($memberName=="To this Family Member"){


    $sql = "SELECT * FROM donation  ORDER BY donationDate ASC";
 
}



try {

  $return_arr[] = null;


 
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

        $id=$row["id"];
        $donorName=$row["donor"];
        $donationAmount=$row["amount"];
        $mobile=$row["donormobile"];
        $member=$row["familyMember"];
        $doDate=$row["donationDate"];
  
        $return_arr[] = array(
            "id" => $id,
            "donor" => $donorName,
            "mobile" => $mobile,
            "amount" => $donationAmount,
            "member" => $member,
            "doDate" => $doDate
        );
    
    
    



    }

    echo json_encode($return_arr);

  
  
  }
} catch (\Throwable $th) {

}



$conn->close();
?> 
