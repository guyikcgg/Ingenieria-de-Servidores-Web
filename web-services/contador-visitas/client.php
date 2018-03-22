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
		var id_token = googleUser.getAuthResponse().id_token;

		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'https://my-visit-counter.appspot.com/ctrlpanel.php');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send('userToken=' + id_token);
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

</body>
</html>
