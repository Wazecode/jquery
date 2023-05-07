<?php
require_once 'pdo.php';
session_start();

$logged = isset($_SESSION['name']);

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
		</tr>
<?php
$stmt = $pdo->query('select profile_id, first_name, last_name, headline from Profile');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row) {
	echo '<tr>
			<td> <a href="profile_view.php?pid='.$row['profile_id'].'">'
				.htmlentities($row['first_name'])." ".htmlentities($row['last_name']).
			'</a></td>
			<td>'.htmlentities($row['headline']).'</td>
      ';
  if ($logged) {

        echo '<td>
          <a href="edit.php?pid='.$row['profile_id'].'">Edit</a>
          <a href="delete.php?pid='.$row['profile_id'].'">Delete</a>
        </td>';
  }
		echo '</tr>';
}
?>

</table>
<br>

<p>
<?php
if ($logged) {
  echo '<a href="add.php">Add New Entry</a>';
} else {
  echo '<a href="login.php">Please log in</a>';
}
?>
  <span> \  </span>
	<a href="logout.php">Logout</a> 
</p>

</body>
</html>
