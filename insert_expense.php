<?php
require_once 'config.php';




$v1="amount";
$v2="description";



// declare all fields
$amount= cleanInput( $_POST[$v1]);
$description= cleanInput(   $_POST[$v2]);




// array to test post and set status of vital variables
$arrayOfAllNames=[$v1,$v2];

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


session_start();
//$_SESSION["responsible"]="0549822203";
  $person=$_SESSION["CONTACT"];
  
// prepare and bind
try{

$stmt = $conn->prepare("INSERT INTO expense
 (amount, `description`,contact) VALUES (?, ?,?)");
$stmt->bind_param("sss", $amount, $description,$person);
 $stmt->execute();

 echo 1;

$stmt->close();
$conn->close();
    
}
catch(Exception $e){

    
}



  
  