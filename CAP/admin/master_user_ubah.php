<?php
session_start();
if($_SESSION['admin_status']==2){
  header("location:index.php");
}

$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header_remove();
  header("location:index.php");
}

if(isset($_GET['id_user'])){
  $id_user = $_GET['id_user'];

  $data = mysqli_query($con, "SELECT * FROM user WHERE USER_ID='$id_user'");
  $data_user = mysqli_fetch_assoc($data);
  $nama_user = $data_user['USER_NAMA_LENGKAP']; 
  $email_user = $data_user['USER_EMAIL'];
  $no_hp = $data_user['USER_NO_HP'];
  $alamat_user = $data_user['USER_ALAMAT'];
  $username_user = $data_user['USER_USERNAME'];
  $status_user = $data_user['USER_ACTIVE'];
}
?>
  <div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data user</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_user_query.php" method="post">
        <input type="hidden" name="id_user" id="id" value="<?=$id_user?>">
        <div class="form-group">
          <label for="nama-user" class="font-m-med">Nama</label>
          <input type="text" class="form-control" id="nama_user" name="nama_user" aria-describedby="usernameHelp" placeholder="Masukkan Nama" value="<?=$nama_user?>" required pattern="^[A-Za-z -.]+$" title="Mohon masukkan hanya huruf">
        </div>
        <div class="form-group">
          <label for="email-user" class="font-m-med">Email</label>
          <input type="text" class="form-control" id="email_user" name="email_user" aria-describedby="usernameHelp" placeholder="Masukkan Email" value="<?=$email_user?>" required title="Mohon masukkan Email Valid">
        </div>
        <div class="form-group">
          <label for="no-hp-user" class="font-m-med">Nomor Handphone</label>
          <input type="text" class="form-control" id="no_hp_user" name="no_hp_user" aria-describedby="usernameHelp" placeholder="08xx" value="<?=$no_hp?>" required pattern="[0-9]{11,13}" title="Mohon masukkan hanya angka, 11 - 13 digit">
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="alamat-user" class="font-m-med">Alamat</label>
          <textarea name="alamat_user" id="alamat_user" class="form-control" placeholder="Alamat..." minlength=20 title="Mohon masukkan lebih dari 20 character"><?=$alamat_user?></textarea>
        </div>
        <div class="form-group">
          <label for="username-user" class="font-m-med">Username</label>
          <input type="text" class="form-control" id="username_user" name="username_user" aria-describedby="usernameHelp" placeholder="Masukkan Username" value="<?=$username_user?>" required pattern="^[A-Za-z0-9_.]+$" title="Username Format: huruf, angka, ._">
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="radio" id="status_radio1" name="status_user" value="1" <?php if($status_user==1){echo "checked";}?> required>
            <label class="form-check-label" for="status_radio1">
              Aktif
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" id="status_radio2" name="status_user" value="0" <?php if($status_user==0){echo "checked";}?> required>
            <label class="form-check-label" for="status_radio2">
              Tidak Aktif
            </label>
          </div>
        
      </div>
      <div class="text-left">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Simpan">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
  </div>

<?php
require 'includes/footer.php';
?>