<?php
session_start();

$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header_remove();
  header("location:index.php");
}

if(isset($_GET['id_portfolio'])){
  $id_portfolio = $_GET['id_portfolio'];

  $data = mysqli_query($con, "SELECT * FROM portfolio WHERE
  ID_PORTFOLIO = '$id_portfolio'");
  $data_portfolio = mysqli_fetch_assoc($data);
  $judul = $data_portfolio['JUDUL'];
  $deskripsi = $data_portfolio['DESKRIPSI'];
  $gambar = $data_portfolio['GAMBAR'];
}
?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Portfolio</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-8">

        <form class="font-m-light col-11 mt-3" action="query/master_portfolio_query.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_portfolio" id="id" value="<?=$id_portfolio?>">
          <div class="form-group">
            <label for="judul" class="font-m-med">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?=$judul?>" placeholder="Masukkan Judul" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
          </div>
          <div class="form-group">
            <label for="deskripsi" class="font-m-med">Deskripsi</label>
            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="50" required><?=$deskripsi?></textarea>
          </div>
          <div class="form-group">
            <img class="img-fluid rounded" src="../src/img/portfolio/<?=$gambar?>" alt="<?=$id_slider?>">
            <div class="custom-file mt-3">
              <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg, .png, .jpeg">
              <label class="custom-file-label" for="inputGroupFile01">Ukuran gambar minimal 1170x500px</label>
              <label for="uploadfile">Unggah file anda dalam format .jpg .jpeg .png <br> (max ukuran file 10 MB)</label>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="edit_portfolio" value="Simpan">
            <a href="master_portfolio.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
          </div>
      </form>
    </div>
  </div>
</div>