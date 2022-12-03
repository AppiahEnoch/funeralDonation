<?php

try {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "funeraldonation";
    $port = "63947";
   $conn = mysqli_connect($hostname, $username, $password, $database,$port) or die("Database connection failed");
    
} catch (Throwable $th) {
    //throw $th;
}
/*
// heroku
$hostname = "us-cdbr-east-06.cleardb.net";
$username = "b9ff9d2bc7fb7b";
$password = "97ad41ff";
$database = "heroku_a4d6fb937e79fce";
$conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed");

//*/
//*

// railway

/*

$hostname = "containers-us-west-98.railway.app";
$username = "root";
$password = "ismm28lwOe2ySW0pZhpq";
$database = "railway";
$port = "6385";
$conn = mysqli_connect($hostname, $username, $password, $database,$port) or die("Database connection failed");

//*/


/*

$hostname = "containers-us-west-136.railway.app";
$username = "root";
$password = "udP3mK6QMDUpTa6zCfO4";
$database = "railway";
$port = "6760";
$conn = mysqli_connect($hostname, $username, $password, $database,$port) or die("Database connection failed");

//*/
?>