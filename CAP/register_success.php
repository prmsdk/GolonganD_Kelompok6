<?php
  require 'includes/header.php';
  include 'includes/config.php';
  session_start();
  $usr_id = $_SESSION['id_user'];

  $data = mysqli_query($con, "select * from user where USER_IDN='$usr_id'");
  while($user_data = mysqli_fetch_array($data)){
    $nama_user = $user_data['USER_NAMA_LENGKAP'];
    $email_user = $user_data['USER_EMAIL'];
  }
?>
<div class="container container-fluid-lg">
  <div class="row justify-content-center regis-success">
    <div class="col-lg-12 my-5 text-center my-auto">
      <h1>Hello, <?=$nama_user?>. Silahkan verifikasi akun anda. </h1>
      <p class="px-5"><small>Anda harus melakukan veifikasi akun untuk memaksimalkan fitur yang kami sediakan. Kami telah mengirimkan email kepada <strong><?=$email_user?></strong> <br>beserta link verifikasi. Jika tidak ada email masuk, dimohon untuk memeriksa <strong>kolom spam</strong> atau <a href="register_resend.php">klik link ini untuk mengirim ulang email verifikasi.</a></small></p>
    </div>
  </div>
</div>
<?php
  require 'login_user.php';
  require 'includes/footer.php';
?>