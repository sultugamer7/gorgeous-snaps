function validate(){

  //Getting all the form values in variables
  var firstname = document.getElementById('firstname');
  var lastname = document.getElementById('lastname');
  var email = document.getElementById('email');
  var username = document.getElementById('username');
  var password = document.getElementById('password');

  // To check empty form fields
  if (firstname.value.length == 0) {
    alert("First Name Required!");
    firstname.focus();
    return false;
  }else{
    if (inputAlphabet(firstname, "Valid First Name Required!") == false) {
      return false;
    }
  }

  if (lastname.value.length == 0) {
    alert("Last Name Required!");
    lastname.focus();
    return false;
  }else{
    if (inputAlphabet(lastname, "Valid Last Name Required!") == false) {
      return false;
    }
  }

  if (email.value.length == 0) {
    alert("E-Mail Address Required!");
    email.focus();
    return false;
  }if (emailValidation(email) == false) {
    return false;
  }

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


//Function for name validation
function inputAlphabet(inputtext, alertMsg) {
  var alphaExp = /^[a-zA-Z]+$/;
  if (inputtext.value.match(alphaExp)) {
    return true;
  } else {
    alert(alertMsg);
    inputtext.focus();
    return false;
  }
}

//Function for email validation
function emailValidation(inputtext) {
  var emailExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (inputtext.value.match(emailExp)) {
    return true;
  }
    alert("Valid E-Mail Address Required!");
    inputtext.focus();
    return false;
}