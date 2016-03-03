function scroll(id){
  $('html, body').animate({scrollTop:$(id).position().top},1500);
}

function registerUser(){
  var url = "Login/registerUser/"+md5('user')+"/"+md5('jsonRegister');

  var inputtedName = document.getElementById('registerName').value;
  var inputtedEmail = document.getElementById('registerEmail').value;
  var inputtedPassword = document.getElementById('registerPassword').value;
  $.post(url,{
    name : inputtedName,
    email : inputtedEmail,
    password : md5(inputtedPassword),
    },function(data){
    if(data.status == true){
      Materialize.toast('Register Succes ', 4000);
      document.getElementById("email").value=inputtedEmail;
    }else{
      Materialize.toast('Register Failed ', 4000);
    }
  });
}

function checkAvaibility(){
  var inputtedEmail = document.getElementById('registerEmail').value;
  var key = event.keyCode || event.charCode;
  if(key != 8 && key != 46){
    if(inputtedEmail.indexOf('@') === -1){
    }else{
      var url = "Login/checkAlreadyRegisteredUser/"+md5('email')+"/"+md5(inputtedEmail)+"/"+md5('jsonRequest');
      $.post(url,{
        email : inputtedEmail
        },function(data){
        if(data.status == true){
          Materialize.toast('Username Telah Terdaftar !', 4000);
          document.getElementById("buttonSubmit").disabled='disabled';
        }else{
          //Materialize.toast('Username Tersedia ', 4000);
          document.getElementById("buttonSubmit").removeAttribute("disabled");
        }
      });
    }
  }
}

$(document).ready(function(){
  $('.parallax').parallax();
  $(".dropdown-button").dropdown();
  $('.modal-trigger').leanModal()
});
