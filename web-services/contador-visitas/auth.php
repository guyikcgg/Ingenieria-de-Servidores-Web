<?php
require_once 'vendor/autoload.php';

$CLIENT_ID = '503312404598-np6muhtp10pok057ggbou3l5oihdkm1v.apps.googleusercontent.com';
// Get $id_token via HTTPS POST.
$id_token = $_POST["userToken"];
if (empty($id_token)) throw new Exception("userToken not received");

$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
$payload = $client->verifyIdToken($id_token);
if ($payload) {
    $userID = $payload['sub'];
    // If request specified a G Suite domain:
    //$domain = $payload['hd'];
    /* echo "USER ID (SERVER SIDE): " . $userid; */
} else {
    // Invalid ID token
    /* echo "INVALID ID TOKEN"; */
    throw new Exception("User could not be identified");
}
?>
