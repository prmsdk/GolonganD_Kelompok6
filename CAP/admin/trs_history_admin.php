<?php 
session_start();
if($_SESSION['admin_status']==2){
  header("location:index.php");
}
$_SESSION['active_link'] = 'pemesanan';
require 'includes/config.php';
require 'includes/header.php';

$result_pesanan = mysqli_query($con, "SELECT *, 
CASE
WHEN pesanan.STATUS_PESANAN = 1 THEN 'Menunggu Bukti TF'
WHEN pesanan.STATUS_PESANAN = 2 THEN 'Menunggu Antrian'
WHEN pesanan.STATUS_PESANAN = 3 THEN 'Dalam Proses'
WHEN pesanan.STATUS_PESANAN = 4 THEN 'Selesai'
WHEN pesanan.STATUS_PESANAN = 5 THEN 'Dalam Pengiriman'
WHEN pesanan.STATUS_PESANAN = 6 THEN 'Dibatalkan'
WHEN pesanan.STATUS_PESANAN = 7 THEN 'Bukti TF Anda Salah'
WHEN pesanan.STATUS_PESANAN = 8 THEN 'Nominal Bayar Salah'
END AS STATUS_KET
FROM pesanan, user where
user.USER_ID = pesanan.USER_ID
ORDER BY pesanan.TANGGAL_PESANAN DESC")
?>


<!-- History Admin -->
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header text-center">
      <h2 clas="">History Admin</h2>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table id="dataTable" class="table table-bordered text-dark" style="width:100%">
        <thead>
              <tr>
                  <th>No</th>
                  <th>ID Pesanan</th>
                  <th>User</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th style="width: 100px;">Total</th>
                  <th>Aksi</th>
              </tr>
        </thead>
        
        <tbody>
        <?php 
        $i=0;
        while($data_pesanan = mysqli_fetch_assoc($result_pesanan)){
            $i+=1;
            $id_psn = $data_pesanan['ID_PESANAN'];
            $total_psn = $data_pesanan['TOTAL_HARGA'];
            $nama_user = $data_pesanan['USER_NAMA_LENGKAP'];
            $tanggal_psn = $data_pesanan['TANGGAL_PESANAN'];
            $status_notif = $data_pesanan['STATUS_PESANAN'];
            $status_psn = $data_pesanan['STATUS_KET'];
            $antrian = $data_pesanan['ANTRIAN']
        ?>
          
              <tr class="bg-light">
                  <td><?=$i?></td>
                  <td><?=$id_psn?></td>
                  <td><?=$nama_user?></td>
                  <td class="text-center">
                  <?php if($status_notif==1){
                      echo '<span class="badge badge-pill badge-dark px-3">'.$status_psn.'</span>';
                    }else if($status_notif==2){
                      echo '<span class="badge badge-pill badge-secondary px-3">'.$status_psn.'</span>';
                    }else if($status_notif==3){
                      echo '<span class="badge badge-pill badge-primary px-3">'.$status_psn.'</span>';
                    }else if($status_notif==4){
                      echo '<span class="badge badge-pill badge-success px-3">'.$status_psn.'</span>';
                    }else if($status_notif==5){
                      echo '<span class="badge badge-pill badge-warning px-3">'.$status_psn.'</span>';
                    }else{
                      echo '<span class="badge badge-pill badge-danger px-3">'.$status_psn.'</span>';
                    }?>
                  </td>
                  <td><?=substr($tanggal_psn,0,10)?></td>
                  <td>Rp. <?=number_format($total_psn, 0,".",".")?></td>
                  <td>
                        <div class="block text-center">
                          <a href="trs_detail_pesanan_admin.php?id_pesanan=<?=$id_psn?>" class="btn btn-info btn-rounded w-75 btn-sm">
                            <i class="fas fa-info"></i>
                          </a>
                        </div>
                  </td>
              </tr>
        <?php }?>
          </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
  

<?php
require 'includes/footer.php'
?>
</html>