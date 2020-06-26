<?php 
session_start();
require_once 'vendor/autoload.php'; 
 
use Twilio\Rest\Client; 

$account_sid = 'ACc003825788da58313814ccc9216d6599'; 
$auth_token = '2371bb7b87ac9c0c5e457302b9effcdc'; 
$client = new Client($account_sid, $auth_token); 
 //+13252483102
$messages = $client->messages->create("+13183814187", array( 
        'From' => "+16174058666",
        'Body' => "Whats up mama ji? "
        )
  );