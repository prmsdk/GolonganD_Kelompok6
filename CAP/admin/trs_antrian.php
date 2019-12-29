<?php 
session_start();
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
END AS STATUS_KET
FROM pesanan, user where
user.USER_ID = pesanan.USER_ID AND
(pesanan.STATUS_PESANAN = 1 OR pesanan.STATUS_PESANAN = 2)
ORDER BY pesanan.TANGGAL_PESANAN DESC")
?>


<!-- Antrian -->
<div class="container-fluid text-dark">
  <div class="card shadow">
    <div class="card-header text-center">
      <h2 clas="">Antrian</h2>
    </div>
    <div class="card-body">
    <table id="example" class="table table-bordered text-dark" style="width:100%">
        <thead>
              <tr>
                  <th>No</th>
                  <th>ID Pesanan</th>
                  <th>User</th>
                  <th>Tanggal</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Ket</th>
              </tr>
        </thead>
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
        ?>
          <tbody>
              <tr class="bg-light">
                  <td><?=$i?></td>
                  <td><?=$id_psn?></td>
                  <td><?=$nama_user?></td>
                  <td><?=$tanggal_psn?></td>
                  <td>Rp. <?=number_format($total_psn, 0,".",".")?></td>
                  <td class="text-center"><?php if($status_notif==1 OR $status_notif==2){
                      echo '<span class="badge badge-pill badge-secondary px-3">'.$status_psn.'</span>';
                    }else if($status_notif==3){
                      echo '<span class="badge badge-pill badge-primary px-3">'.$status_psn.'</span>';
                    }else if($status_notif==4 OR $status_notif==5){
                      echo '<span class="badge badge-pill badge-success px-3">'.$status_psn.'</span>';
                    }else{
                      echo '<span class="badge badge-pill badge-danger px-3">'.$status_psn.'</span>';
                    }?>
                  </td>
                  <td>
                        <div class="block text-center">
                          <a href="trs_detail_pesanan_admin.php?id_pesanan=<?=$id_psn?>" class="btn btn-info btn-rounded w-50 btn-sm">
                            <i class="fas fa-info"></i>
                          </a>
                        </div>
                  </td>
              </tr>
          </tbody>
          <thead>
              <tr class="table-primary">
                    <th></th>
                  <th>Nama Prd</th>
                  <th>Isi Produk</th>
                  <th>Ket Bayar</th>
                  <th>Jumlah Prd</th>
                  <th>Sub Total</th>
                  <th>Ket Desain</th>
              </tr>
          </thead>
        <?php
        $result_produk = mysqli_query($con, "SELECT produk.NAMA_PRODUK, detail_pesanan.JUMLAH_PRODUK, detail_pesanan.SUB_TOTAL, detail_pesanan.STATUS_DESAIN, detail_pesanan.ISI_PRODUK, detail_pesanan.KET_PEMBAYARAN,
        CASE 
        WHEN detail_pesanan.KET_PEMBAYARAN = 2 THEN 'Uang Muka'
        WHEN detail_pesanan.KET_PEMBAYARAN = 1 THEN 'Lunas'
        END AS KET_BAYAR,
        CASE
        WHEN detail_pesanan.STATUS_DESAIN = 0 THEN 'ADA'
        WHEN detail_pesanan.STATUS_DESAIN = 1 THEN 'TIDAK ADA'
        END AS STATUS_
        FROM
        produk, detail_pesanan
        WHERE
        produk.ID_PRODUK = detail_pesanan.ID_PRODUK AND
        detail_pesanan.ID_PESANAN = '$id_psn'");
        while($data_produk = mysqli_fetch_assoc($result_produk)){
        $nama_produk = $data_produk['NAMA_PRODUK'];
        $jml_produk = $data_produk['JUMLAH_PRODUK'];
        $sub_total = $data_produk['SUB_TOTAL'];
        $ket_desain = $data_produk['STATUS_DESAIN'];
        $desain_status = $data_produk['STATUS_'];
        $ket_bayar = $data_produk['KET_BAYAR'];
        $ket_pembayaran = $data_produk['KET_PEMBAYARAN'];
        $isi_produk = $data_produk['ISI_PRODUK'];
        ?>
        
          <tbody>
          <tr class="table-warning">
                    <th></th>
                  <td><?=$nama_produk?></td>
                  <td><?=$isi_produk?></td>
                  <td class="text-center">
                  <?php if($ket_pembayaran==1){
                      echo '<span class="badge badge-pill badge-primary px-3">'.$ket_bayar.'</span>';
                    }else if($ket_pembayaran==2){
                      echo '<span class="badge badge-pill badge-danger px-3">'.$ket_bayar.'</span>';
                    }?>
                  </td>
                  <td><?=number_format($jml_produk, 0,".",".")?></td>
                  <td>Rp. <?=number_format($sub_total, 0,".",".")?></td>
                  <td class="text-center"><?php if($ket_desain==0){
                      echo '<span class="badge badge-pill badge-primary px-3">'.$desain_status.'</span>';
                    }else{
                      echo '<span class="badge badge-pill badge-success px-3">'.$desain_status.'</span>';
                    }?>
                  </td>
              </tr>
          </tbody>
        <?php } }?>
      </table>
    </div>
  </div>
</div>
  

<?php
require 'includes/footer.php'
?>
</html>