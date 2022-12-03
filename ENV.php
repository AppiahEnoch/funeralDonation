<?php

declare(strict_types=1);

require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$sid= $_ENV['TWILIO_ACCOUNT_SID'];
$to= $_ENV['TWILIO_ACCOUNT_SID'];



