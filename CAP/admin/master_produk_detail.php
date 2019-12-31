<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  if(isset($_GET['id_produk'])){
    $id_produk = $_GET['id_produk'];
  
  //SELECT PRODUK
  $result_produk = mysqli_query($con, "SELECT * FROM tampil_produk, kategori_produk WHERE tampil_produk.ID_KATEGORI = kategori_produk.ID_KATEGORI AND ID_TAMPIL_PRODUK = '$id_produk'");
  $data_produk = mysqli_fetch_assoc($result_produk);
  $nama_produk = $data_produk['NAMA_TAMPIL_PRODUK'];
  $desc_produk = $data_produk['DESC_TAMPIL_PRODUK'];
  $ket_produk = $data_produk['KET_TAMPIL_PRODUK'];
  $nama_kategori = $data_produk['NAMA_KAT_PRODUK'];
  $status_produk = $data_produk['STATUS_TAMPIL_PRODUK'];
  $isi_produk = $data_produk['STATUS_ISI'];
  $isi_custom = $data_produk['BATAS_ISI'];
  $min_pemesanan = $data_produk['MIN_JUMLAH'];

  //SELECT WARNA
  $result_warna = mysqli_query($con, 
  "SELECT warna.JENIS_WARNA FROM tampil_produk, tampil_warna, warna
  WHERE tampil_produk.ID_TAMPIL_PRODUK = tampil_warna.ID_TAMPIL_PRODUK AND
  warna.ID_WARNA = tampil_warna.ID_WARNA AND
  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk'
  ");

  //SELECT KATEGORI UKURAN
  $result_ukuran_kat = mysqli_query($con, 
  "SELECT DISTINCT kategori_ukuran.ID_KAT_UKURAN, kategori_ukuran.NAMA_KAT_UKURAN FROM
  tampil_produk, tampil_ukuran, ukuran, kategori_ukuran 
  WHERE
  tampil_produk.ID_TAMPIL_PRODUK = tampil_ukuran.ID_TAMPIL_PRODUK AND
  tampil_ukuran.ID_UKURAN = ukuran.ID_UKURAN AND
  ukuran.ID_KAT_UKURAN = kategori_ukuran.ID_KAT_UKURAN AND
  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk'
  ");

  //SELECT KATEGORI UKURAN
  $result_bahan_kat = mysqli_query($con, 
  "SELECT DISTINCT kategori_bahan.ID_KAT_BAHAN, kategori_bahan.NAMA_KAT_BAHAN FROM
  tampil_produk, tampil_bahan, bahan, kategori_bahan
  WHERE
  tampil_produk.ID_TAMPIL_PRODUK = tampil_bahan.ID_TAMPIL_PRODUK AND
  tampil_bahan.ID_BAHAN = bahan.ID_BAHAN AND
  bahan.ID_KAT_BAHAN = kategori_bahan.ID_KAT_BAHAN AND
  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk'
  ");

  //SELECT GAMBAR THUMBNAIL
  $result_gambar = mysqli_query($con, "SELECT tampil_produk.NAMA_TAMPIL_PRODUK, gambar_produk.GBR_FILE_NAME FROM
  tampil_produk, gambar_produk
  WHERE
  tampil_produk.ID_TAMPIL_PRODUK = gambar_produk.ID_TAMPIL_PRODUK AND
  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk'
  ");
  }

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<?php
if(isset($_GET['pesan'])){
  if($_GET['pesan']=='sukses_edit'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Berhasil!</strong> mengubah data!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }
}
?>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-2 text-center">
          <h3 class="mt-2 font-weight-bold text-primary"><?=$nama_produk?></h3>
        </div>
        <div class="card-body">
          <div class="row p-2">
            <div class="col-lg">
            <div class="form-group">
              <span class="badge badge-<?php if($status_produk == 1 ){echo "success";}else{echo "danger";}?> p-2"><?php if($status_produk == 1 ){echo "Tersedia";}else{echo "Tidak Tersedia";}?></span>
            </div>
              <h4>Kategori : <?=$nama_kategori?></h4>
              <h4>Deskripsi Produk : </h4>
              <p class="text-justify"><?=$desc_produk?></p>
              <h4>Keterangan Harga : </h4>
              <div class="my-2 overflow-auto"><?php include "../src/file/$ket_produk";?></div>
              <h4>Butuh Isi Produk : <?php if($isi_produk == 0){echo "TIDAK";}else{echo "YA";}?></h4>
              <?php if($isi_produk == 1){?>
              <h4>Batas Isi Produk : <?=$isi_custom?></h4>
              <?php }?>
              <h4>Min Pemesanan : <?=$min_pemesanan?></h4>
            </div>
          </div>
          <hr>
          <div class="row p-2">
            <div class="col-lg">
              <div class="warna">
                <h4>Warna</h4>
                <ul class="list-group">
                <?php $i = 1;
                  while($data_warna = mysqli_fetch_assoc($result_warna)){
                  $jenis_warna = $data_warna['JENIS_WARNA'];
                ?>
                  <li class="list-group-item"><?=$i.". ".$jenis_warna;?></li>
                <?php $i+=1; }?>
                </ul>
              </div>
            </div>
          </div>
          <hr>
          <div class="row p-2">
            <div class="col-lg">
              <div class="ukuran">
                <h4>Ukuran</h4>
                <?php
                  while($data_ukuran_kat = mysqli_fetch_assoc($result_ukuran_kat)){
                    $id_kategori_ukuran = $data_ukuran_kat['ID_KAT_UKURAN'];
                    $nama_kategori_ukuran = $data_ukuran_kat['NAMA_KAT_UKURAN'];
                ?>
                <h5 class="ml-2 mt-1"><?=$nama_kategori_ukuran?></h5>
                <ul class="list-group mb-2">
                <?php 
                  $result_ukuran = mysqli_query($con, 
                  "SELECT ukuran.JENIS_UKURAN FROM tampil_produk, tampil_ukuran, ukuran
                  WHERE tampil_produk.ID_TAMPIL_PRODUK = tampil_ukuran.ID_TAMPIL_PRODUK AND
                  ukuran.ID_UKURAN = tampil_ukuran.ID_UKURAN AND
                  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk' AND
                  ukuran.ID_KAT_UKURAN = '$id_kategori_ukuran'
                  ");

                  $i = 1;
                  while($data_ukuran = mysqli_fetch_assoc($result_ukuran)){
                  $jenis_ukuran = $data_ukuran['JENIS_UKURAN'];
                ?>
                  <li class="list-group-item"><?=$i.". ".$jenis_ukuran;?></li>
                <?php $i+=1; }?>
                </ul>
                <?php } ?>
              </div>
            </div>
          </div>
          <hr>
          <div class="row p-2">
            <div class="col-lg">
              <div class="bahan">
                <h4>Bahan</h4>
                <?php
                  while($data_bahan_kat = mysqli_fetch_assoc($result_bahan_kat)){
                    $id_kategori_bahan = $data_bahan_kat['ID_KAT_BAHAN'];
                    $nama_kategori_bahan = $data_bahan_kat['NAMA_KAT_BAHAN'];
                ?>
                <h5 class=""><?=$nama_kategori_bahan?></h5>
                <ul class="list-group">
                <?php 
                  $result_bahan = mysqli_query($con, 
                  "SELECT bahan.NAMA_BAHAN FROM tampil_produk, tampil_bahan, bahan
                  WHERE tampil_produk.ID_TAMPIL_PRODUK = tampil_bahan.ID_TAMPIL_PRODUK AND
                  bahan.ID_BAHAN = tampil_bahan.ID_BAHAN AND
                  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk' AND
                  bahan.ID_KAT_BAHAN = '$id_kategori_bahan'
                  ");

                  $i = 1;
                  while($data_bahan = mysqli_fetch_assoc($result_bahan)){
                  $jenis_bahan = $data_bahan['NAMA_BAHAN'];
                ?>
                  <li class="list-group-item"><?=$i.". ".$jenis_bahan;?></li>
                <?php $i+=1; }?>
                </ul>
                <?php } ?>
              </div>
            </div>
          </div>
          <hr>
          <div class="thumbnail text-center">
            <h4>Thumbnail Produk</h4>
            <ul class="list-group">
            <?php $i = 1;
              while($data_gambar = mysqli_fetch_assoc($result_gambar)){
              $file_gambar = $data_gambar['GBR_FILE_NAME'];
              $nama_produk = $data_gambar['NAMA_TAMPIL_PRODUK'];
            ?>
              <li class="list-group-item"><img class="m-2" width="300" src="../pictures/produk_thumb/<?=$file_gambar?>" alt="<?=$nama_produk."-".$i?>"></li>
            <?php $i+=1; }?>
            </ul>
          </div>
          <div class="kembali text-center">
            <a href="master_produk.php" class="mt-3 btn btn-primary ">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  

</div>

<?php
  require 'includes/footer.php';
?>