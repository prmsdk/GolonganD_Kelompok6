<?php
include 'includes/config.php';
include 'includes/header.php';

// if(!isset($_SESSION['status'])){
//   header("location:index.php");
// }

$id_user = $_SESSION['id_user'];
if(isset($_GET['id_pesanan'])){
  $id_pesanan = $_GET['id_pesanan'];
}

$update_notif = mysqli_query($con, "UPDATE pesanan SET USER_NOTIF = 1 WHERE ID_PESANAN = '$id_pesanan'");

$result_pesanan = mysqli_query($con, "SELECT
user.USER_NAMA_LENGKAP, pesanan.BUKTI_TRANSFER, pesanan.ANTRIAN,
cast(pesanan.TANGGAL_PESANAN as date) as TANGGAL_PESANAN, 
pesanan.TOTAL_HARGA, pesanan.ID_REKENING, pesanan.STATUS_PESANAN,

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
$status_pesanan = $data_pesanan['STATUS_PESANAN'];
$ket_status = $data_pesanan['KET_STATUS'];
$bukti_tf = $data_pesanan['BUKTI_TRANSFER'];
$id_bank = $data_pesanan['ID_REKENING'];
$antrian = $data_pesanan['ANTRIAN'];
?>

<div class="container-fluid">
  <form action="transaksi_query.php" method="post">
  <div class="card m-5 shadow">
    <div class="card-header text-center text-light bg-primary">
      <h3 class="d-inline">Pesanan Anda</h3>
      <a class="mt-2 mr-2 btn btn-light float-right ml-auto" href="nota/nota_pesanan.php?id_pesanan=<?=$id_pesanan?>"><i class="fas fa-fw fa-print"></i></a>
    </div>
    <div class="card-body py-4 px-5 ">
      <table class="w-100 table text-center py-0 m-0">
        <tbody>
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
          detail_pesanan.UPLOAD_DESAIN,

          CASE
          WHEN detail_pesanan.STATUS_DESAIN = 0 THEN 'ADA'
          WHEN detail_pesanan.STATUS_DESAIN = 1 THEN 'TIDAK ADA'
          END AS STATUS_DESAIN,
          
          produk.NAMA_PRODUK, 
          warna.JENIS_WARNA, 
          ukuran.JENIS_UKURAN, 
          bahan.NAMA_BAHAN,
          detail_pesanan.KET_PEMBAYARAN AS KET_BAYAR,

          CASE 
          WHEN detail_pesanan.KET_PEMBAYARAN = 2 THEN 'Uang Muka'
          WHEN detail_pesanan.KET_PEMBAYARAN = 1 THEN 'Lunas'
          END AS KET_PEMBAYARAN

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
            $ket_pembayaran = $data_detail['KET_PEMBAYARAN'];
          ?>
          <tr>
            <!-- NAMA PRODUK, WARNA, UKURAN, BAHAN -->
            <td style="width: 30%;"><p><?php echo "$nama_produk / $jenis_warna / $nama_bahan / $jenis_ukuran";?></p></td>
            <td><?= $status_desain?><br><?=$upload_desain?></td>
            <td><?= $ket_pembayaran?></td>
            <td><?= number_format($quantity, 0,".",".")?></td>
            <td>Rp. <?=number_format($sub_total, 0,".",".")?>,-</td>
          </tr>
          <?php }?>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Total Harga : </td>
            <td colspan="3" class="text-right " >Rp. <?=number_format($total_harga, 0,".",".")?>,-</td>
          <tr>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Status Pesanan : </td>
            <td colspan="3" class="text-right " ><?=$ket_status?></td>
          <tr>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Lama Pengerjaan : </td>
            <td colspan="3" class="text-right " ><?=$antrian?> Jam</td>
          <tr>
          <tr class="font-weight-bolder">
            <td class="border-0"> </td>
            <td class="text-right ">Bukti TF : </td>
            <td colspan="3" class="text-right " >
            <?php 
            if($bukti_tf != null){ ?>
            <img src="pictures/bukti_transfer/<?=$bukti_tf?>" alt="" class="img-fluid">
            <?php }else{ 
            echo "<a href='verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank' class='btn btn-primary px-2'>Upload Bukti TF</a>";
            } ?>
            </td>
          <tr>
        </tbody>
      </table>
      
      <div class="text-center">
      <?php
      if($status_pesanan == 1 || $status_pesanan == 2){
        echo '<a href="verif_pembayaran_query.php?id_pesanan='.$id_pesanan.'&action=batal" class="btn btn-danger px-2" onclick="return confirm('."'".'Apakah anda yakin ingin membatalkan pesanan?'."'".')">Batalkan Pesanan</a>';
      }
      ?>
      </div>
    </div>
  </div>
</div>

<?php
  include 'includes/footer.php';
?>
