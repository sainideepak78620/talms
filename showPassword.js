function showPass(){
  var x = document.getElementById("pass");
  var e = document.getElementById("eye_icon");
  if(x.type == "password"){
    x.type = "text";
    e.className = "fa fa-eye-slash";
  }
  else{
    x.type = "password";
    e.className = "fa fa-eye";
  }
}
