function validate(){

	//Getting all the form values in variables
  	var username = document.getElementById('username');
  	var password = document.getElementById('password');

  	// To check empty form fields
  	if (username.value.length == 0) {
	    alert("Username Required!");
	    username.focus();
	    return false;
	}

	if (password.value.length == 0) {
	    alert("Password Required!");
	  	password.focus();
	  	return false;
	}

	return true;

}