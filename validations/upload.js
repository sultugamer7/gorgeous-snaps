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

// Preview Image
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