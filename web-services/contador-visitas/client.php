<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="client.php" method="get">
		<label for="qtt">Numero:<br></label>
		<input type="number" name="qtt" required>
		<input type="submit" value="Multiplicar">
	</form>

<?php
// Required by Google App Engine
libxml_disable_entity_loader(false);

// Load custom service
$location = "http://my-visit-counter.appspot.com/";

// Set Soap timeout
ini_set('default_socket_timeout', 50);
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);


$qtt = $_GET["qtt"];

try {
	$client = new SoapClient(null, array('location'=>$location, 'uri'=>"http://test-uri/", 'trace'=>1));
} catch (SoapFault $error) {
	echo $error->faultstring;
}

?>

<p>
<?php
try {
	echo "2 * ".$qtt." = ".$client->multiplica_por_2($qtt);
} catch (SoapFault $error) {
	echo $error->faultstring;
	echo htmlspecialchars($client->__getLastResponse(), END_QUOTES);
}
?>
</p>

</body>
</html>
