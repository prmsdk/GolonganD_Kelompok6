<?php
session_start();
$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_kategori_bahan'])){
  $id_kategori_bahan = $_GET['id_kategori_bahan'];

  $data = mysqli_query($con, "SELECT * FROM kategori_bahan WHERE ID_KAT_BAHAN='$id_kategori_bahan'");
  $data_kategori_bahan = mysqli_fetch_assoc($data);
  $nama_kategori_bahan = $data_kategori_bahan['NAMA_KAT_BAHAN'];

}

?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Kategori Bahan</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_kategori_bahan_query.php" method="post">
        <input type="hidden" name="id_kategori_bahan" id="id" value="<?=$id_kategori_bahan?>">
        <div class="form-group">
          <label for="nama_kategori_bahan" class="font-m-med">Nama</label>
          <input type="text" class="form-control" id="nama_kategori_bahan" name="nama_kategori_bahan" aria-describedby="usernameHelp" pattern="[^()/><\][\\\x22,;|]+" title="Masukkan data yang valid" placeholder="Masukkan Nama" value="<?=$nama_kategori_bahan?>" required>
        </div>
        <div class="text-left">
          <input type="submit" class="btn btn-primary" name="edit_kategori_bahan" value="Simpan">
          <a href="kategori_bahan.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
      </div>
      </form>
    </div>
    </div>
