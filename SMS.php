<?php

require __DIR__ . '/vendor/autoload.php';
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


$message=$_POST["message"];
$receiver=$_POST["receiver"];
$receiver="+233".$receiver;



// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC9832214655b1c69e75ce87c8d4033fe7';
$token = '50388d399b868ec8b6c222a8e605b691';
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
