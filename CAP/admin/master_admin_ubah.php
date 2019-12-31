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

  if(isset($_GET['id_admin'])){
    $id_admin = $_GET['id_admin'];

    $data = mysqli_query($con, "SELECT * FROM admin WHERE ADM_ID='$id_admin'");
    $data_admin = mysqli_fetch_assoc($data);
    $nama_admin = $data_admin['ADM_NAMA_USAHA_ADM']; 
    $email_admin = $data_admin['ADM_EMAIL'];
    $no_hp = $data_admin['ADM_NO_HP'];
    $no_telp = $data_admin['ADM_NO_TELP'];
    $alamat_admin = $data_admin['ADM_ALAMAT'];
    $username_admin = $data_admin['ADM_USERNAME'];
    $status_admin = $data_admin['ADM_STATUS'];
}
?>
  <div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Admin</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_admin_query.php" method="post">
        <input type="hidden" name="id_admin" id="id" value="<?=$id_admin?>">
        <div class="form-group">
          <label for="nama-admin" class="font-m-med">Nama</label>
          <input type="text" class="form-control" id="nama_admin" name="nama_admin" aria-describedby="usernameHelp" placeholder="Masukkan Nama" value="<?=$nama_admin?>" required pattern="^[A-Za-z -.]+$" title="Mohon masukkan hanya huruf">
        </div>
        <div class="form-group">
          <label for="email-admin" class="font-m-med">Email</label>
          <input type="text" class="form-control" id="email_admin" name="email_admin" aria-describedby="usernameHelp" placeholder="Masukkan Email" value="<?=$email_admin?>" required title="Mohon masukkan Email Valid">
        </div>
        <div class="form-group">
          <label for="no-telp-admin" class="font-m-med">Nomor Telepon</label>
          <input type="text" class="form-control" id="no_telp_admin" name="no_telp_admin" aria-describedby="usernameHelp" placeholder="(0331) xxx" value="<?=$no_telp?>" required pattern="[0-9 ()]{12,13}" title="Mohon masukkan hanya angka dan ( ), 12 - 13 digit">
        </div>
        <div class="form-group">
          <label for="no-hp-admin" class="font-m-med">Nomor Handphone</label>
          <input type="text" class="form-control" id="no_hp_admin" name="no_hp_admin" aria-describedby="usernameHelp" placeholder="08xx" value="<?=$no_hp?>" required pattern="[0-9]{9,13}" title="Mohon masukkan hanya angka, 9 - 13 digit">
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="alamat-admin" class="font-m-med">Alamat</label>
          <textarea name="alamat_admin" id="alamat_admin" class="form-control" placeholder="Alamat..." required minlength=20 title="Mohon masukkan lebih dari 20 character"><?=$alamat_admin?></textarea>
        </div>
        <div class="form-group">
          <label for="username-admin" class="font-m-med">Username</label>
          <input type="text" class="form-control" id="username_admin" name="username_admin" aria-describedby="usernameHelp" placeholder="Masukkan Username" value="<?=$username_admin?>" required pattern="^[A-Za-z0-9@_.]+$" title="Username Format: huruf, angka, ._@">
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="radio" id="status_radio1" name="status_admin" value="1" <?php if($status_admin==1){echo "checked";}?> required>
            <label class="form-check-label" for="status_radio1">
              Super Admin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" id="status_radio2" name="status_admin" value="2" <?php if($status_admin==2){echo "checked";}?> required>
            <label class="form-check-label" for="status_radio2">
              Admin
            </label>
          </div>
        
      </div>
      <div class="text-left">
        <input type="submit" class="btn btn-primary" name="edit_admin" value="Simpan">
        <a href="master_admin.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
      </div>
    </div>
    </form>
  </div>
  </div>

<?php
require 'includes/footer.php';
?>