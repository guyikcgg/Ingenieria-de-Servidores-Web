<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="client.php" method="get">
		<label for="qtt">Numero<br></label>
		<input type="number" name="qtt" required>
		<input type="submit" value="Multiplicar">
	</form>

<?php
// Required by Google App Engine
libxml_disable_entity_loader(false);

// Load Magic Square service
$location = "http://localhost:8000/server.php/";

ini_set('default_socket_timeout', 5);

$client = new SoapClient(null, array('location'=>$location, 'uri'=>"http://test-uri/", 'trace'=>1));

print_r($client->__getFunctions());
echo $client->__getFunctions();
$qtt = $_GET["qtt"];
echo $qtt;

$ret = $client->hola();
//$ret = $client->multiplica_por_2(6);
echo $ret;
?>

<p>
<!--?php
// echo "2 * ".$qtt." = ".$client->multiplica_por_2($qtt);
?-->
</p>

</body>
</html>
