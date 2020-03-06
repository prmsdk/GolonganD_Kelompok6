<?php
session_start();

$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header_remove();
  header("location:index.php");
}

if(isset($_GET['id_bahan'])){
  $id_bahan = $_GET['id_bahan'];

  $data = mysqli_query($con, "SELECT * FROM bahan, kategori_bahan, satuan_bahan WHERE 
  bahan.ID_KAT_BAHAN = kategori_bahan.ID_KAT_BAHAN AND
  bahan.ID_SATUAN = satuan_bahan.ID_SATUAN AND 
  ID_BAHAN = '$id_bahan'");
  $data_bahan = mysqli_fetch_assoc($data);
  $nama_bahan = $data_bahan['NAMA_BAHAN']; 
  $id_satuan_bahan = $data_bahan['ID_SATUAN'];
  $harga_bahan = $data_bahan['HARGA_BAHAN'];
  $kategori_bahan_id = $data_bahan['ID_KAT_BAHAN'];
  $kategori_bahan = $data_bahan['NAMA_KAT_BAHAN'];
}
?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Bahan</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-6">

        <form class="font-m-light col-11 mt-3" action="query/master_bahan_query.php" method="post">
          <input type="hidden" name="id_bahan" id="id" value="<?=$id_bahan?>">
          <div class="form-group">
            <label for="nama_bahan" class="font-m-med">Nama bahan</label>
            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" value="<?=$nama_bahan?>" pattern="[^()/><\][\\\x22,;|]+" title="Masukkan data yang valid" placeholder="Masukkan Nama Bahan" required>
          </div>
          <div class="form-group">
            <label for="satuan_bahan">Satuan Bahan</label>
            <select class="form-control" id="satuan_bahan" name="satuan_bahan">
              <?php 
                $data = mysqli_query($con, "SELECT * FROM satuan_bahan");
                while($data_sat_bahan = mysqli_fetch_assoc($data)){
                $id_sat_bahan = $data_sat_bahan['ID_SATUAN'];
                $nama_sat_bahan = $data_sat_bahan['SATUAN'];
              ?>
              <option value="<?=$id_sat_bahan?>"
              <?php if($id_sat_bahan==$id_satuan_bahan){echo "selected";}?>
              ><?=$nama_sat_bahan?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="harga_bahan" class="font-m-med">Harga bahan</label>
            <input type="number" class="form-control" id="harga_bahan" name="harga_bahan" value="<?=$harga_bahan?>" pattern="[^()/><\][\\\x22,;|]+" title="Masukkan data yang valid" placeholder="Masukkan Harga bahan" required>
          </div>
          <div class="form-group">
            <label for="kategori_bahan">Kategori bahan</label>
            <select class="form-control" id="kategori_bahan" name="kategori_bahan">
              <?php 
                $data = mysqli_query($con, "SELECT * FROM kategori_bahan");
                while($data_kat_bahan = mysqli_fetch_assoc($data)){
                $id_kategori_bahan = $data_kat_bahan['ID_KAT_BAHAN'];
                $nama_kategori_bahan = $data_kat_bahan['NAMA_KAT_BAHAN'];
              ?>
              <option value="<?=$id_kategori_bahan?>" <?php if($id_kategori_bahan==$kategori_bahan_id){echo "selected";}?>><?=$nama_kategori_bahan?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="edit_bahan" value="Simpan">
            <a href="master_bahan.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
          </div>
      </form>
    </div>
  </div>
</div>