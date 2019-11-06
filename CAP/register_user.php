<?php

  require 'includes/header.php';

?>
<div class="bg-daftar py-5">
  <div class="container container-fluid-md font-m-semi font-m-light">
    <div class="row justify-content-center">
      <div class="col-7">
        <div class="card p-4 shadow">
          <div class="judul text-center font-m-semi">
            <h2>DAFTAR AKUN</h2>
          </div>
            <form class="bg-form-daftar pt-3">
              <div class="form-group">
                <label for="nama_user" class="font-m-semi">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukkan Nama Lengkap Anda">
              </div>
              <div class="form-group">
                <label for="email_user" class="font-m-semi">Alamat Email</label>
                <input type="email" class="form-control" id="email_user" name="email_user" aria-describedby="emailHelp" placeholder="Masukkan Alamat Email Anda">
                <small id="emailHelp" class="form-text text-muted">Kita tidak akan menyebarkan email anda kemanapun.</small>
              </div>
              <div class="form-group">
                <label for="no_hp" class="font-m-semi">Nomor Telepon</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Telepon Anda">
              </div>
              <div class="form-group">
                <label for="username_user" class="font-m-semi">Username</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                  </div>
                  <input type="text" class="form-control" id="username_user" name="username_user" placeholder="Isikan Username Anda">
                </div>
              </div>
              <div class="form-group">
                <label for="password_user" class="font-m-semi">Password</label>
                <input type="password" class="form-control" id="password_user" name="password_user" placeholder="Password" aria-describedby="passwordHelp" min="8" max="32">
                <small id="passwordHelp" class="text-muted">
                  Masukkan password harus 8 - 32 karakter.
                </small>
              </div>
              <div class="form-group">
                <label for="repassword_user" class="font-m-semi">Re-Type Password</label>
                <input type="password" class="form-control" id="repassword_user" name="repassword_user" placeholder="Password" aria-describedby="passwordHelp" min="8" max="32">
                <small id="passwordHelp" class="text-muted">
                  Masukkan password yang sama persis untuk kebutuhan validasi.
                </small>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Saya setuju dengan <a href="#">Kebijakan & Privasi</a> yang telah ditentukan.</label>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Daftar</button>
              </div>
            </form>
            
        </div>
      </div>
    </div>
  </div>
</div>

<?php

  require 'login_user.php';
  require 'includes/footer.php';

?>