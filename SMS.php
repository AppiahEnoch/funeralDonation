<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
include __DIR__ . "/vendor/twilio/sdk/src/Twilio/Rest/Client.php";
use Twilio\Rest\Client;



// comment this if you are committing to git  no good
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();






    



 
$sid = $_ENV['TWILIO_ACCOUNT_SID'];
$token = $_ENV['TWILIO_AUTH_TOKEN'];


$message=$_POST["message"];
$receiver=$_POST["receiver"];
$receiver="+233".$receiver;





$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$send=  $client->messages->create(

    $receiver,
    [
      
        'from' => '+16086315728',
     
        'body' => $message
    ]
);


if($send){
    echo "sent";
}
else{
    echo "error";
}
