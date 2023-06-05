<?php
require_once 'pdo.php';
session_start();

if($_POST['cancel']) {
	header('Location: index.php');
	return;
}

if (isset($_POST['first_name']) &&
	isset($_POST['last_name']) &&
	isset($_POST['email']) &&
	isset($_POST['headline']) &&
	isset($_POST['summary']) 
) {

	if(strlen($_POST['first_name']) < 1 ||
		strlen($_POST['last_name']) < 1||
		strlen($_POST['email']) < 1 ||
		strlen($_POST['headline']) < 1 ||
		strlen($_POST['summary']) < 1 

	){
		$_SESSION['error'] = 'All fields are required';
		header('Location: add.php');
		return;
	}
	elseif(!str_contains($_POST['email'], '@')) {
		$_SESSION['error'] = 'Email must contain (@)';
		header('Location: add.php');
		return;

	} else {
	$stmt = $pdo->prepare('INSERT INTO Profile
		(user_id, first_name, last_name, email, headline, summary)
		VALUES ( :uid, :fn, :ln, :em, :he, :su)');
	
	$stmt->execute(array(
		':uid' => $_SESSION['user_id'],
		':fn' => $_POST['first_name'],
		':ln' => $_POST['last_name'],
		':em' => $_POST['email'],
		':he' => $_POST['headline'],
		':su' => $_POST['summary'])
	);	

	$_SESSION['success'] = 'Record Added';
	header('Location: index.php');
	return;
	
	}
}
?>

<html>
<head>
	<title>SHUWAIS SOUDAGER VU21CSCI0100058</title>
</head>
<body>
	<h1>Adding Profile for <?=$_SESSION['name']?></h1>

<?php
if(isset($_SESSION['error'])) {
	echo '<p style="color: red;">';
	echo $_SESSION['error'];
	echo '</p>';
	unset($_SESSION['error']);
}
?>
	<form method="post">
		<p>First Name:
			<input type="text" name="first_name" id="first_name" size="60"></p>
		<p>Last Name:
			<input type="text" name="last_name" id="last_name" size="60"></p>
		<p>Email:
			<input type="text" name="email" id="email" size="30"></p>
		<p>Headline:<br>
			<input type="text" name="headline" id="headline" size="80"></p>
		<p>Summary:<br>
			<textarea name="summary" rows="8" id="summary" cols="80"></textarea>
		</p><p>
			<input type="submit" value="Add" onclick="return validate_entry()">
			<input type="submit" name="cancel" value="Cancel">
		</p>
	</form>
<script src="js/validate.js"></script>
</body>
</html>
