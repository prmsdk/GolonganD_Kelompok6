<?php

include 'includes/config.php';
require 'includes/header.php';

if(isset($_POST['nego'])){

  $id_user = $_POST['id_user'];

  $id_produk = $_POST['id_produk'];
  $id_warna = $_POST['pilihwarna'];
  $id_bahan = $_POST['pilihbahan'];
  $id_ukuran = $_POST['pilihukuran'];
  $nama_produk = $_POST['nama_produk'];
  $status_desain = $_POST['statusdesain'];
  $nama_desain = $_POST['namadesain'];
  $jumlah_produk = $_POST['jumlah_produk'];
  $isi_produk = $_POST['isibahan'];
  $catatan = $_POST['cttwarna1'];

  if(isset($_POST['cttwarna2'])){
    $catatan .= ', '.$_POST['cttwarna2'];
  }

  $ket_pembayaran = $_POST['ket_pembayaran'];
  $sub_total = $_POST['sub_total'];

  $result_ukuran = mysqli_query($con, "SELECT JENIS_UKURAN FROM ukuran WHERE ID_UKURAN = '$id_ukuran'");
  $data_ukuran = mysqli_fetch_assoc($result_ukuran);
  $nama_ukuran = $data_ukuran['JENIS_UKURAN'];

  $result_bahan = mysqli_query($con, "SELECT NAMA_BAHAN FROM bahan WHERE ID_BAHAN = '$id_bahan'");
  $data_bahan = mysqli_fetch_assoc($result_bahan);
  $nama_bahan = $data_bahan['NAMA_BAHAN'];

  $result_warna = mysqli_query($con, "SELECT JENIS_WARNA FROM warna WHERE ID_WARNA = '$id_warna'");
  $data_warna = mysqli_fetch_assoc($result_warna);
  $nama_warna = $data_warna['JENIS_WARNA'];

}

?>

<div class="container container-fluid-md">
  <div class="row p-4 justify-content-center">
    <div class="col-lg-9 col-md-11">
      <div class="card shadow">
        <div class="card-header bg-primary text-center text-light font-weight-bold">
          <h2 style="font-weight:700;">Nego Produk</h2>
        </div>
        <form action="pemesanan_nego_query.php" method="post">
        <div class="card-body px-5">
        <input type="hidden" name="id_user" value="<?=$id_user?>">
        <input type="hidden" name="id_produk" value="<?=$id_produk?>">
        <dl class="row" style="font-weight: 600;">
            <dd class="col-sm-4">Nama Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_produk?></dd>
            <input type="hidden" name="nama_produk" value="<?=$nama_produk?>">

            <dd class="col-sm-4">Ukuran Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_ukuran?></dd>
            <input type="hidden" name="pilihukuran" value="<?=$id_ukuran?>">

            <dd class="col-sm-4">Bahan Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_bahan?></dd>
            <input type="hidden" name="pilihbahan" value="<?=$id_bahan?>">

            <dd class="col-sm-4">Warna Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_warna?></dd>
            <input type="hidden" name="pilihwarna" value="<?=$id_warna?>">

            <dd class="col-sm-4">Isi Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$isi_produk?></dd>
            <input type="hidden" name="isibahan" value="<?=$isi_produk?>">

            <dd class="col-sm-4">Status</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?php if($status_desain==1){echo "Tidak Ada Desain";}else{echo "Ada Desain";}?></dd>
            <input type="hidden" name="pilihdesain" value="<?=$status_desain?>">
            <input type="hidden" name="namadesain" value="<?=$nama_desain?>">

            <dd class="col-sm-4">Keterangan Pembayaran</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?php if($ket_pembayaran==2){echo "Uang Muka";}else{echo "Lunas";}?></dd>
            <input type="hidden" name="ket_pembayaran" value="<?=$ket_pembayaran?>">
            
            <dd class="col-sm-4">Jumlah Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=number_format($jumlah_produk, 0,".",".")?></dd>
            <input type="hidden" name="jumlah_produk" value="<?=$jumlah_produk?>">

            <dd class="col-sm-4">Catatan Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$catatan?></dd>
            <input type="hidden" name="cttwarna1" value="<?=$catatan?>">

            <dd class="col-sm-4">Harga Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5">Rp. <?=number_format($sub_total, 0,".",".")?></dd>
            <input type="hidden" name="sub_total" value="<?=$sub_total?>">

            <div class="col-12 mt-2 form-group">
            <label for="nego_harga">Harga Nego :</label>
            <input type="number" class="form-control w-75" name="nego_harga" id="nego_harga" min="<?php echo ($sub_total*(80/100));?>" max="<?=$sub_total?>" placeholder="Masukkan tawaran harga yang anda inginkan" title="Nego kami buka mulai dari 80% harga produk." required>
            </div>

            <div class="col-12 text-center">
              <input type="submit" class="btn btn-primary px-3" name="nego_tombol" id="nego_tombol" value="Nego">
            </div>
          </dl>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  include 'includes/footer.php';
?>