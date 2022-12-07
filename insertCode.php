<?php
require_once 'config.php';

$code=createRandomPassword();
$level=$_POST["expense"];
// prepare and bind
try{


    


  $stmt = $conn->prepare("INSERT INTO _code (code,`level`) VALUES (?,?)");
  $stmt->bind_param("ss", $code,$level);
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



    





  
  