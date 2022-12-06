<?php  
require_once "config.php";
require 'includes/Exception.php';
require 'includes/SMTP.php';
require 'includes/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$password="usjuggfwmyaybhsq";




$sender="prignutt@gmail.com";
$receiver=$_POST['receiver'];
$subject=$_POST['subject'];
$messageBody="";


$code=createRandomPassword();
$messageBody="HI! \n Your OTP code: ".$code;
// prepare and bind
try{
    

    $stmt = $conn->prepare("INSERT INTO OTP (email,code) VALUES (?, ?)");
    $stmt->bind_param("ss", $receiver, $code);
    
     $stmt->execute();
    
    $stmt->close();
    $conn->close();
        
    }
    catch(Exception $e){
        
    }




$mail=new PHPMailer();
$mail->isSMTP();
$mail->Host="smtp.gmail.com";
$mail->SMTPAuth="true";

$mail->SMTPSecure="tls";
$mail->Port="587";

$mail-> Username=$sender;
$mail-> Password=$password;
$mail->Subject=$subject;

$mail->setFrom($sender);
$mail->Body = $messageBody;
$mail->addAddress($receiver);

if($mail->Send()){
  //echo "mail Sent Successfully!";
}
else{
//echo "error ....";
}

$mail->smtpClose();






function createRandomPassword() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 
  
    while ($i <= 3) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 
  
    return $pass; 
  
  } 



  echo $code;
?>