function validate(){

	//Getting all the form values in variables
  	var username = document.getElementById('username');
  	var password = document.getElementById('password');

  	// To check empty form fields
  	if (username.value.length == 0) {
	    alert("Username Required!");
	    username.focus();
	    return false;
	}else{
	    if(username.value.length < 4){
	        alert("Username Must Contain At Least 4 Characters!");
	        username.focus();
	        return false;
	    }
	}

	if (password.value.length == 0) {
	    alert("Password Required!");
	  	password.focus();
	  	return false;
	}else{
	    if(password.value.length < 8){
	        alert("Password Must Contain At Least 8 Characters!");
	        password.focus();
	        return false;
	    }
    }

	return true;

}