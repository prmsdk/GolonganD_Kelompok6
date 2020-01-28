<?php
  session_start();
  if($_SESSION['admin_status']==2){
    header("location:index.php");
  }

  $_SESSION['active_link'] = 'pemesanan';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  if(isset($_GET['id_pesanan'])){
    $id_pesanan = $_GET['id_pesanan'];

    $update_notif = mysqli_query($con, "UPDATE pesanan SET ADMIN_NOTIF = 1 WHERE ID_PESANAN = '$id_pesanan'");
  
    $result_pesanan = mysqli_query($con, "SELECT
    user.USER_NAMA_LENGKAP,	pesanan.ANTRIAN,
    cast(pesanan.TANGGAL_PESANAN as date) as TANGGAL_PESANAN, 
    pesanan.TOTAL_HARGA, pesanan.STATUS_PESANAN, pesanan.BUKTI_TRANSFER,

    CASE 
    WHEN pesanan.STATUS_PESANAN = 1 THEN 'Sedang Menunggu Bukti Transfer' 
    WHEN pesanan.STATUS_PESANAN = 2 THEN 'Sedang Menunggu Antrian'
    WHEN pesanan.STATUS_PESANAN = 3 THEN 'Sedang Dalam Proses' 
    WHEN pesanan.STATUS_PESANAN = 4 THEN 'Telah Selesai Dikerjakan'
    WHEN pesanan.STATUS_PESANAN = 5 THEN 'Sedang Dalam Pengiriman' 
    WHEN pesanan.STATUS_PESANAN = 6 THEN 'Dibatalkan'
    WHEN pesanan.STATUS_PESANAN = 7 THEN 'Bukti TF Anda Salah'
    WHEN pesanan.STATUS_PESANAN = 8 THEN 'Nominal Bayar Salah'
    
    END AS KET_STATUS

    FROM pesanan,user

    WHERE
    pesanan.USER_ID = user.USER_ID AND
    pesanan.ID_PESANAN = '$id_pesanan'");

    $data_pesanan = mysqli_fetch_assoc($result_pesanan);
    $nama_user = $data_pesanan['USER_NAMA_LENGKAP'];
    $tgl_psn = $data_pesanan['TANGGAL_PESANAN'];
    $total_harga = $data_pesanan['TOTAL_HARGA'];
    $antrian = $data_pesanan['ANTRIAN'];
    $ket_status = $data_pesanan['KET_STATUS'];
    $status_notif = $data_pesanan['STATUS_PESANAN'];
    $bukti_transfer = $data_pesanan['BUKTI_TRANSFER'];
  }

?>

<!-- Begin Page Content -->
<div class="container-fluid text-black">

  <div class="row justify-content-center">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header bg-biru-tua py-2 px-2 text-center">
        <h3 class="d-inline text-light">Detail Pesanan</h3>
        <a class="btn btn-light float-right ml-auto" href="../nota/nota_pesanan.php?id_pesanan=<?=$id_pesanan?>"><i class="fas fa-fw fa-print"></i></a>
        </div>
        <div class="card-body">
        <table class="w-100 table text-center py-0 m-0">
        <tbody>
          <tr>
            <td class="text-left"></td>
            <td colspan="3" class="text-right">Atas Nama : <?=$nama_user?></td>
          <tr>
          <tr>
            <td class="text-left"><strong>ID PESANAN : </strong><?=$id_pesanan?></td>
            <td colspan="3" class="text-right"><?=$tgl_psn?></td>
          <tr>
        </tbody>
      </table>
      <table class="w-100 table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th>Daftar Produk</th>
            <th>Desain</th>
            <th>Ket Pembayaran</th>
            <th>Jumlah Produk</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result_detail = mysqli_query($con, "SELECT 
          detail_pesanan.JUMLAH_PRODUK, 
          detail_pesanan.SUB_TOTAL,
          detail_pesanan.KET_PEMBAYARAN,
          detail_pesanan.UPLOAD_DESAIN, 

          CASE
          WHEN detail_pesanan.STATUS_DESAIN = 0 THEN 'ADA'
          WHEN detail_pesanan.STATUS_DESAIN = 1 THEN 'TIDAK ADA'
          END AS STATUS_DESAIN,

          CASE 
          WHEN detail_pesanan.KET_PEMBAYARAN = 2 THEN 'Uang Muka'
          WHEN detail_pesanan.KET_PEMBAYARAN = 1 THEN 'Lunas'
          END AS KET_BAYAR,
          
          produk.NAMA_PRODUK, 
          warna.JENIS_WARNA, 
          ukuran.JENIS_UKURAN, 
          bahan.NAMA_BAHAN

          FROM detail_pesanan, produk, warna, ukuran, bahan
          
          WHERE
          produk.ID_PRODUK = detail_pesanan.ID_PRODUK AND
          produk.ID_UKURAN = ukuran.ID_UKURAN AND
          produk.ID_BAHAN = bahan.ID_BAHAN AND
          produk.ID_WARNA = warna.ID_WARNA AND
          detail_pesanan.ID_PESANAN = '$id_pesanan'");

          while($data_detail = mysqli_fetch_assoc($result_detail)){
            $quantity = $data_detail['JUMLAH_PRODUK'];
            $sub_total = $data_detail['SUB_TOTAL'];
            $status_desain = $data_detail['STATUS_DESAIN'];
            $upload_desain = $data_detail['UPLOAD_DESAIN'];
            $nama_produk = $data_detail['NAMA_PRODUK'];
            $jenis_warna = $data_detail['JENIS_WARNA'];
            $jenis_ukuran = $data_detail['JENIS_UKURAN'];
            $nama_bahan = $data_detail['NAMA_BAHAN'];
            $ket_pembayaran = $data_detail['KET_BAYAR'];
          ?>
          <tr>
            <!-- NAMA PRODUK, WARNA, UKURAN, BAHAN -->
            <td style="width: 30%;"><p><?php echo "$nama_produk / $jenis_warna / $nama_bahan / $jenis_ukuran";?></p></td>
            <td style="width: 150px;"><?= $status_desain?> <?=$upload_desain?> 
            <?php if($status_desain == 'ADA'){ ?> <a class="badge badge-success py-2 px-3" href="../pictures/produk_desain/<?=$upload_desain?>" download>Download Desain</a> <?php } ?></td>
            <td><?= $ket_pembayaran?></td>
            <td><?= number_format($quantity, 0,".",".")?></td>
            <td>Rp. <?=number_format($sub_total, 0,".",".")?></td>
          </tr>
          <?php }?>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Total Harga : </td>
            <td colspan="3" class="text-right " >Rp. <?=number_format($total_harga, 0,".",".")?></td>
          <tr>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Status Pesanan : </td>
            <td colspan="3" class="text-right "><?=$ket_status?></td>
          <tr>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Unduh Desain : </td>
            <td colspan="3" class="text-right "><a href="../pictures/produk_desain/<?=$upload_desain?>" download></a></td>
          <tr>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Bukti Transfer : </td>
            <td colspan="3" class="text-right">
            <?php if($bukti_transfer != null){ ?>
            <img src="../pictures/bukti_transfer/<?=$bukti_transfer?>" class="img-fluid" alt="">
            <?php }else{ ?>
            <label class="text-muted">Belum Ada Bukti Transfer</label>
            <?php }?>
            </td>
          <tr>
        </tbody>
      </table>
      <div class="text-center">
      <?php
      if(($status_notif==1) && ($bukti_transfer != null)){
      echo '<form action="query/update_pesanan.php" method="post">';
      echo '<input type="hidden" name="id_pesanan" value="'.$id_pesanan.'">';
      echo '<div class="form-group"><input type="number" name="antrian" id="antrian" required min="1" placeholder="Berapa jam pengerjaan untuk pesanan ini?" class="form-control mb-3 w-50 mx-auto"></div>';
      echo '<div class="text-center justify-content-center"><button type="submit" name="masukkan_antrian" class="btn btn-primary px-4">Masukkan Antrian</button>';
      echo '<a href="query/update_pesanan.php?status='.$status_notif.'&id_pesanan='.$id_pesanan.'&param=7" class="btn btn-danger ml-2 px-4" >Bukti TF Salah</a>';
      echo '<a href="query/update_pesanan.php?status='.$status_notif.'&id_pesanan='.$id_pesanan.'&param=8" class="btn btn-danger ml-2 px-4" >Nominal Bayar Salah</a>';
      echo '</form>';
      }else if($status_notif==2){
      echo '<a href="query/update_pesanan.php?status='.$status_notif.'&id_pesanan='.$id_pesanan.'" class="btn btn-primary px-4" >Proses Pesanan</a>';
      }else if($status_notif==3){
      echo '<a href="query/update_pesanan.php?status='.$status_notif.'&id_pesanan='.$id_pesanan.'" class="btn btn-success px-4" >Pesanan Selesai</a>';
      }else if($status_notif==4){
      echo '<a href="query/update_pesanan.php?status='.$status_notif.'&id_pesanan='.$id_pesanan.'" class="btn btn-warning px-4" >Kirim Pesanan</a>';
      }else if($status_notif==5){
      echo '<button class="btn btn-danger px-4" disabled>Dalam Pengiriman</button>';
      }else if($status_notif==6){
      echo '<button class="btn btn-danger px-4" disabled>Dibatalkan</button>';
      }
      ?>
      <button onclick="window.history.back();" class="btn ml-1 btn-secondary"><i class="fas fa-arrow-left"></i></button>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include 'includes/footer.php';
?>