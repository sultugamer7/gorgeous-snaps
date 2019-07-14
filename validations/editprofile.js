// Edit Profile
function validate(){

  //Getting all the form values in variables
  var firstname = document.getElementById('firstname');
  var lastname = document.getElementById('lastname');
  var email = document.getElementById('email');
  var username = document.getElementById('username');
  var bio = document.getElementById('bio');

  // Getting all the data from hidden fields
  var firstname1 = document.getElementById('firstname1');
  var lastname1 = document.getElementById('lastname1');
  var email1 = document.getElementById('email1');
  var username1 = document.getElementById('username1');
  var bio1 = document.getElementById('bio1');

  // Empty fields
  if(firstname.value == "" && lastname.value == "" && email.value == "" && username.value == "" && bio.value == ""){
    alert("No Changes Made!");
    return false;
  }

  // Duplicate values
  if(firstname.value == firstname1.value){
    alert("Duplicate First Name!");
    firstname.focus();
    return false;
  }

  if(lastname.value == lastname1.value){
    alert("Duplicate Last Name!");
    lastname.focus();
    return false;
  }

  if(email.value == email1.value){
    alert("Duplicate E-Mail Address!");
    email.focus();
    return false;
  }

  if(username.value == username1.value){
    alert("Duplicate Username!");
    username.focus();
    return false;
  }

  if(bio.value == bio1.value){
    if(bio.value != ""){
      alert("Duplicate Bio!");
      bio.focus();
      return false;
    }
  }

  // Check each input in the order that it appears in the form.
  if (inputAlphabet(firstname, "Valid First Name Required!")) {
    if (inputAlphabet(lastname, "Valid Last Name Required!")) {
      if (emailValidation(email)) {
        return true;
      }
    }
  }

  return false;

}


//Function for name validation
function inputAlphabet(inputtext, alertMsg) {
  var alphaExp = /^[a-zA-Z]+$|^$/;
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
  var emailExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$|^$/;
  if (inputtext.value.match(emailExp)) {
    return true;
  }
    alert("Valid E-Mail Address Required!");
    inputtext.focus();
    return false;
}

// Change Password
function passwordvalidation(){

  //Getting all the form values in variables
  var password = document.getElementById('password');
  var newpassword = document.getElementById('newpassword');
  var confirmpassword = document.getElementById('confirmpassword');

  // Getting all the data from hidden fields
  var password1 = document.getElementById('password1');

  // Empty fields
  if(password.value == ""){ 
    alert("Current Password Required!");
    password.focus();
    return false;
  }

  if(password.value != password1.value){
    alert("Wrong Password!");
    password.focus();
    return false;
  }


  if(newpassword.value == ""){ 
    alert("New Password Required!");
    newpassword.focus();
    return false;
  }

  if(newpassword.value.length < 8) {
    alert("Password Must Contain At Least 8 Characters!");
    newpassword.focus();
    return false;
  }

  if(password.value == newpassword.value){
    alert("New password must be different than old password!");
    newpassword.focus();
    return false;
  }

  if(confirmpassword.value == ""){ 
    alert("Confirm Your Password!");
    confirmpassword.focus();
    return false;
  }

  if(newpassword.value != confirmpassword.value){
    alert("Password does not match!");
    confirmpassword.focus();
    return false;
  }

  return true;
  
}

// Image validation
function fileCheck() {

  var obj = document.getElementById('uploadedfile').files[0];
  if(!obj){
    alert("Image File Required!");
    return false;
  }else{
    var objname = obj.name;
    var extension = "";
    var i;
    var index;
    for(i=0;i<objname.length;i++){
      if (objname.charAt(i)=='.') {
        index=i+1;
        break;
      }
    }
    for(i=index;i<objname.length;i++){
      extension=extension+objname.charAt(i);
    }
    if(extension=='jpeg' || extension=='jpg' || extension=='png' || extension=='bmp'){
      return true;
    }else{
      alert("Valid .jpeg, .jpg, .png, or .bmp Image File Required!");
      return false;
    }
  }
                
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }else{
    var reader = new FileReader();
    reader.readAsDataURL(input.files[0]);
  }
}

// Account deletion validation
function accountdelete(){

  //Getting all the form values in variables
  var password = document.getElementById('password2');

  // Getting all the data from hidden fields
  var password1 = document.getElementById('password3');

  // Empty fields
  if(password.value == ""){ 
    alert("Password Required!");
    password.focus();
    return false;
  }

  if(password.value != password1.value){
    alert("Wrong Password!");
    password.focus();
    return false;
  }

  var r = confirm("Are you sure?");
  if(r == true){
    return true;
  }else{
    return false;
  }

}