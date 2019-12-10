<?php 

require 'includes/config.php';
require 'includes/header.php';

$_SESSION['id_user'] = 'USR000002';
$id_user = $_SESSION['id_user'];
$result_pesanan = mysqli_query($con, "SELECT * FROM pesanan, user where
user.USER_ID = pesanan.USER_ID AND
user.USER_ID='$id_user'")
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
                  <th>Total</th>
                  <th>Status Pesanan</th>
                  <th>Ket Pembayaran</th>
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
            $status_psn = $data_pesanan['STATUS_PESANAN'];
            $ket_pembayaran = $data_pesanan['KET_PEMBAYARAN'];
        ?>
          
          <tbody>
              <tr class="bg-light">
                  <td><?=$i?></td>
                  <td><?=$id_psn?></td>
                  <td><?=$nama_user?></td>
                  <td><?=$tanggal_psn?></td>
                  <td><?=$total_psn?></td>
                  <td><?=$status_psn?></td>
                  <td><?=$ket_pembayaran?></td>
              </tr>
          </tbody>
          <thead>
              <tr class="table-primary">
                    <th></th>
                  <th>Nama Produk</th>
                  <th>Warna</th>
                  <th>Ukuran</th>
                  <th>Jumlah Produk</th>
                  <th>Ket Desain</th>
                  <th>Sub Total</th>
              </tr>
          </thead>
        <?php
        $result_produk = mysqli_query($con, "SELECT produk.NAMA_PRODUK, warna.JENIS_WARNA, ukuran.JENIS_UKURAN, detail_pesanan.JUMLAH_PRODUK, detail_pesanan.SUB_TOTAL, detail_pesanan.STATUS_DESAIN FROM
        produk, detail_pesanan, warna, ukuran
        WHERE
        produk.ID_PRODUK = detail_pesanan.ID_PRODUK AND
        warna.ID_WARNA = produk.ID_WARNA AND
        ukuran.ID_UKURAN = produk.ID_UKURAN AND
        detail_pesanan.ID_PESANAN = '$id_psn'");
        while($data_produk = mysqli_fetch_assoc($result_produk)){
        $nama_produk = $data_produk['NAMA_PRODUK'];
        $warna_produk = $data_produk['JENIS_WARNA'];
        $ukuran_produk = $data_produk['JENIS_UKURAN'];
        $jml_produk = $data_produk['JUMLAH_PRODUK'];
        $sub_total = $data_produk['SUB_TOTAL'];
        $ket_desain = $data_produk['STATUS_DESAIN'];
        ?>
        
          <tbody>
              <tr class="table-warning">
                    <th></th>
                  <td><?=$nama_produk?></td>
                  <td><?=$warna_produk?></td>
                  <td><?=$ukuran_produk?></td>
                  <td><?=$jml_produk?></td>
                  <td><?=$sub_total?></td>
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