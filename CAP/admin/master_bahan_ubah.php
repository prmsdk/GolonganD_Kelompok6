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

  $data = mysqli_query($con, "SELECT * FROM bahan, kategori_bahan WHERE bahan.ID_KAT_BAHAN = kategori_bahan.ID_KAT_BAHAN AND ID_BAHAN = '$id_bahan'");
  $data_bahan = mysqli_fetch_assoc($data);
  $nama_bahan = $data_bahan['NAMA_BAHAN']; 
  $satuan_bahan = $data_bahan['SATUAN'];
  $jumlah_satuan = $data_bahan['JUMLAH_SATUAN'];
  $isi_bahan = $data_bahan['ISI_PER_BAHAN'];
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
            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" value="<?=$nama_bahan?>" placeholder="Masukkan Nama Bahan" required>
          </div>
          <div class="form-group">
            <label for="satuan_bahan" class="font-m-med">Satuan bahan</label>
            <input type="text" class="form-control" id="satuan_bahan" name="satuan_bahan" value="<?=$satuan_bahan?>" placeholder="Masukkan Satuan Bahan" required>
          </div>
          <div class="form-group">
            <label for="jumlah_satuan" class="font-m-med">Jumlah Satuan</label>
            <input type="text" class="form-control" id="jumlah_satuan" name="jumlah_satuan" value="<?=$jumlah_satuan?>" placeholder="Masukkan Jumlah Satuan" required>
          </div>
          <div class="form-group">
            <label for="isi_per_bahan" class="font-m-med">Isi per Bahan</label>
            <input type="text" class="form-control" id="isi_per_bahan" name="isi_per_bahan" value="<?=$isi_bahan?>" placeholder="Masukkan Isi per Bahan" required>
          </div>
          <div class="form-group">
            <label for="harga_bahan" class="font-m-med">Harga bahan</label>
            <input type="text" class="form-control" id="harga_bahan" name="harga_bahan" value="<?=$harga_bahan?>" placeholder="Masukkan Harga bahan" required>
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