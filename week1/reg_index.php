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
			<td> <a href="profile_view.php">'
				.$row['first_name']." ".$row['last_name'].
			'</a></td>
			<td>'.$row['headline'].'</td>
			<td>
				<a href="edit.php">Edit</a>
				<a href="delete.php">Delete</a>
			</td>
		</tr>';
}
?>
	</table>
	<br>

	<a href="../index.php">Logout</a>
	<a href="add.php">Add New Entry</a>
</body>
</html>
