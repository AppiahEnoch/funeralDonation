<?php
require_once 'config.php';

  
// prepare and bind
try{




    
  $code=createRandomPassword();

  $stmt = $conn->prepare("INSERT INTO _code (code) VALUES (?)");
  $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo $code;

    
}
catch(Exception $e){
    echo $e;
    
}



function createRandomPassword() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 
  
    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 
  
    return $pass; 
  
  } 



    





  
  