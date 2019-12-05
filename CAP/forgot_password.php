<?php
  require 'includes/header.php';
  include 'includes/config.php';
?>

<div class="container container-fluid-lg">
  <div class="row justify-content-center regis-success">
    <div class="col-lg-7 my-5 text-center my-auto">
      <h3>Lupa Password anda? Jangan Khawatir. </h3>
      <p class="mb-3">Masukkan email Anda yang telah terdaftar. <br> Kode untuk mengatur ulang password anda akan dikirim melalui email.</p>
      <form action="register_resend.php" method="post">
        <input type="email" class="form-control w-75 mx-auto mb-2" name="email_user" id="email_user" required placeholder="Masukkan email atau username Anda">
        <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Kirim Kode Verifikasi">
      </form>
    </div>
  </div>
</div>

<?php
  require 'login_user.php';
  require 'includes/footer.php';
?>