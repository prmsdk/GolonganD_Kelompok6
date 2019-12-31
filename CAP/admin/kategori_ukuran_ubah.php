<?php
session_start();
$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_kategori_ukuran'])){
  $id_kategori_ukuran = $_GET['id_kategori_ukuran'];

  $data = mysqli_query($con, "SELECT * FROM kategori_ukuran WHERE ID_KAT_UKURAN='$id_kategori_ukuran'");
  $data_kategori_ukuran = mysqli_fetch_assoc($data);
  $nama_kategori_ukuran = $data_kategori_ukuran['NAMA_KAT_UKURAN'];

}

?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Kategori Ukuran</h2>
    </div>
    <div class="row justify-content-center">
    <div class="col-6">
      <form class="font-m-light" action="query/master_kategori_ukuran_query.php" method="post">
        <input type="hidden" name="id_kategori_ukuran" id="id" value="<?=$id_kategori_ukuran?>">
        <div class="form-group">
          <label for="nama_kategori_ukuran" class="font-m-med">Nama</label>
          <input type="text" class="form-control" id="nama_kategori_ukuran" name="nama_kategori_ukuran" aria-describedby="usernameHelp" pattern="[^()/><\][\\\x22,;|]+" title="Masukkan data yang valid" placeholder="Masukkan Nama" value="<?=$nama_kategori_ukuran?>" required>
        </div>
        <div class="text-left">
          <input type="submit" class="btn btn-primary" name="edit_kategori_ukuran" value="Simpan">
          <a href="kategori_ukuran.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
      </div>
      </form>
    </div>
    </div>
<?php
  require 'includes/footer.php';
?>