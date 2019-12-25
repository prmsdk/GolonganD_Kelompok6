<?php
  include 'includes/config.php';
  require 'includes/header.php';
  if(!isset($_POST['submit'])){
?>

<div class="container mt-4 container-fluid-lg" style="height: 75vh;">
  <div class="row justify-content-center regis-success">
    <div class="col-lg-7 text-center">
      <div class="card shadow">
        <div class="card-header">
          <h3>Reset Password Anda. </h3>
        </div>
        <div class="card-body">
          <p class="mb-3 w-75 mx-auto">Masukkan password baru anda. Dimohon password baru tidak sama dengan password sebelumnya.</p>
          <form action="" method="post">
          <input type="password" class="form-control mx-auto w-75" id="password_user" name="password_user" placeholder="Password Baru" aria-describedby="passwordHelp" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" title="Password harus memiliki 1 huruf kapital, 1 huruf kecil dan 1 Angka minimal 8 karakter dan maksimal 32 karakter">
          <p class="text-left w-75 mx-auto"><small id="passwordHelp" class="text-muted">
            Masukkan password harus 8 - 32 karakter.
          </small></p>
          <div class="form-group mx-auto w-75 text-left">
            <label for="repassword_user" class="font-m-semi">Re-Type Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="repassword_user" name="repassword_user" placeholder="Password" aria-describedby="passwordHelp" required title="Masukkan Password yang sama persis dengan password yang anda masukkan diatas">
              <div class="input-group-prepend">
                <div id="retype_password" class="input-group-text bg-light"><i class="fas fa-times text-danger"></i></div>
              </div>
            </div>
            <small id="passwordHelp" class="text-muted">
              Masukkan password yang sama persis untuk kebutuhan validasi.
            </small>
          </div>
          <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Ubah Password">
          </form>
        </div>
      </div>
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
        <div class="col-lg-6 text-center my-4">
          <div class="card shadow">
            <div class="card-header bg-info text-center">
              <h3 class="text-light mb-2">Pesan</h3>
            </div>
            <div class="card-body my-5">
              <p class="px-2" style="font-size: 18pt; line-height:30px;">'.$msg.'</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    ';
  }
  
  require 'login_user.php';
  require 'includes/footer.php';
?>