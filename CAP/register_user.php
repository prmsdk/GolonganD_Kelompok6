<?php

  require 'includes/header.php';
  if(isset($_GET['pesan'])){
  $msg = $_GET['pesan'];
  $stt = $_GET['status'];
  } 
?>
<div class="bg-daftar py-5">
  <div class="container container-fluid-md font-m-semi font-m-light">
    <div class="row justify-content-center">
      <div class="col-6-lg">
        <div class="card p-4 shadow">
        
          <div class="judul text-center font-m-semi">
            <h2 class="bg-form-daftar" >DAFTAR AKUN</h2>
          </div>
          <?php 
              error_reporting(0);
              if(isset($msg)){  // memeriksa apakah $msg kosong
                echo '<div id="alert-login" class="alert alert-'.$stt.' alert-dismissible fade show position-fixed alert-login mx-auto" role="alert">
                        '.$msg.' 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>'; //menampilkan $msg
              } 
          ?>
          <div class="row">
            <div class="col-lg-6">
              <form class="pt-3" method="post" action="register_query.php">
                <div class="form-group">
                  <label for="nama_user" class="font-m-semi">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukkan Nama Lengkap Anda" required pattern="^[A-Za-z -.]+.{1,}$" title="Masukkan hanya huruf" autofocus>
                </div>
                <div class="form-group">
                  <label for="email_user" class="font-m-semi">Alamat Email</label>
                  <input type="email" class="form-control" id="email_user" name="email_user" aria-describedby="emailHelp" placeholder="Masukkan Alamat Email Anda" required>
                  <small id="emailHelp" class="form-text text-muted">Kita tidak akan menyebarkan email anda kemanapun.</small>
                </div>
                <div class="form-group">
                  <label for="no_hp" class="font-m-semi">Nomor Telepon</label>
                  <input type="text" class="form-control" id="no_hp_user" name="no_hp_user" placeholder="Masukkan Nomor Telepon Anda" required pattern="[0-9]{9,13}" title="Masukkan hanya angka, 9 - 13 digit">
                </div>
            </div>
            <div class="col-lg-6">
              <div class="pt-3"></div>
              <div class="form-group">
                <label for="username_user" class="font-m-semi">Username</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                  </div>
                  <input type="text" class="form-control" id="username_user" name="username_user" placeholder="Isikan Username Anda" required pattern="^[A-Za-z0-9 _.]+$" title="Username Format: huruf, angka, dan ._">
                </div>
              </div>
              <div class="form-group">
                <label for="password_user" class="font-m-semi">Password</label>
                <input type="password" class="form-control" id="password_user" name="password_user" placeholder="Password" aria-describedby="passwordHelp" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" title="Password harus memiliki 1 huruf hapital, 1 huruf kecil dan 1 Angka minimal 8 karakter dan maksimal 32 karakter">
                <small id="passwordHelp" class="text-muted">
                  Masukkan password harus 8 - 32 karakter.
                </small>
              </div>
              <div class="form-group">
                <label for="repassword_user" class="font-m-semi">Re-Type Password</label>
                <input type="password" class="form-control" id="repassword_user" name="repassword_user" placeholder="Password" aria-describedby="passwordHelp" required title="Masukkan Password yang sama persis dengan password yang anda masukkan diatas">
                <small id="passwordHelp" class="text-muted">
                  Masukkan password yang sama persis untuk kebutuhan validasi.
                </small>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="syaratketentuan" required>
                <label class="form-check-label" for="exampleCheck1">Saya setuju dengan <a href="#">Kebijakan & Privasi</a> yang telah ditentukan.</label>
              </div>
              <div class="text-center">
                <input type="submit" name="submit_daftar" class="btn btn-primary" value="DAFTAR">
              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<?php
    
  require 'login_user.php';
  require 'includes/footer.php';

?>