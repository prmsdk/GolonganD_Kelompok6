<?php 

require 'includes/config.php';
require 'includes/header.php';

$id_user = $_SESSION['id_user'];
$result_pesanan = mysqli_query($con, "SELECT *, 
CASE
WHEN pesanan.STATUS_PESANAN = 1 THEN 'Sedang Menunggu Bukti TF'
WHEN pesanan.STATUS_PESANAN = 2 THEN 'Sedang Menunggu Antrian'
WHEN pesanan.STATUS_PESANAN = 3 THEN 'Sedang Dalam Proses'
WHEN pesanan.STATUS_PESANAN = 4 THEN 'Selesai'
WHEN pesanan.STATUS_PESANAN = 5 THEN 'Dalam Pengiriman'
WHEN pesanan.STATUS_PESANAN = 6 THEN 'Dibatalkan'
WHEN pesanan.STATUS_PESANAN = 7 THEN 'Bukti TF Anda Salah'
WHEN pesanan.STATUS_PESANAN = 8 THEN 'Nominal Bayar Salah'
END AS STATUS_PESANAN 
FROM pesanan, user where
user.USER_ID = pesanan.USER_ID AND
user.USER_ID='$id_user' ORDER BY pesanan.ID_PESANAN DESC")
?>


<!-- History User -->
<div class="container">
  <div class="card shadow m-5">
    <div class="card-header text-center">
      <h2 clas="">History User</h2>
    </div>
    <div class="card-body">
    <table id="example" class="table table-bordered" style="width:100%">
        <thead>
              <tr>
                  <th>No</th>
                  <th>ID Pesanan</th>
                  <th>Nama User</th>
                  <th>Tanggal Pesanan</th>
                  <th style="width: 100px;">Total</th>
                  <th>Status Pesanan</th>
                  <th>Aksi</th>
              </tr>
        </thead>
        <?php
        // MENAMPILKAN PESANAN BERDASARKAN ID USER
        $i=0;
        while($data_pesanan = mysqli_fetch_assoc($result_pesanan)){
            $i+=1;
            $id_psn = $data_pesanan['ID_PESANAN'];
            $total_psn = $data_pesanan['TOTAL_HARGA'];
            $nama_user = $data_pesanan['USER_NAMA_LENGKAP'];
            $tanggal_psn = $data_pesanan['TANGGAL_PESANAN'];
            $status_psn = $data_pesanan['STATUS_PESANAN'];
        ?>
          
          <tbody>
              <tr class="bg-light">
                  <td><?=$i?></td>
                  <td><?=$id_psn?></td>
                  <td><?=$nama_user?></td>
                  <td><?=$tanggal_psn?></td>
                  <td>Rp. <?=number_format($total_psn, 0,".",".")?></td>
                  <td><?=$status_psn?></td>
                  <td class="text-center">
                    <a href="detail_pesanan_user.php?id_pesanan=<?=$id_psn?>" class="my-auto w-50 btn btn-info btn-rounded btn-sm">
                      <i class="fas fa-info"></i>
                    </a>
                  </td>
              </tr>
          </tbody>
          <thead>
              <tr class="table-primary">
                    <th></th>
                  <th>Nama </th>
                  <th>Isi Produk</th>
                  <th>Ket Bayar</th>
                  <th>Jumlah </th>
                  <th>Sub Total</th>
                  <th style="width: 110px;">Ket Desain</th>
              </tr>
          </thead>
        <?php
        // MENAMPILKAN DETAIL PESANAN BERDASARKAN ID PESANAN YANG LAGI DIULANG -> WHILE
        $result_produk = mysqli_query($con, "SELECT produk.NAMA_PRODUK, detail_pesanan.JUMLAH_PRODUK, detail_pesanan.SUB_TOTAL, detail_pesanan.ISI_PRODUK,
        CASE 
        WHEN detail_pesanan.STATUS_DESAIN = 0 THEN 'Ada Desain'
        WHEN detail_pesanan.STATUS_DESAIN = 1 THEN 'Tidak Ada Desain'
        END AS STATUS_DESAIN, 
        CASE 
        WHEN detail_pesanan.KET_PEMBAYARAN = 2 THEN 'Uang Muka'
        WHEN detail_pesanan.KET_PEMBAYARAN = 1 THEN 'Lunas'
        END AS KET_PEMBAYARAN 
        
        FROM
        produk, detail_pesanan
        WHERE
        produk.ID_PRODUK = detail_pesanan.ID_PRODUK AND
        detail_pesanan.ID_PESANAN = '$id_psn'");
        while($data_produk = mysqli_fetch_assoc($result_produk)){
        $nama_produk = $data_produk['NAMA_PRODUK'];
        $warna_produk = $data_produk['JENIS_WARNA'];
        $ukuran_produk = $data_produk['JENIS_UKURAN'];
        $jml_produk = $data_produk['JUMLAH_PRODUK'];
        $sub_total = $data_produk['SUB_TOTAL'];
        $ket_desain = $data_produk['STATUS_DESAIN'];
        $ket_pembayaran = $data_produk['KET_PEMBAYARAN'];
        $isi_produk = $data_produk['ISI_PRODUK'];
        ?>
        
          <tbody>
              <tr class="table-warning">
                    <th></th>
                  <td><?=$nama_produk?></td>
                  <td><?=$isi_produk?></td>
                  <td><?=$ket_pembayaran?></td>
                  <td><?=$jml_produk?></td>
                  <td>Rp. <?=number_format($sub_total, 0,".",".")?></td>
                  <td><?=$ket_desain?></td>
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