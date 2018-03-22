<?php
require_once 'vendor/autoload.php';

$CLIENT_ID = '503312404598-np6muhtp10pok057ggbou3l5oihdkm1v.apps.googleusercontent.com';

$id_token = $_COOKIE["id_token"];
if (empty($id_token)) throw new Exception("`id_token` not set");

// Specify the CLIENT_ID of the app that accesses the backend
$authclient = new Google_Client(['client_id' => $CLIENT_ID]);

$payload = $authclient->verifyIdToken($id_token);
if ($payload) {
    $userID = $payload['sub'];
} else {
    throw new Exception("User could not be authenticated");
}
?>
