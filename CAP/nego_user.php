<?php 

require 'includes/config.php';
require 'includes/header.php';

$id_user = $_SESSION['id_user'];
$result_nego = mysqli_query($con, "SELECT * FROM nego where
nego.ID_USER='$id_user'");
?>


<!-- Nego User -->
<div class="container">
  <div class="card shadow m-5">
    <div class="card-header text-center">
      <h2 clas="">Nego User</h2>
    </div>
    <div class="card-body">
    <table id="example" class="table table-bordered" style="width:100%">
        <thead>
              <tr>
                  <th>No</th>
                  <th>Produk</th>
                  <th>Tgl Nego</th>
                  <th>Harga Produk</th>
                  <th>Harga Nego</th>
                  <th>Status Nego</th>
                  <th>Aksi</th>
              </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        while($data_nego = mysqli_fetch_assoc($result_nego)){
        $i+=1;
        $id_nego = $data_nego['ID_NEGO'];
        $produk = $data_nego['NAMA_PRODUK'];
        $tgl_nego = $data_nego['NEGO_TGL'];
        $harga_produk = $data_nego['SUB_TOTAL'];
        $harga_nego = $data_nego['NEGO_HARGA'];
        $status_nego = $data_nego['NEGO_STATUS'];

        $id_ukuran = $data_nego['ID_UKURAN'];
        $id_warna = $data_nego['ID_WARNA'];
        $id_bahan = $data_nego['ID_BAHAN'];
        $id_produk = $data_nego['ID_PRODUK'];
        $jumlah_produk = $data_nego['JUMLAH_PRODUK'];
        $namadesain = $data_nego['UPLOAD_DESAIN'];
        $status_desain = $data_nego['STATUS_DESAIN'];

        ?>
          
            <tr class="bg-light">
                <td><?=$i?></td>
                <td><?=$produk?></td>
                <td><?=$tgl_nego?></td>
                <td>Rp. <?=number_format($harga_produk, 0,".",".")?></td>
                <td>Rp. <?=number_format($harga_nego, 0,".",".")?></td>
                <td class="text-center">
                <?php if($status_nego == 2){ echo
                '<span href="" class="btn btn-success btn-circle btn-sm">
                  Telah diverifikasi Admin
                </span>';
                }else if($status_nego == 1){ echo
                  '<span href="" class="btn btn-danger btn-circle btn-sm">
                  Menunggu Verifikasi Admin
                  </span>';
                }else if($status_nego == 3){ echo
                  '<span href="" class="btn btn-secondary btn-circle btn-sm">
                  Nego Kadaluarsa
                  </span>';
                } ?>
                </td>
                <td class="text-center">
                <a <?php if($status_nego != 2){echo "onclick='return false;'";}?> href="nego_pembayaran.php?id_nego=<?=$id_nego?>" class="nego-to-cart btn btn-primary font-m-med" name="pembayaran_nego"  id="pembayaran_nego" onclick="return confirm('Yakin melanjutkan hasil nego ke pembayaran?');" >BAYAR</a>
                <a <?php if($status_nego == 3){echo "onclick='return false;'";}else if($status_nego != 1){echo "onclick='alert(".'"'."Anda disarankan untuk melanjutkan produk yang telah mendapat deal nego!".'"'.");return false;'";}else{echo "onclick='return confirm(".'"'."Yakin ingin menghapus ?".'"'.");'";}?> class="btn btn-danger font-m-med" href="nego_user_query.php?id_nego=<?=$id_nego?>" id="keranjang" ><i class="fa p-0 fa-trash fa-1x"></i></a>
                </td>
            </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  

<?php
require 'includes/footer.php'
?>
</html>