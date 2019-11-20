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

if(isset($_GET['id_warna'])){
  $id_warna = $_GET['id_warna'];

  $data = mysqli_query($con, "SELECT * FROM warna WHERE WARNA_ID='$id_warna'");
  $data_warna = mysqli_fetch_assoc($data);
  $jenis_warna = $data_warna['JENIS_WARNA']; 
  
}
?>
  <div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data warna</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_warna_query.php" method="post">
        <input type="hidden" name="id_warna" id="id" value="<?=$id_warna?>">
        <div class="form-group">
          <label for="jenis-warna" class="font-m-med">jenis wara</label>
          <input type="text" class="form-control" id="jenis_warna" name="jenis_warna" aria-describedby="warnanameHelp" placeholder="Masukkan Nama" value="<?=$jenis_warna?>" required>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="radio" id="status_radio1" name="status_warna" value="1" <?php if($status_warna==1){echo "checked";}?>>
            <label class="form-check-label" for="status_radio1">
              Aktif
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" id="status_radio2" name="status_warna" value="0" <?php if($status_warna==0){echo "checked";}?>>
            <label class="form-check-label" for="status_radio2">
              Tidak Aktif
            </label>
          </div>
        
      </div>
      <div class="text-left">
        <input type="submit" class="btn btn-primary" name="edit_warna" value="Simpan">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
  </div>

<?php
require 'includes/footer.php';
?>