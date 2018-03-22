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
    function logout() {
        document.cookie = 'id_token=;expires=Wed; 01 Jan 1970';
    }
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

	function onSignIn(googleUser) {
		var id_token = googleUser.getAuthResponse().id_token;

        // Save the token in a cookie
        setCookie("id_token", id_token, 1);

        // Go to Control Panel
        window.location="https://my-visit-counter.appspot.com/ctrlpanel.php";
		/* var xhr = new XMLHttpRequest(); */
		/* xhr.open('POST', 'https://my-visit-counter.appspot.com/auth.php'); */
		/* xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); */
		/* xhr.send('userToken=' + id_token); */
	}
	</script>

	<a href="javascript:logout()" onclick="signOut();">Sign out</a>
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
