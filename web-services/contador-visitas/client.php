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
$location = "http://localhost:8080/server.php";

// Set Soap timeout
ini_set('default_socket_timeout', 5);

$client = new SoapClient(null, array('location'=>$location, 'uri'=>"http://test-uri/", 'trace'=>1));

$qtt = $_GET["qtt"];
?>

<p>
<?php
echo "2 * ".$qtt." = ".$client->multiplica_por_2($qtt);
?>
</p>

</body>
</html>
