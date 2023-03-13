// if(!localStorage.getItem('Auth')){

// location.href= "login.html";
// }

// console.log(localStorage.getItem("Auth"))
let res = JSON.parse(localStorage.getItem("Auth"));
document.getElementById("porifile-email").innerText = res?.email;




 let nameInp = document.getElementById("name");
 let emailInp = document.getElementById("email")
 let ageInp = document.getElementById('age');
// console.log(nameInp)



  $(document).ready(function () {

  //   $(function(){
  //   $("#nav-placeholder").load("index.html");
  // });




    $.ajax({
      url:'php/profile.php',
      method:'GET',
      data:{email:res.email},
    
      success:function(response){
        console.log(response);
        let data = JSON.parse(response);
        nameInp.value = data.name;
        emailInp.value = data.email;
        ageInp.value = data.age;

          // $("#alert").show();
          // $("#result").html(response);
      }
    })


    $("#save").click(function (e) {
      if (document.getElementById("profile-update-from").checkValidity()) {
        e.preventDefault();
        $.ajax({
          url:'php/profile.php',
          method:'post',
          data:$("#profile-update-from").serialize()+'&action=profileUpdate',
    
          success:function(response){
            console.log(response)
              // $("#alert").show();
              $("#result").html(response);
          },
    
    
        })
      }
      return true;
  
    });


  })


