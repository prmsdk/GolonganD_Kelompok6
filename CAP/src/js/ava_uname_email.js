$(document).ready(function(){

  $("#submit_daftar").prop("disabled",true);
  $("#retype_password").hide();
  $("#repassword_user").keyup(function(){

    var repass = $("#repassword_user").val().trim();
    if(repass != ''){
      $("#retype_password").show();

      if($("#password_user").val() != $("#repassword_user").val()){
        $("#retype_password").html("<i class='fas fa-times text-danger'>");
        $("#submit_daftar").prop("disabled",true);
      }else{
        $("#retype_password").html("<i class='fas fa-check text-success'>");
        $("#submit_daftar").prop("disabled",false);
      }
    }else{
      $("#retype_password").hide();
    }
    
  });


  $("#uname_response").hide();
  $("#username_user").keyup(function(){

    var uname = $("#username_user").val().trim();

    if(uname != ''){

        $("#uname_response").show();

        $.ajax({
          url: 'fetch_username_email.php',
          type: 'post',
          data: {uname:uname},
          success: function(response){

              if(response > 0){
                  $("#uname_response").html("<i class='fas fa-times text-danger'>");
                  $("#submit_daftar").prop("disabled",true);
              }else{
                  $("#uname_response").html("<i class='fas fa-check text-success'>");
                  $("#submit_daftar").prop("disabled",false);
              }

            }
        });
    }else{
        $("#uname_response").hide();
    }

  });

  $("#email_response").hide();
  $("#email_user").keyup(function(){

    var email_user = $("#email_user").val().trim();
    console.log(email_user);

    if(email_user != ''){

        $("#email_response").show();

        $.ajax({
          url: 'fetch_username_email.php',
          type: 'post',
          data: {email_user:email_user},
          success: function(response){

              if(response > 0){
                  $("#email_response").html("<i class='fas fa-times text-danger'>");
                  $("#submit_daftar").prop("disabled",true);
              }else{
                  $("#email_response").html("<i class='fas fa-check text-success'>");
                  $("#submit_daftar").prop("disabled",false);
              }

            }
        });
    }else{
        $("#email_response").hide();
    }

  });

});