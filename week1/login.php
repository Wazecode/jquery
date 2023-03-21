<?php
session_start();

if(isset($_POST['cancel'])) {
	header("Location: index.php");
	return;
} else {

	$salt = 'XyZzy12*_';
	$stored_hash = hash('md5', 'XyZzy12*_php123');

	if( isset($_POST['email']) && isset($_POST['pass']) ) {
		if(strlen($_POST['email']) < 1 || 
			strlen($_POST['pass']) < 1) {
			
			$_SESSION['error'] = 'Both Email and Password are required';
		} 
		elseif (strpos($_POST['email'], '@') === false) {
			$_SESSION['error'] = 'Email must contain (@)';
		}
		else {
			$check = hash('md5', $salt.$_POST['pass']);
			if($check == $stored_hash) {
				error_log("Login Success ".$_POST['email']);
				header('Location: registry/index.php');
				return;
			} else {
				$_SESSION['error'] = 'Incorrect Password';
				error_log("Login Failed".$_POST['email']);
			}
		}
		header('Location: login.php');
		return;
	}
}
?>
<html>
<head>
	<title>SHUWAIS SOUDAGER VU21CSCI0100058</title>
</head>
<body>
	<h1>Please Log In</h1>
	<form method="POST">
		<p>
			Email:
			<input type="text" name="email">
		</p>
		<p>
			Password:
			<input type="password" name="pass">
		</p>
		<input type="submit" name="log" value="Log in">
		<input type="submit" name="cancel" value="cancel">
	</form>
</body>
</html>
