<?php
require_once 'config.php';





// declare all fields

$mobile= cleanInput($_POST['mobile']);
$email= cleanInput( $_POST['email']);




// array to test post and set status of vital variables


// function to clean user input
function cleanInput($data){
    try {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
      } catch(Exception $e) {

      
        
      }
     return $data;
}





            



$mo=empty(trim($mobile));
$em=empty(trim($email));





// prepare and bind
try{

  if($mo==0&&$em==0){

    $sql = "UPDATE `admin` SET `mobile`=?, email=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ss", $mobile,$email);
    $stmt->execute();

    echo "all";
    
    $stmt->close();
    $conn->close();

    exit;
  }
 elseif($mo==0){

    $sql = "UPDATE `admin` SET `mobile`=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $mobile);
    $stmt->execute();

    echo "mobile";
    
    $stmt->close();
    $conn->close();

    exit;
  }
 elseif($em==0){

    $sql = "UPDATE `admin` SET `email`=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s",$email);
    $stmt->execute();

    echo "email";
    
    $stmt->close();
    $conn->close();

    exit;
  }


        
    }
    catch(Exception $e){ 
        
    }
    




  
  


  





  
  