<?php

require_once 'pdo.php';

if(!isset($_GET['pid'])) {
	die('No Profile to view');
}

$stmt = $pdo->prepare('SELECT * FROM Profile where profile_id = :pid');
$stmt->execute(array(
	':pid' => $_GET['pid']
));
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

$fn = htmlentities($profile['first_name']);
$ln = htmlentities($profile['last_name']);
$em = htmlentities($profile['email']);
$he = htmlentities($profile['headline']);
$su = htmlentities($profile['summary']);
?>

<html>
<head>
	<title>SHUWAIS SOUDAGER VU21CSCI0100058</title>
</head>
<body>
	<h1>Profile information</h1>

	<p>
		First Name: <?=$fn?> <br> <br>
		Last Name: <?=$ln?> <br> <br>
		Emali: <?=$em?> <br> <br>
		Headline:<br> <?=$he?> <br> <br>
		Summary:<br> <?=$su?> <br> <br>

		<a href="reg_index.php">Done</a>
	</p>
</body>
</html>
