<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="google-signin-client_id" content="503312404598-np6muhtp10pok057ggbou3l5oihdkm1v.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body>
	<div class="g-signin2" data-onsuccess="onSignIn"></div>

	<script>
	function onSignIn(googleUser) {
		var profile = googleUser.getBasicProfile();
		var id_token = googleUser.getAuthResponse().id_token;

		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'https://my-visit-counter.appspot.com/auth.php');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			console.log('Signed in as: ' + xhr.responseText);
		};
		xhr.send('idtoken=' + id_token);

		// Log from client-side
		console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
		console.log('Name: ' + profile.getName());
		console.log('Image URL: ' + profile.getImageUrl());
		console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
	}
	</script>

	<a href="#" onclick="signOut();">Sign out</a>
	<script>
	function signOut() {
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
				console.log('User signed out.');
				});
	}
	</script>

	<form action="client.php" method="get">
		<label for="userID">userID</label>
		<input type="text" name="userID" required>
		<input type="submit" value="Listar Contadores">
	</form>

	<form action="client.php" method="get">
		<label for="counterID">counterID</label>
		<input type="number" name="counterID" required>
		<input type="submit" value="Leer Contador">
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


$userID = $_GET["userID"];
$counterID = $_GET["counterID"];

try {
	$client = new SoapClient(null, array('location'=>$location, 'uri'=>"http://test-uri/", 'trace'=>1));
} catch (SoapFault $error) {
	echo $error->faultstring;
}

?>

<p>
<?php
try {
    $a = $client->ListarContadores($userID);
	echo "User[$userID] = ";
    foreach($a as $b) {
        echo "$b<br>\n";
    }
} catch (SoapFault $error) {
	echo $error->faultstring;
	echo htmlspecialchars($client->__getLastResponse(), END_QUOTES);
}
echo "\n<br>\n";
try {
	echo "Counter[$counterID] = ".$client->LeerContador($counterID);
} catch (SoapFault $error) {
	echo $error->faultstring;
	echo htmlspecialchars($client->__getLastResponse(), END_QUOTES);
}
?>
</p>

</body>
</html>
