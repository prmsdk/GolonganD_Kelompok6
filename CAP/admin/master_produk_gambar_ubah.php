<?php
session_start();
$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_produk_gambar'])){
  $id_produk_gambar = $_GET['id_produk_gambar'];

  $data = mysqli_query($con, "SELECT * FROM gambar_produk, tampil_produk WHERE 
  gambar_produk.ID_TAMPIL_PRODUK = tampil_produk.ID_TAMPIL_PRODUK AND
  gambar_produk.GBR_ID = '$id_produk_gambar'
  ");
  $data_produk_gambar = mysqli_fetch_assoc($data);
  $id_produk = $data_produk_gambar['ID_TAMPIL_PRODUK'];
  $nama_gambar = $data_produk_gambar['GBR_FILE_NAME'];

}

?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Kategori Ukuran</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_produk_gambar_query.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_gambar" id="id_gambar" value="<?=$id_produk_gambar?>">
        <div class="form-group">
          <label for="id_produk">Kategori Ukuran</label>
          <select class="form-control w-50" id="id_produk" name="id_produk">
            <?php 
              $data = mysqli_query($con, "SELECT * FROM tampil_produk");
              while($data_produk = mysqli_fetch_assoc($data)){
              $id_prd = $data_produk['ID_TAMPIL_PRODUK'];
              $nama_prd = $data_produk['NAMA_TAMPIL_PRODUK'];
            ?>
            <option value="<?=$id_prd?>" <?php if($id_prd==$id_produk){echo "selected";}?>><?=$nama_prd?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="gambar_produk" class="font-m-med">Gambar</label>
          <br>
          <img class="img-fluid mb-3" width="400" src="../pictures/produk_thumb/<?=$nama_gambar?>" alt="<?=$nama_gambar?>">
          <input type="file" name="gambar_produk" id="gambar_produk" accept=".jpg, .png, .jpeg">
        </div>
        <div class="text-left">
          <a href="master_produk_gambar.php" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-left"></i></a>
          <input type="submit" class="btn btn-primary" name="edit_gambar_produk" value="Simpan">
        </div>
      </div>
      </form>
    </div>
    </div>

<?php
require 'includes/footer.php';
?>
