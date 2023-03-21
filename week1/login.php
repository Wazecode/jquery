<?php
session_start();
require_once 'pdo.php';


function validate_user($pdo, $mail, $pass) {

	if(strlen($mail) < 1 || strlen($pass) < 1) {
		$_SESSION['error'] = 'Both the field are required';
		return false;
	} 
	elseif(!str_contains($mail, '@')) {
		$_SESSION['error'] = 'Email should contain a (@)';
		return false;
	}

	$salt = 'XyZzy12*_';
	$stmt = $pdo->query('select * from users');
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

	
	foreach($users as $user) {
		if($user['email'] == $mail) {
			if($user['password'] == hash('md5', $salt.$pass)) {
				$_SESSION['name'] = $user['name'];
				$_SESSION['user_id'] = $user['user_id'];
				return true;
			} else {
				$_SESSION['error'] = 'Incorrect Password';
				return false;
			}
		}
	}
	$_SESSION['error'] = 'Email dosen\'t exist';
	return false;

}

if(isset($_POST['email']) || isset($_POST['pass'])) {
	if(isset($_POST['cancel'])) {
		header("Location: index.php");
		return;
	} elseif(validate_user($pdo, $_POST['email'] , $_POST['pass'])) {
		header('Location: reg_index.php');
		return;
	} else {
		header("Location: login.php");
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
	<p style="color: red;">
<?php
if(isset($_SESSION['error'])) {
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
	</p>
	<form method="POST">
		<p>
			Email:
			<input type="text" name="email" id="email">
		</p>
		<p>
			Password:
			<input type="password" name="pass" id="pass">
		</p>
		<input type="submit" name="log" onclick="return validate_login()" value="Log In">
		<input type="submit" name="cancel" value="cancel">
	</form>
	
<script src="js/validate.js"></script>
</body>
</html>
