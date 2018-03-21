<?php
// TODO AUTHENTICATE USER

// Required by Google App Engine
libxml_disable_entity_loader(false);

// Load custom service
$location = "http://my-visit-counter.appspot.com/";

// Set Soap timeout
ini_set('default_socket_timeout', 50);
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

$userID = $_POST["userID"];

try {
	$client = new SoapClient(null, array('location'=>$location, 'uri'=>"http://test-uri/", 'trace'=>1));
} catch (SoapFault $error) {
    // FIXME give a formatted error
	echo $error->faultstring;
}

try {
    $client->CrearContador($userID);
    echo "OK: $userID";
} catch (SoapFault $error) {
    // FIXME give a formatted error
    echo 'Error while adding counter: '.$error->faultstring."\n<br>Last SOAP call: ".htmlspecialchars($client->__getLastResponse(), END_QUOTES);
}

?>
