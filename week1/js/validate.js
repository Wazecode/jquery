function validate_login() {
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

function validate_entry() {
	console.log('Validating...');
	var first_name = document.getElementById('first_name').value;
	var last_name = document.getElementById('last_name').value;
	var email = document.getElementById('email').value;
	var headline= document.getElementById('headline').value;
	var summary = document.getElementById('summary').value;

	if(first_name == null || first_name == '' ||
		last_name == null || last_name == '' ||
		email == null || email == '' ||
		headline == null || headline == '' ||
		summary == null || summary == ''
	){

		alert("All fields are required");
		return false;
	} 
	else if(!email.includes('@')) {
		alert('Email address must contain @')
	}
	return true;
}
