<?php
  session_start();

  $_SESSION['active_link'] = 'pemesanan';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  if(isset($_GET['id_nego'])){
    $id_nego = $_GET['id_nego'];

    $result_nego = mysqli_query($con, "SELECT * FROM nego WHERE ID_NEGO = '$id_nego'");
    $data_nego = mysqli_fetch_assoc($result_nego);

    $id_user = $data_nego['ID_USER'];
    $id_produk = $data_nego['ID_PRODUK'];
    $nama_produk = $data_nego['NAMA_PRODUK'];
    $id_bahan = $data_nego['ID_BAHAN'];
    $id_ukuran = $data_nego['ID_UKURAN'];
    $id_warna = $data_nego['ID_WARNA'];
    $status_desain = $data_nego['STATUS_DESAIN'];
    $nama_desain = $data_nego['UPLOAD_DESAIN'];
    $ket_pembayaran = $data_nego['KET_PEMBAYARAN'];
    $jumlah_produk = $data_nego['JUMLAH_PRODUK'];
    $total = $data_nego['SUB_TOTAL'];
    $tgl_nego = $data_nego['NEGO_TGL'];
    $status_nego = $data_nego['NEGO_STATUS'];
    $harga_nego = $data_nego['NEGO_HARGA'];

    $result_ukuran = mysqli_query($con, "SELECT JENIS_UKURAN FROM ukuran WHERE ID_UKURAN = '$id_ukuran'");
    $data_ukuran = mysqli_fetch_assoc($result_ukuran);
    $nama_ukuran = $data_ukuran['JENIS_UKURAN'];

    $result_bahan = mysqli_query($con, "SELECT NAMA_BAHAN FROM bahan WHERE ID_BAHAN = '$id_bahan'");
    $data_bahan = mysqli_fetch_assoc($result_bahan);
    $nama_bahan = $data_bahan['NAMA_BAHAN'];

    $result_warna = mysqli_query($con, "SELECT JENIS_WARNA FROM warna WHERE ID_WARNA = '$id_warna'");
    $data_warna = mysqli_fetch_assoc($result_warna);
    $nama_warna = $data_warna['JENIS_WARNA'];
    
    $result_user = mysqli_query($con, "SELECT USER_NAMA_LENGKAP FROM user WHERE USER_ID = '$id_user'");
    $data_user = mysqli_fetch_assoc($result_user);
    $nama_user = $data_user['USER_NAMA_LENGKAP'];
  }

?>

<div class="container container-fluid-md">
  <div class="row p-4 justify-content-center">
    <div class="col-lg-9 col-md-11">
      <div class="card shadow">
        <div class="card-header bg-primary text-center text-light font-weight-bold">
          <h2 style="font-weight:700;">Nego Produk</h2>
        </div>
        <form action="query/master_nego_query.php" method="post">
        <div class="card-body px-5">

        <dl class="row" style="font-weight: 600;">
        <input type="hidden" name="id_nego" value="<?=$id_nego?>">
            <dd class="col-sm-4">Status Nego</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><span class="badge badge-<?php if($status_nego == 2 ){echo "success";}else if($status_nego == 1){echo "danger";}else{echo "secondary";}?> p-2"><?php if($status_nego == 2 ){echo "Terverifikasi";}else if($status_nego == 1){echo "Belum Terverifikasi";}else{echo "Kadaluarsa";}?></span></dd>

            <dd class="col-sm-4">Nama User</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_user?></dd>

            <dd class="col-sm-4">Nama Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_produk?></dd>

            <dd class="col-sm-4">Ukuran Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_ukuran?></dd>

            <dd class="col-sm-4">Bahan Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_bahan?></dd>

            <dd class="col-sm-4">Warna Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=$nama_warna?></dd>

            <dd class="col-sm-4">Status</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?php if($status_desain==1){echo "Tidak Ada Desain";}else{echo "Ada Desain";}?></dd>

            <dd class="col-sm-4">Keterangan Pembayaran</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?php if($ket_pembayaran==2){echo "Uang Muka";}else{echo "Lunas";}?></dd>
            
            <dd class="col-sm-4">Jumlah Produk</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5"><?=number_format($jumlah_produk, 0,".",".")?> pcs</dd>

            <dd class="col-sm-4">Harga Awal</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5">Rp. <?=number_format($total, 0,".",".")?></dd>

            <dd class="col-sm-4">Harga Nego</dd>
            <dd class="col-sm-1 text-right">:</dd>
            <dd class="col-sm-5">Rp. <?=number_format($harga_nego, 0,".",".")?></dd>

            <dd class="col-sm-4">Harga Verifikasi Nego</dd>
            <dd class="col-sm-1 text-right">:</dd>

            <div class="col-12 form-group">
            <input type="number" class="form-control w-75" name="nego_harga" id="nego_harga" min="<?php echo ($total*(50/100));?>" max="<?=$total?>" placeholder="Masukkan harga deal dengan customer" required>
            </div>

            <div class="col-12 text-center">
              <input type="submit" class="btn btn-success px-3" name="nego_tombol" id="nego_tombol" value="Verifikasi Harga Nego" <?php if($status_nego!=1){echo "disabled";}?>>
            </div>
          </dl>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  require 'includes/footer.php';
?>