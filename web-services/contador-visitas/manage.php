<?php
/**
 * USER AUTHENTICATION
 */

try {
    require 'auth.php';
} catch (Exception $e) {
    echo "ERR_: Authentication failed: ".$e->getMessage();
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
$location = "https://my-visit-counter.appspot.com/service.php";

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
        echo "WARN: Error adding counter: <b>$error->faultstring</b>";
    }
    break;

case 'resetCounter':
    try {
        $client->ResetearContador($_POST["counterID"]);
        echo "_OK_: The counter was correctly reseted to zero. Refreshing...";
    } catch (SoapFault $error) {
        echo "WARN: Error resetting counter: <b>$error->faultstring</b>";
    }
    break;

case 'incrementCounter':
    try {
        $client->IncrementarContador($_POST["counterID"]);
        echo "_OK_: The counter was correctly incremented. Refreshing...";
    } catch (SoapFault $error) {
        echo "WARN: Error incrementing counter: <b>$error->faultstring</b>";
    }
    break;

case 'deleteCounter':
    try {
        $client->EliminarContador($_POST["counterID"]);
        echo "_OK_: The counter was correctly deleted. Refreshing...";
    } catch (SoapFault $error) {
        echo "WARN: Error deleting counter: <b>$error->faultstring</b>";
    }
    break;

case 'editCounter':
    try {
        $client->AsignarContador($_POST["counterID"], $_POST["value"]);
        echo "_OK_: The counter's value was correctly set. Refreshing...";
    } catch (SoapFault $error) {
        echo "WARN: Error setting new value: <b>$error->faultstring</b>";
    }
    break;

default:
    echo "ERR_: Error on query: <b>'$action' is not a valid action.</b>";
    break;
}

?>
