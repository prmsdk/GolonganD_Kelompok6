<?php
  require 'includes/header.php';
  include 'includes/config.php';


  if(isset($_GET['email']) AND isset($_GET['hash'])){
      // Verify data
      $email_user = $_GET['email']; // Set email variable
      $hash = $_GET['hash']; // Set hash variable
                  
      $search = mysqli_query($con, "SELECT USER_EMAIL, USER_HASH, USER_ACTIVE FROM user WHERE USER_EMAIL='$email_user' AND USER_HASH='$hash' AND USER_ACTIVE='0'"); 
      $match  = mysqli_num_rows($search);
                  
      if($match > 0){
          // We have a match, activate the account
          mysqli_query($con, "UPDATE user SET USER_ACTIVE='1' WHERE USER_EMAIL='$email_user' AND USER_HASH='$hash' AND USER_ACTIVE='0'");
          $msg = 'Your account has been activated, you can now login';
      }else{
          // No match -> invalid url or account has already been activated.
          $msg = 'The url is either invalid or you already have activated your account.';
      }
                  
  }else{
      // Invalid approach
      $msg = 'Invalid approach, please use the link that has been send to your email.';
  }
?>

<div class="container container-fluid-lg">
  <div class="row justify-content-center regis-success">
    <div class="col-lg-12 my-5 text-center my-auto">
      <h1> <?=$msg?></h1>
    </div>
  </div>
</div>

<?php
  require 'includes/footer.php';
?>