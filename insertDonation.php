<?php
require_once 'config.php';



$v1="donorName";
$v2="donorMobile";
$v3="donorAmount";
$v4="familyMember";

// declare all fields
$donorName= cleanInput( $_POST[$v1]);
$donorMobile= cleanInput(   $_POST[$v2]);
$donorAmount= cleanInput( $_POST[$v3]);
$familyMember= cleanInput( $_POST[$v4]);



// array to test post and set status of vital variables
$arrayOfAllNames=[$v1,$v3,$v4];

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

$stmt = $conn->prepare("INSERT INTO donation(donor, donormobile, amount,familymember) VALUES (?, ?, ?,?)");
$stmt->bind_param("ssss", $donorName, $donorMobile, $donorAmount,$familyMember);


 $stmt->execute();

 echo 1;


$stmt->close();
$conn->close();
    
}
catch(Exception $e){


  

   
    
}



  
  