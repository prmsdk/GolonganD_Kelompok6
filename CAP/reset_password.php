<?php
  require 'includes/header.php';
  include 'includes/config.php';
  if(!isset($_POST['submit'])){
?>

<div class="container container-fluid-lg">
  <div class="row justify-content-center regis-success">
    <div class="col-lg-7 my-5 text-center my-auto">
      <h3>Reset Password Anda. </h3>
      <p class="mb-3 w-75 mx-auto">Masukkan password baru anda. Dimohon password baru tidak sama dengan password sebelumnya.</p>
      <form action="" method="post">
        <input type="password" class="form-control mx-auto w-75" id="password_user" name="password_user" placeholder="Password Baru" aria-describedby="passwordHelp" required>
        <p class="text-left w-75 mx-auto"><small id="passwordHelp" class="text-muted">
          Masukkan password harus 8 - 32 karakter.
        </small></p>
        <input type="password" class="form-control mx-auto w-75" id="repassword_user" name="repassword_user" placeholder="Password" aria-describedby="passwordHelp" required>
        <p class="text-left w-75 mx-auto"><small id="passwordHelp" class="text-muted">
          Masukkan password yang sama persis untuk kebutuhan validasi.
          </small></p>
        <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Ubah Password">
      </form>
    </div>
  </div>
</div>

<?php
  }else if(isset($_POST['submit'])){
    $password_user = $_POST['password_user'];
    $repassword_user = $_POST['repassword_user'];

    if(isset($_GET['email']) AND isset($_GET['hash'])){
      // Verify data
      $email_user = $_GET['email']; // Set email variable
      $hash = $_GET['hash']; // Set hash variable
                  
      $search = mysqli_query($con, "SELECT USER_EMAIL, USER_HASH, USER_PASSWORD FROM user WHERE USER_EMAIL='$email_user' AND USER_HASH='$hash'"); 
      $match  = mysqli_num_rows($search);
      $user_data = mysqli_fetch_array($search);
      $password_lama = $user_data['USER_PASSWORD'];
      var_dump($password_lama);

      $password_baru = md5($password_user);

      if($password_lama!=$password_baru){
        if($match > 0 AND $password_user == $repassword_user){
          $password_user = md5($repassword_user);
          // We have a match, activate the account
          mysqli_query($con, "UPDATE user SET USER_PASSWORD='$password_user' WHERE USER_EMAIL='$email_user' AND USER_HASH='$hash'");
          $msg = 'Password anda telah diubah, silahkan login.';
        }else{
          // No match -> invalid url or account has already been activated.
          $msg = 'Mohon masukkan kedua password yang sama persis';
        }
      }else{
        $msg = 'Mohon masukkan password yang berbeda dengan password anda sebelumnya!';
      }       
    }else{
      // Invalid approach
      $msg = 'Link yang anda tuju tidak Valid, coba periksa kembali email anda.';
    }

    echo '
    <div class="container container-fluid-lg">
      <div class="row justify-content-center regis-success">
        <div class="col-lg-12 my-5 text-center my-auto">
          <h1> '.$msg.'</h1>
          <a href="index.php">Kembali ke Home</a>
        </div>
      </div>
    </div>
    ';
  }
  
  require 'login_user.php';
  require 'includes/footer.php';
?>