<?php
    include 'includes/config.php';
    require 'includes/header.php';

    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
    } 

    if(isset($_GET['id_nego'])){
      $id_nego = $_GET['id_nego'];
    }

    $result_nego = mysqli_query($con, "SELECT * FROM nego where
    nego.ID_NEGO='$id_nego'");
    $data_nego = mysqli_fetch_assoc($result_nego);
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
    $ket_pembayaran = $data_nego['KET_PEMBAYARAN'];
    $isi_produk = $data_nego['ISI_PRODUK'];
    $catatan = $data_nego['CATATAN'];

    $result_ukuran = mysqli_query($con, "SELECT * FROM ukuran WHERE ID_UKURAN = '$id_ukuran'");
    $data_ukuran = mysqli_fetch_assoc($result_ukuran);
    $nama_ukuran = $data_ukuran['JENIS_UKURAN'];

    $result_warna = mysqli_query($con, "SELECT * FROM warna WHERE ID_WARNA = '$id_warna'");
    $data_warna = mysqli_fetch_assoc($result_warna);
    $nama_warna = $data_warna['JENIS_WARNA'];

    $result_bahan = mysqli_query($con, "SELECT * FROM bahan WHERE ID_BAHAN = '$id_bahan'");
    $data_bahan = mysqli_fetch_assoc($result_bahan);
    $nama_bahan = $data_bahan['NAMA_BAHAN'];
?>

<div class="container container-fluid-md">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-9 pt-4">

            <div class="card shadow p-5">
            <form action="nego_pembayaran_query.php" method="post">
                <input type="hidden" name="id_nego" value="<?=$id_nego?>">
                <input type="hidden" name="id_user" value="<?=$id_user?>">
                <input type="hidden" name="id_produk" value="<?=$id_produk?>">
                <input type="hidden" name="nama_produk" value="<?=$produk?>">
                <input type="hidden" name="pilihukuran" value="<?=$id_ukuran?>">
                <input type="hidden" name="pilihbahan" value="<?=$id_bahan?>">
                <input type="hidden" name="pilihwarna" value="<?=$id_warna?>">
                <input type="hidden" name="pilihdesain" value="<?=$status_desain?>">
                <input type="hidden" name="namadesain" value="<?=$namadesain?>">
                <input type="hidden" name="ket_pembayaran" value="<?=$ket_pembayaran?>">
                <input type="hidden" name="isibahan" value="<?=$isi_produk?>">
                <input type="hidden" name="catatan" value="<?=$catatan?>">
                <input type="hidden" name="jumlah_produk" value="<?=$jumlah_produk?>">
                <input type="hidden" name="sub_total" value="<?=$harga_nego?>">
                    <p class="pt-3 font-m-semi">Detail Pemesanan :</p>          
                              
                      <table class="table table-responsive">
                          <thead>
                            <tr class="font-weight-bolder">
                              <td style="width:75%;">Daftar Produk</td>
                              <td style="width:auto;">Qty</td>
                              <td>Sub Total</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?=$produk?> / <?=$nama_warna?> / <?=$nama_bahan?> / <?=$nama_ukuran?></td>
                              <td><?=$jumlah_produk?></td>
                              <td>Rp. <?=number_format($harga_nego, 0,".",".")?></td>
                            </tr>
                            <tr>
                              <td class="text-right" colspan="2">Total Pembayaran :</td>
                              <td>Rp. <?=number_format($harga_nego, 0,".",".")?></td>
                            </tr>
                          </tbody>
                      </table>
                    <p class="pt-3 font-m-semi">Pilih Bank :</p>
                    <div id="select_bank" class="">
                    <?php
                        $i = 1;
                        $result = mysqli_query($con, "select * from rekening_bank");
                            while($data_rekening = mysqli_fetch_assoc($result)){
                                $id_rekening = $data_rekening['ID_REKENING'];
                                $nama_rekening = $data_rekening['NAMA_REKENING'];
                                $nomer_rekening = $data_rekening['NOMER_REKENING'];
                                echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                                <input type="radio" aria-describedby="'.$nomer_rekening.'" id="pilihbank'.$i.'" name="pilihbank" value="'.$id_rekening.'" class="custom-control-input" required>

                                <label class="custom-control-label" for="pilihbank'.$i.'">'.$nama_rekening.'</label>
                                <input type="hidden" id="">
                                </div>';
                                $i+=1;
                            }   
                    ?>
                        
                    <div class="text-center">
                        <input type="submit" name="nego_pembayaran" value="Bayar" class="btn btn-primary font-m-med">
                        <a class="btn btn-secondary" href="index.php">Kembali</a>
                    </div>
                    </form>
                    </div>
                    </div>
            <div class="pt-5 mb-4">
                <div class="card shadow col-lg p-5 bg-light text-dark">
                    <div class="font-m-semi">
                        <h6>Langkah-Langkah Pembayaran Secara Online</h6>
                    </div>
                <p>1. Cek kembali pesanan<br>- Silahkan lengkapi data di atas, dengan memilih salah satu warna, bahan, dan ukuran. kemudian upload desain kamu jika ada. input jumlah cetak yang diinginkan.</br></p>
                <p>2. Pilih bank<br>- Pastikan data yang telah dipilih sudah benar, dan cek kembali desain yang telah anda upload.</br></p>
                <p>3. Transfer ke nomer rekening yang tertera<br>- Silahkan pilih salah metode pembayaran Uang muka atau Lunas, jika masih ingin ada yang ingin dicetak silahkan klik tombol "Keranjang", jika ingin langsung membayar silahkan klik "Bayar".</br></p>
                <p>4. Upload bukti pembayaran<br>- Tunggu notifikasi dari kami jika ada kesalahan atau pemberitahuan tentang pesanan anda.</br></p>
                <p>5. Diambil atau Dikirim<br>- Setelah selesai pembayaran produksi barang akan diproses jika sudah selesai bisa diambil langsung ke percetakan atau bisa juga kita kirim melalui beberapa kurir yang sudah bekerja sama dengan kami diantaranya.</br></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="src/js/main.js"></script>

<?php

    require 'includes/footer.php';

?>