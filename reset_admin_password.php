<?php
require_once 'config.php';


$v1="old_password";
$v2="new_password";
$v3="new_name";

// declare all fields

$old_password= cleanInput($_POST[$v1]);
$new_password= cleanInput( $_POST[$v2]);
$new_name= cleanInput( $_POST[$v3]);



// array to test post and set status of vital variables
$arrayOfAllNames=[$v1,$v2,$v3];

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





// functin to test issetand post variables
function inputsAreCorrect( $arrayOfAllNames) {
    $r=sizeof($arrayOfAllNames)-1;

    
    for ($i = 0; $i <= $r; $i++) {
        $fieldName=$arrayOfAllNames[$i];
     
        try{
            
            
        if (isset($_POST[$fieldName])) {

            if (empty($_POST[$fieldName])) {

                echo  $fieldName;
              
                return false;
                
            }
            
        }
        else{
            
        
            return false;
        } 
        } 
        catch(Exception $e){

            
        }
       
        
      
      }
    
    return true;
  }


  // check to insert data if everything is fine.
  if(!inputsAreCorrect($arrayOfAllNames)){
  
    exit();
  }



  
// prepare and bind
try{

  $stmt = $conn->prepare("SELECT * FROM `admin` WHERE 
  `password`= ?");
  $stmt->bind_param("s", $old_password);
  $stmt->execute();
  //fetching result would go here, but will be covered later
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    
     
  }
  else{
    echo 0;
    exit();
  }



// prepare and bind
try{

    $sql = "UPDATE `admin` SET `password`=?, username=? WHERE `password`=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("sss", $new_password,$new_name,$old_password);
    $stmt->execute();

    echo 1;
    
    $stmt->close();
    $conn->close();
        
    }
    catch(Exception $e){ 
        
    }
    




  
  


  
    
}
catch(Exception $e){
    
}





  
  