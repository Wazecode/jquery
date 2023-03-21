<?php
require_once 'pdo.php';
session_start();
if(!isset($_SESSION['name'])) {
	die('ACCESS DENIED');
}

if(isset($_POST['delete']) && isset($_POST['pid'])) {
	$stmt = $pdo->prepare('DELETE FROM Profile WHERE profile_id = :pid');
	$stmt->execute(array(
		':pid' => $_POST['pid']
	));
	$_SESSION['success'] = 'Profile Deleted';
	header('Location: reg_index.php');
	return;
} 
elseif (isset($_POST['cancel'])) {
	header('Location: reg_index.php');
	return;
}

if(isset($_GET['pid'])) {
	$stmt = $pdo->prepare('select * from Profile where profile_id = :pid');
	$stmt->execute(array(
		':pid' => $_GET['pid']
	));
	$profile = $stmt->fetch(PDO::FETCH_ASSOC);

} else {
	die('ACCESS DENIED');
}
?>

<html>
<head>
	<title>SHUWAIS SOUDAGER VU21CSCI0100058</title>
</head>
<body>
	<h1>Deleting Profile</h1>

	<p>
	First Name: <?= htmlentities($profile['first_name']) ?> <br> <br>
	Last Name: <?= htmlentities($profile['last_name']) ?> 
	</p>

	<form method="POST" >
		<input type="hidden" name="pid" value="<?=$_GET['pid']?>">
		<input type="submit" name="delete" value="Delete">
		<input type="submit" name="cancel" value="Cancel">
	</form>

</body>
</html>

