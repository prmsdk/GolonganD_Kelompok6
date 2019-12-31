<?php
session_start();

$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_ukuran'])){
  $id_ukuran = $_GET['id_ukuran'];

  $data = mysqli_query($con, "SELECT * FROM ukuran, kategori_ukuran WHERE ukuran.ID_KAT_UKURAN = kategori_ukuran.ID_KAT_UKURAN AND ID_UKURAN = '$id_ukuran'");
  $data_ukuran = mysqli_fetch_assoc($data);
  $jenis_ukuran = $data_ukuran['JENIS_UKURAN']; 
  $harga_ukuran = $data_ukuran['HARGA_UKURAN'];
  $kategori_ukuran = $data_ukuran['NAMA_KAT_UKURAN'];
  $kategori_ukuran_id = $data_ukuran['ID_KAT_UKURAN'];
}
?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Ukuran</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light col-11 mt-3" action="query/master_ukuran_query.php" method="post">
        <input type="hidden" name="id_ukuran" id="id" value="<?=$id_ukuran?>">
        <div class="form-group">
          <label for="jenis_ukuran" class="font-m-med">Jenis Ukuran</label>
          <input type="text" class="form-control" id="jenis_ukuran" name="jenis_ukuran" value="<?=$jenis_ukuran?>" placeholder="Masukkan Jenis Ukuran" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
        </div>
        <div class="form-group">
          <label for="harga_ukuran" class="font-m-med">Harga Ukuran</label>
          <input type="number" class="form-control" id="harga_ukuran" name="harga_ukuran" value="<?=$harga_ukuran?>" placeholder="Masukkan Harga Ukuran" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
        </div>
        <div class="form-group">
          <label for="kategori_ukuran">Kategori Ukuran</label>
          <select class="form-control" id="kategori_ukuran" name="kategori_ukuran">
            <?php 
              $data = mysqli_query($con, "SELECT * FROM kategori_ukuran");
              while($data_kat_ukuran = mysqli_fetch_assoc($data)){
              $id_kategori_ukuran = $data_kat_ukuran['ID_KAT_UKURAN'];
              $nama_kategori_ukuran = $data_kat_ukuran['NAMA_KAT_UKURAN'];
            ?>
            <option value="<?=$id_kategori_ukuran?>" <?php if($id_kategori_ukuran==$kategori_ukuran_id){echo "selected";}?>><?=$nama_kategori_ukuran?></option>
            <?php } ?>
          </select>
        </div>
        <div class="modal-footer text-center">
          <input type="submit" class="btn btn-primary" name="edit_ukuran" value="Simpan">
          <a href="master_ukuran.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
    </form>
    </div>
  </div>
  </div>

<?php
require 'includes/footer.php';
?>