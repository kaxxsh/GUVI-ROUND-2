if (localStorage.getItem("Auth")) {
  location.href = "profile.html";
}
$(document).ready(function () {
  // validating form inputs ;
  $("#login-form").validate();
  $("#alert").hide();

  $("#login").click(function (e) {
    console.log("login clicked");
    if (document.getElementById("login-form").checkValidity()) {
      console.log("im runing");
      e.preventDefault();
      $.ajax({
        url: "php/login.php",
        method: "post",
        data: $("#login-form").serialize() + "&action=login",
        success: function (response) {
          console.log(response);
          if (response != "Login Failed check your email and password !") {
            // let responseJSON = JSON.parse(response);
            // let {email,password} = responseJSON;
            localStorage.setItem("Auth", response);
            //  console.log(localStorage.getItem("Auth"));
            window.location = "profile.html";
          } else {
            console.log(response);
            $("#alert").show();
            $("#result").html(response);
          }
        },
      });
    }
    return true;
  });
});
