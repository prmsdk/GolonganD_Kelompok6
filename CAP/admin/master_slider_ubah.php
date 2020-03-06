<?php
session_start();
$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_slider'])){
  $id_slider = $_GET['id_slider'];

  $data = mysqli_query($con, "SELECT * FROM slider WHERE ID_SLIDER='$id_slider'");
  $data_slider = mysqli_fetch_assoc($data);
  $tombol = $data_slider['TOMBOL'];
  $link = $data_slider['LINK'];
  $desc = $data_slider['DESKRIPSI'];
  $gambar = $data_slider['GAMBAR'];
}

?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Kategori Bahan</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-6">
        <form class="font-m-light" action="query/master_slider_query.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_slider" id="id" value="<?=$id_slider?>">
          <div class="form-group">
            <label>Tombol</label>
            <input type="text" name="tombol" class="form-control" placeholder="Masukkan Tombol" value="<?=$tombol?>" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
          </div>
          <div class="form-group">
            <label>Link</label>
            <input type="text" name="link" class="form-control" placeholder="Masukkan link" value="<?=$link?>" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea type="text" name="deskripsi" class="form-control" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="10" placeholder="Masukkan deskripsi" required><?=$desc?></textarea>
            <label>Tuliskan &lt;br&gt; untuk Enter</label>
          </div>
          <div class="form-group">
            <img class="img-fluid rounded" src="../src/img/slider/<?=$gambar?>" alt="<?=$id_slider?>">
            <div class="custom-file mt-3">
              <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg, .png, .jpeg">
              <label class="custom-file-label" for="inputGroupFile01">Ukuran gambar minimal 1170x500px</label>
              <label for="uploadfile">Unggah file anda dalam format .jpg .jpeg .png <br> (max ukuran file 3mb)</label>
            </div>
          </div>
          <div class="text-left">
            <input type="submit" class="btn btn-primary" name="edit_slider" value="Simpan">
            <a href="master_slider.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
          </div>
        </div>
      </form>
    </div>
  </div>

<?php
  require 'includes/footer.php';
?>
