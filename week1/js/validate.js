function validate() {
	console.log('Validating...');
	var email = document.getElementById('email').value;
	var pass = document.getElementById('pass').value;

	if(email == null || pass == null || email == '' || pass == '') {
		alert('Both fields must be filled out');
		return false;
	} else if (!email.includes('@')) {
		alert('Email must contain (@)');
		return false;
	}
	return true;
}
