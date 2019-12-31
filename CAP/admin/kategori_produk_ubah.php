<?php
session_start();
$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_kategori_produk'])){
  $id_kategori_produk = $_GET['id_kategori_produk'];

  $data = mysqli_query($con, "SELECT * FROM kategori_produk WHERE ID_KATEGORI='$id_kategori_produk'");
  $data_kategori_produk = mysqli_fetch_assoc($data);
  $nama_kategori_produk = $data_kategori_produk['NAMA_KAT_PRODUK'];

}

?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Admin</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_kategori_produk_query.php" method="post">
        <input type="hidden" name="id_kategori_produk" id="id" value="<?=$id_kategori_produk?>">
        <div class="form-group">
          <label for="nama_kategori_produk" class="font-m-med">Nama</label>
          <input type="text" class="form-control" id="nama_kategori_produk" name="nama_kategori_produk" aria-describedby="usernameHelp" placeholder="Masukkan Nama" pattern="[^()/><\][\\\x22,;|]+" title="Masukkan data yang valid" value="<?=$nama_kategori_produk?>" required>
        </div>
        <div class="text-left">
          <input type="submit" class="btn btn-primary" name="edit_kategori_produk" value="Simpan">
          <a href="kategori_produk.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
      </div>
      </form>
    </div>
    </div>