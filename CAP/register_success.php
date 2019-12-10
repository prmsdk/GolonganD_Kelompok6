<?php
  include 'includes/config.php';
  require 'includes/header.php';
  $usr_id = $_SESSION['id_user'];

  $data = mysqli_query($con, "select * from user where USER_ID='$usr_id'");
  while($user_data = mysqli_fetch_assoc($data)){
    $nama_user = $user_data['USER_NAMA_LENGKAP'];
    $email_user = $user_data['USER_EMAIL'];
  }
?>

<div class="container container-fluid-lg">
  <div class="row justify-content-center regis-success">
    <div class="col-lg-10 text-center my-4">
      <div class="card shadow">
        <div class="card-header bg-info text-center">
          <h3 class="text-light mb-2">Pesan</h3>
        </div>
        <div class="card-body my-5">
          <h3>Hello, <?=$nama_user?>. Silahkan verifikasi akun anda. </h3>
          <p class="px-2"><small>Anda harus melakukan veifikasi akun untuk memaksimalkan fitur yang kami sediakan. Kami telah mengirimkan email kepada <strong><?=$email_user?></strong> beserta link verifikasi. Jika tidak ada email masuk, dimohon untuk memeriksa <strong>kolom spam</strong> atau <a href="register_resend.php">klik link ini untuk mengirim ulang email verifikasi.</a></small></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  require 'login_user.php';
  require 'includes/footer.php';
?>