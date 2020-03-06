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
          <input type="password" class="form-control mx-auto w-75 mb-2" id="password_lama" name="password_lama" placeholder="Password Lama Anda" aria-describedby="passwordHelp" required title="Masukkan password lama anda">
          <input type="password" class="form-control mx-auto w-75" id="password_user" name="password_user" placeholder="Password Baru" aria-describedby="passwordHelp" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" title="Password harus memiliki 1 huruf kapital, 1 huruf kecil dan 1 Angka minimal 8 karakter dan maksimal 32 karakter">
          <p class="text-left w-75 my-1 mb-0 mx-auto"><small id="passwordHelp" class="text-muted">
            Masukkan password harus 8 - 32 karakter.
          </small></p>
          <div class="form-group mx-auto w-75 text-left">
            <div class="input-group">
              <input type="password" class="form-control" id="repassword_user" name="repassword_user" placeholder="Masukkan kembali password baru" aria-describedby="passwordHelp" required title="Masukkan Password yang sama persis dengan password yang anda masukkan diatas">
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
    $password_lama = $_POST['password_lama'];
    $password_user = $_POST['password_user'];
    $repassword_user = $_POST['repassword_user'];

    if(isset($_SESSION['status'])){

      $id_user = $_SESSION['id_user']; // Set email variable
                  
      $search = mysqli_query($con, "SELECT USER_PASSWORD FROM user WHERE USER_ID ='$id_user'"); 
      $user_data = mysqli_fetch_assoc($search);
      $password_lama_database = $user_data['USER_PASSWORD'];

      $password_baru = md5($password_user);

      if(md5($password_lama)==$password_lama_database){

        if(md5($password_lama) != $password_baru){

          if($password_user == $repassword_user){
            $password_user = md5($repassword_user);
            // We have a match, activate the account
            $reset = mysqli_query($con, "UPDATE user SET USER_PASSWORD='$password_user' WHERE USER_ID = '$id_user'");
            if($reset){
              session_unset();
              $msg = 'Password anda telah diubah, silahkan login.';
            }else{
              $msg = 'Terjadi beberapa kendala, harap lapor.';
            }
          }else{
            // No match -> invalid url or account has already been activated.
            $msg = 'Mohon masukkan kedua password baru yang sama persis';
          }
        }else{
          $msg = 'Mohon masukkan password yang berbeda dengan password anda sebelumnya!';
        }
      }else{
        $msg = 'Password lama anda salah!';
      }       
    }else{
      // Invalid approach
      $msg = 'Anda belum melakukan Login.';
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
  
  require 'includes/footer.php';
?>