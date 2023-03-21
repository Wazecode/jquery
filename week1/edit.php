<?php
require_once 'pdo.php';
session_start();

if($_POST['cancel']) {
	header('Location: reg_index.php');
	return;
}

if (isset($_POST['first_name']) &&
	isset($_POST['last_name']) &&
	isset($_POST['email']) &&
	isset($_POST['headline']) &&
	isset($_POST['summary']) 
) {
	$stmt = $pdo->prepare('UPDATE Profile SET 
	first_name = :fn,
	last_name = :ln,
	email = :em,
	headline = :he,
	summary = :su
	WHERE profile_id = :pid');
	
	$stmt->execute(array(
		':fn' => $_POST['first_name'],
		':ln' => $_POST['last_name'],
		':em' => $_POST['email'],
		':he' => $_POST['headline'],
		':su' => $_POST['summary'],
		':pid' => $_POST['pid'])
	);	

	$_SESSION['success'] = 'Record Edited';
	header('Location: reg_index.php');
	return;
}

if(isset($_GET['pid'])) {
	$stmt = $pdo->prepare('SELECT * FROM Profile WHERE profile_id = :pid');
	$stmt->execute(array(
		':pid' => $_GET['pid']
	));
	$profile = $stmt->fetch(PDO::FETCH_ASSOC);

	$fn = htmlentities($profile['first_name']);
	$ln = htmlentities($profile['last_name']);
	$em = htmlentities($profile['email']);
	$he = htmlentities($profile['headline']);
	$su = htmlentities($profile['summary']);
} 
else {
	die('ACCESS DENIED');
}

?>

<html>
<head>
	<title>SHUWAIS SOUDAGER VU21CSCI0100058</title>
</head>
<body>
	<h1>Adding Profile for <?=$_SESSION['name']?></h1>

	<form method="post">
		<p>First Name:
			<input type="text" name="first_name" id="first_name" value="<?=$fn?>" size="60"></p>
		<p>Last Name:
			<input type="text" name="last_name" id="last_name" value="<?=$ln?>" size="60"></p>
		<p>Email:
			<input type="text" name="email" id="email" value="<?=$em?>" size="30"></p>
		<p>Headline:<br>
			<input type="text" name="headline" id="headline" value="<?=$he?>" size="80"></p>
		<p>Summary:<br>
			<textarea name="summary" rows="8" id="summary" cols="80"><?=$su?></textarea>
		</p><p>
			<input type="hidden" name="pid" value="<?= htmlentities($_GET['pid'])?>">
			<input type="submit" value="Edit" onclick="return validate_entry()">
			<input type="submit" name="cancel" value="Cancel">
		</p>
	</form>
<script src="js/validate.js"></script>
</body>
</html>
