<?php
/**
 * USER AUTHENTICATION
 */

try {
    include 'auth.php';
} catch (Exception as $e) {
    echo "ERR_: Authentication failed: $e->faultstring";
}


// TODO AUTHENTICATE USER
/* $userID = $_POST["userToken"]; */


/**
 * PERFORM QUERIED ACTION
 */

$action = $_POST["q"];

// Required by Google App Engine
libxml_disable_entity_loader(false);

// Load custom service
$location = "http://my-visit-counter.appspot.com/service.php";

// Set Soap timeout
ini_set('default_socket_timeout', 50);
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

// Connect to the web service
try {
    $client = new SoapClient(null, array('location'=>$location, 'uri'=>"http://test-uri/", 'trace'=>1));
} catch (SoapFault $error) {
    echo "ERR_: Error connecting to the web service. <b>$error->faultstring</b>";
}

switch ($action) {
case 'addCounter':
    try {
        $client->CrearContador($userID);
        echo "_OK_: The counter was correctly added. Refreshing...";
    } catch (SoapFault $error) {
        // FIXME give a formatted error
        echo "WARN: Error adding counter: <b>$error->faultstring</b>";
        /* echo 'Error adding counter: '.$error->faultstring."\n<br>Last SOAP call: ".htmlspecialchars($client->__getLastResponse(), END_QUOTES); */
    }
    break;

case 'deleteCounter':
    try {
        $client->EliminarContador($_POST["counterID"]);
        echo "_OK_: The counter was correctly deleted. Refreshing...";
    } catch (SoapFault $error) {
        // FIXME give a formatted error
        echo "WARN: Error deleting counter: <b>$error->faultstring</b>";
        /* echo 'Error adding counter: '.$error->faultstring."\n<br>Last SOAP call: ".htmlspecialchars($client->__getLastResponse(), END_QUOTES); */
    }
    break;

default:

    echo "ERR_: Error on query: <b>'$action' is not a valid action.</b>";
    break;
}

?>
