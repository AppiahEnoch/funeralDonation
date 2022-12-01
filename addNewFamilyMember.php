<?php
require_once 'config.php';




$v1="newName";




// declare all fields
$newName= cleanInput( $_POST[$v1]);







// array to test post and set status of vital variables
$arrayOfAllevels=[$v1];

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
function inputsAreCorrect( $arrayOfAllevels) {
    $r=sizeof($arrayOfAllevels)-1;

    
    for ($i = 0; $i <= $r; $i++) {
        $fieldName=$arrayOfAllevels[$i];
     
        try{
            
            
        if (isset($_POST[$fieldName])) {

            if (empty($_POST[$fieldName])) {

               
              
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
  if(!inputsAreCorrect($arrayOfAllevels)){
    exit();
  }



// prepare and bind
try{
    
    $sql = "SELECT * FROM familyMember where fullname='$newName'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      if($row = mysqli_fetch_assoc($result)) {
    
        echo 0;

        exit();
    
      }
    
    
    
    }


 


    
}
catch(Exception $e){
    echo $e;
    
}




// prepare and bind
try{

  $stmt = $conn->prepare("INSERT INTO familymember (fullname) VALUES (?)");
  $stmt->bind_param("s", $newName);
  
  
   $stmt->execute();
  
  $stmt->close();
  $conn->close();
      
  }
  catch(Exception $e){
  
  
    
  
     
      
  }
  







    





  
  