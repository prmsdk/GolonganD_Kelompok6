<?php 

require 'includes/config.php';
require 'includes/header.php';

if(!isset($_SESSION['status'])){
  header("location:index.php");
}

$id_user = $_SESSION['id_user'];
$result_pesanan = mysqli_query($con, "SELECT DISTINCT 
user.USER_NAMA_LENGKAP, 
pesanan.ID_PESANAN, 
pesanan.TANGGAL_PESANAN, 
produk.NAMA_PRODUK, 
pesanan.USER_NOTIF,
pesanan.STATUS_PESANAN,
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

FROM user, pesanan, detail_pesanan, produk 

WHERE
  pesanan.USER_ID = user.USER_ID AND
  pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN AND
  detail_pesanan.ID_PRODUK = produk.ID_PRODUK AND
  pesanan.USER_ID = '$id_user'
  GROUP BY ID_PESANAN
  ORDER BY pesanan.TANGGAL_PESANAN DESC");
?>

<!-- Start Notifikasi User -->

<div class="container">
  <div class="card shadow m-5">
    <div class="card-header text-center">
      <h2 clas="">Notifikasi User</h2>
    </div>
    <div class="card-body">
      <a class="mb-3 btn btn-primary float-right ml-auto" href="notifikasi_user_query.php">Tandai Semua Sudah Dibaca</a>
      <table class="table table-bordered" id="example" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>ID</th>
            <th>Tanggal Pemesanan</th>
            <th>Nama Produk</th>
            <th>Status Pesanan</th>
            <th>Status Notif</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i =0;
          while($data_notif = mysqli_fetch_assoc($result_pesanan)){
          $id_psn = $data_notif['ID_PESANAN'];
          $tgl_psn = $data_notif['TANGGAL_PESANAN'];
          $status_psn = $data_notif['KET_STATUS'];
          $nama_produk = $data_notif['NAMA_PRODUK'];
          $status_notif = $data_notif['USER_NOTIF'];
          $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:100px;"><?=$i?></td>
            <td><?=$id_psn?></td>
            <td><?=$tgl_psn?></td>
            <td><?=$nama_produk?></td>
            <!-- IF UNTUK WARNA STATUS PESANAN -->
            <td class="text-center"><span class="badge badge-pill py-2 
            <?php
            if($data_notif['STATUS_PESANAN'] == 4){
              echo "badge-success";
            }else if(($data_notif['STATUS_PESANAN'] == 6) OR ($data_notif['STATUS_PESANAN'] == 7) OR ($data_notif['STATUS_PESANAN']== 8)){
              echo "badge-danger";
            }else{
              echo "badge-primary";
            }
            ?>
            px-3"><?=$status_psn?></span></td>
            <!-- END IF WARNA STATUS PESANAN -->
            <td class="text-center"><?php if($status_notif==0){
              echo '<span class="badge badge-pill badge-primary py-2 px-3">Belum Dibaca</span>';
            }else{
              echo '<span class="badge badge-pill badge-success py-2 px-3">Sudah Dibaca</span>';
            }?></td>
            <td style="width:100px">
            <div class="">
            <a href="detail_pesanan_user.php?id_pesanan=<?=$id_psn?>" class="btn btn-info btn-rounded btn-sm float-left w-50 mr-1">
                  <i class="fas fa-info"></i>
              </a>
            <?php
            if($status_notif==0){
            ?>
              <a href="notifikasi_user_query.php?id_pesanan=<?=$id_psn?>&action=sudah" class="btn btn-primary btn-rounded btn-sm float-right" onclick="return confirm('Tandai sudah dibaca?');">
                  <i class="fas fa-check"></i>
              </a>
            <?php
            }else{
            ?>
              <a href="notifikasi_user_query.php?id_pesanan=<?=$id_psn?>&action=belum" class="btn btn-danger btn-rounded btn-sm float-right" onclick="return confirm('Tandai belum dibaca?');">
                  <i class="fas fa-check"></i>
              </a>
            <?php
            }
            ?>
            </td>
          </tr> 
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
  include 'includes/footer.php'
?>