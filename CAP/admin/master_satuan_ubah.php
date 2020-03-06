<?php
session_start();
$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_satuan_bahan'])){
  $id_satuan_bahan = $_GET['id_satuan_bahan'];

  $data = mysqli_query($con, "SELECT * FROM satuan_bahan WHERE ID_SATUAN ='$id_satuan_bahan'");
  $data_satuan_bahan = mysqli_fetch_assoc($data);
  $nama_satuan_bahan = $data_satuan_bahan['SATUAN'];
  $jumlah_satuan_bahan = $data_satuan_bahan['JUMLAH_SATUAN'];

}

?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Satuan Bahan</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_satuan_query.php" method="post">
        <input type="hidden" name="id_satuan" id="id" value="<?=$id_satuan_bahan?>">
        <div class="form-group">
          <label for="nama_satuan_bahan" class="font-m-med">Nama</label>
          <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" aria-describedby="usernameHelp" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Nama" value="<?=$nama_satuan_bahan?>" required>
        </div>
        <div class="form-group">
          <label>Jumlah Satuan</label>
          <input type="number" min="1" name="jumlah_satuan" class="form-control" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Jumlah Satuan" value="<?=number_format($jumlah_satuan_bahan, 0,".",".")?>" required>
        </div>
        <div class="text-left">
          <input type="submit" class="btn btn-primary" name="edit_satuan" value="Simpan">
          <a href="master_satuan.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
      </div>
      </form>
    </div>
    </div>
