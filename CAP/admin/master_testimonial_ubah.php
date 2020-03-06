<?php
session_start();

$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header_remove();
  header("location:index.php");
}

if(isset($_GET['id_testimonial'])){
  $id_testi= $_GET['id_testimonial'];

  $data = mysqli_query($con, "SELECT * FROM testimonial WHERE
  ID_TESTI = '$id_testi'");
  $data_testimonial = mysqli_fetch_assoc($data);
  $nama_testi = $data_testimonial['TESTI_NAMA'];
  $profesi_testi = $data_testimonial['TESTI_PROFESI'];
  $deskripsi_testi = $data_testimonial['TESTI_DESC'];
  $gambar_testi = $data_testimonial['TESTI_FOTO'];
}
?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data testimonial</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-8">

        <form class="font-m-light col-11 mt-3" action="query/master_testimonial_query.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_testi" id="id" value="<?=$id_testi?>">
          <div class="form-group">
            <label for="nama" class="font-m-med">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?=$nama_testi?>" placeholder="Masukkan Nama" pattern="[^0-9()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
          </div>
          <div class="form-group">
            <label for="profesi" class="font-m-med">Profesi</label>
            <input type="text" class="form-control" id="profesi" name="profesi" value="<?=$profesi_testi?>" placeholder="Masukkan Profesi" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
          </div>
          <div class="form-group">
            <label for="deskripsi" class="font-m-med">Deskripsi</label>
            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="10" required><?=$deskripsi_testi?></textarea>
          </div>
          <div class="form-group">
            <img class="img-fluid rounded" src="../src/img/testimonial/<?=$gambar_testi?>" alt="<?=$id_testi?>">
            <div class="custom-file mt-3">
              <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg, .png, .jpeg">
              <label class="custom-file-label" for="inputGroupFile01">Ukuran gambar minimal 1170x500px</label>
              <label for="uploadfile">Unggah file anda dalam format .jpg .jpeg .png <br> (max ukuran file 3 MB)</label>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="edit_testimonial" value="Simpan">
            <a href="master_testimonial.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
          </div>
      </form>
    </div>
  </div>
</div>

<?php
  include 'includes/footer.php';
?>