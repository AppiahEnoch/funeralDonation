<?php
require_once 'config.php';





$v2="username";
$v3="password";
$pageNumber=0;
// declare all fields

$username= cleanInput($_POST[$v2]);
$password= cleanInput( $_POST[$v3]);





// array to test post and set status of vital variables
$arrayOfAllNames=[$v2,$v3];

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


  $correctInput=false;



  $stmt = $conn->prepare("SELECT * FROM `admin` WHERE 
  username = ? AND `password` = ?");
  $stmt->bind_param("ss", $username,$password);
  $stmt->execute();

  //fetching result would go here, but will be covered later
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
       $n= $row['username'];
       $p= $row['password'];
   
 

      

       session_start();
    $_SESSION["USER"]=$n;

       echo 900;
    
       exit();
     
  }


  
  


  
// prepare and bind



  $stmt = $conn->prepare("SELECT * FROM _user WHERE 
  username = ? AND `password` = ?");
  $stmt->bind_param("ss", $username,$password);
  $stmt->execute();

  //fetching result would go here, but will be covered later
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
       $n= $row['username'];
       $p= $row['password'];
  
       $correctInput=true;


       session_start();
    $_SESSION["USER"]=$n;

    echo 1;
      exit();
     
  }
  else{
  echo 0;
    $correctInput=false;
  }



  $stmt->close();
  $conn->close();
  
    







  
  