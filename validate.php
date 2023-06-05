<?php
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