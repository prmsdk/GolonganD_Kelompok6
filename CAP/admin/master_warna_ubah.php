<?php
session_start();

$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_warna'])){
  $id_warna = $_GET['id_warna'];

  $data = mysqli_query($con, "SELECT * FROM warna WHERE ID_WARNA = '$id_warna'");
  $data_warna = mysqli_fetch_assoc($data);
  $jenis_warna = $data_warna['JENIS_WARNA']; 
  $desc_warna = $data_warna['WARNA_DESC'];
  $harga_warna = $data_warna['HARGA_WARNA'];
}
?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data warna</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light col-11 mt-3" action="query/master_warna_query.php" method="post">
        <input type="hidden" name="id_warna" id="id" value="<?=$id_warna?>">
        <div class="form-group">
          <label for="jenis_warna" class="font-m-med">Jenis Warna</label>
          <input type="text" class="form-control" id="jenis_warna" name="jenis_warna" value="<?=$jenis_warna?>" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Jenis warna" required>
        </div>
        <div class="form-group">
          <label for="harga_warna" class="font-m-med">Deskripsi Warna</label>
          <textarea name="desc_warna" id="desc_warna" class="form-control" placeholder="Masukkan Deskripsi Warna . ." pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="5" required><?=$desc_warna?></textarea>
        </div>
        <div class="form-group">
          <label for="harga_warna" class="font-m-med">Harga Warna</label>
          <input type="number" class="form-control" id="harga_warna" name="harga_warna" value="<?=$harga_warna?>" placeholder="Masukkan Harga warna" required>
        </div>
        <div class="modal-footer text-center">
          <input type="submit" class="btn btn-primary" name="edit_warna" value="Simpan">
          <a href="master_warna.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
    </form>
    </div>
  </div>
  </div>

<?php
require 'includes/footer.php';
?>