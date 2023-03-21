<?php
require_once 'pdo.php';
session_start();
if(!isset($_SESSION['name'])) {
	die('Not Logged In');
}
?>

<html>
<head>
	<title>SHUWAIS SOUDAGER VU21CSCI0100058</title>
</head>
<body>
	<h1>Resume Registry</h1>

	<a href="logout.php">Logout</a> <br><br>
<?php
if(isset($_SESSION['error'])) {
	echo '<p style="color: red;">';
	echo $_SESSION['error'];
	echo '</p>';
	unset($_SESSION['error']);
}
if(isset($_SESSION['success'])) {
	echo '<p style="color: green;">';
	echo $_SESSION['success'];
	echo '</p>';
	unset($_SESSION['success']);
}
?>
	<table border="1">
		<tr>
			<th>Name</th>
			<th>Headline</th>
			<th>Action</th>
		</tr>
<?php
$stmt = $pdo->query('select profile_id, first_name, last_name, headline from Profile');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row) {
	echo '<tr>
			<td> <a href="profile_view.php?pid='.htmlentities($row['profile_id']).'">'
				.htmlentities($row['first_name'])." ".htmlentities($row['last_name']).
			'</a></td>
			<td>'.htmlentities($row['headline']).'</td>
			<td>
				<a href="edit.php?pid='.$row['profile_id'].'">Edit</a>
				<a href="delete.php?pid='.$row['profile_id'].'">Delete</a>
			</td>
		</tr>';
}
?>
	</table>
	<br>

	<a href="add.php">Add New Entry</a>
</body>
</html>
