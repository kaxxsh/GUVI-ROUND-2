if (localStorage.getItem("Auth")) {
  location.href = "profile.html";
}

$(document).ready(function () {
  $("#alert").hide();
  $("#register-form").validate({
    rules: {
      cpass: {
        equalTo: "#pass",
      },
    },
  });

  //   submit form without page reload

  $("#Register").click(function (e) {
    if (document.getElementById("register-form").checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "php/register.php",
        method: "post",
        data: $("#register-form").serialize() + "&action=register",
        success: function (response) {
          console.log(response);
          $("#alert").show();
          $("#result").html(response);
        },
      });
    }
    return true;
  });
});
