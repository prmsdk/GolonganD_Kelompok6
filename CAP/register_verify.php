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
          $msg = 'Akun anda telah teraktifasi, Silahkan login dan semoga hari anda menyenangkan';
          session_destroy();
          session_unset();
      }else{
          // No match -> invalid url or account has already been activated.
          $msg = 'Link yang anda masukkan tidak valid atau akun anda telah teraktivasi.';
      }
                  
  }else{
      // Invalid approach
      $msg = 'Link tidak valid, Mohon masukkan link yang telah kami kirimkan ke email anda.';
  }
?>

<div class="container container-fluid-lg">
  <div class="row justify-content-center regis-success">
    <div class="col-lg-6 text-center my-4">
      <div class="card shadow">
        <div class="card-header bg-info text-center">
          <h3 class="text-light">Pesan</h3>
        </div>
        <div class="card-body">
          <h3 class="my-5"><?=$msg?></h3>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  require 'login_user.php';
  require 'includes/footer.php';
?>