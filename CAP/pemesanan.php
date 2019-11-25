<?php
    require 'includes/header.php';
    include 'includes/config.php';

    if(isset($_GET['modal_user'])){?>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".login").click();
            });
        </script>
    <?php
    }

    $id_user = $_SESSION['id_user'];
    if(isset($_GET['produk_id'])){
        $produk_id = $_GET['produk_id'];
        $data = mysqli_query($con, "select * from tampil_produk where ID_TAMPIL_PRODUK = '$produk_id'");
            while($data_produk = mysqli_fetch_assoc($data)){
                $nama_produk = $data_produk['NAMA_TAMPIL_PRODUK'];
            }
    
?>

<div class="container container-fluid-md">
    <div class="row ">
        <div class="col-lg pt-4">
            <div class="card shadow p-4">
            <form action="pemesanan_query.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?=$produk_id?>" name="id_produk">
            <input type="hidden" value="<?=$nama_produk?>" name="nama_produk">
            <input type="hidden" value="<?=$id_user?>" name="id_user">
            <div class="border-bottom border-warning font-m-semi">
            <h2><?=$nama_produk?></h2>
            </div>
            <p class="pt-3 font-m-semi">Pilih Warna :</p>
            <div id="select_warna" class="">
                <?php
                $i = 1;
                $result = mysqli_query($con, "select * from tampil_warna, warna where ID_TAMPIL_PRODUK = '$produk_id' and warna.ID_WARNA = tampil_warna.ID_WARNA");
                    while($data_warnad = mysqli_fetch_assoc($result)){
                        $detail_warna = $data_warnad['ID_WARNA'];
                        $nama_warna = $data_warnad['JENIS_WARNA'];
                        $harga_warna = $data_warnad['HARGA_WARNA'];
                        echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                        <input type="radio" aria-describedby="'.$harga_warna.'" id="pilihwarna'.$i.'" name="pilihwarna" value="'.$detail_warna.'" class="custom-control-input">
                        <label class="custom-control-label" for="pilihwarna'.$i.'">'.$nama_warna.'</label>
                        <input type="hidden" id="">
                        </div>';
                        $i+=1;
                }   
            ?>
                <div id="WRN000002" class="box_warna">
                <input type="text" class=" form-control mb-4 w-50" placeholder="Warna yang diinginkan">           
                </div>
                <div id="WRN000004" class="box_warna">
                <input type="text" class="form-control mb-4 w-50" placeholder="Warna yang diinginkan">           
                </div>
                <div id="WRN000005" class="box_warna">
                <input type="text" class="form-control mb-4 w-50" placeholder="Warna yang diinginkan">           
                </div>
            </div>
            <p class="pt-3 font-m-semi">Pilih Bahan :</p>
            <div id="select_bahan" class="">
                <?php
                $i = 1;
                $result = mysqli_query($con, "select * from tampil_bahan, bahan, satuan_bahan where ID_TAMPIL_PRODUK = '$produk_id' and bahan.ID_BAHAN = tampil_bahan.ID_BAHAN and bahan.ID_SATUAN = satuan_bahan.ID_SATUAN");
                    while($data_bahan = mysqli_fetch_assoc($result)){
                        $detail_bahan = $data_bahan['ID_BAHAN'];
                        $nama_bahan = $data_bahan['NAMA_BAHAN'];
                        $harga_bahan = $data_bahan['HARGA_BAHAN'];
                        $satuan_bahan = $data_bahan['JUMLAH_SATUAN'];
                        echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                        <input type="radio" placeholder="'.$satuan_bahan.'" aria-describedby="'.$harga_bahan.'" id="pilihbahan'.$i.'" name="pilihbahan" value="'.$detail_bahan.'" class="custom-control-input">
                        <label class="custom-control-label" for="pilihbahan'.$i.'">'.$nama_bahan.'</label>
                        </div>';
                        $i+=1;
                }   
            ?>           
            </div>
            <p class="pt-3 font-m-semi">Pilih Ukuran :</p>
            <div id="select_ukuran" class="">
                <?php
                $i = 1;
                $result = mysqli_query($con, "select * from tampil_ukuran, ukuran where ID_TAMPIL_PRODUK = '$produk_id' and ukuran.ID_UKURAN = tampil_ukuran.ID_UKURAN");
                    while($data_ukuran = mysqli_fetch_assoc($result)){
                        $detail_ukuran = $data_ukuran['ID_UKURAN'];
                        $nama_ukuran = $data_ukuran['JENIS_UKURAN'];
                        $harga_ukuran = $data_ukuran['HARGA_UKURAN'];
                        echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                        <input type="radio" aria-describedby="'.$harga_ukuran.'" id="pilihukuran'.$i.'" name="pilihukuran" value="'.$detail_ukuran.'" class="custom-control-input">
                        <label class="custom-control-label" for="pilihukuran'.$i.'">'.$nama_ukuran.'</label>
                        </div>';
                        $i+=1;
                }
    }   
            ?>           
            </div>
            <p class="font-m-semi">Desain</p>
            <div id="pilihan_desain" class="pl-4 mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="pilihdesain1" name="pilihdesain" class="custom-control-input" value="0">
                    <label class="custom-control-label" for="pilihdesain1">Upload Desain</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="pilihdesain2" name="pilihdesain" class="custom-control-input" value="1" checked>
                    <label class="custom-control-label" for="pilihdesain2">Belum punya Desain</label>
                </div>
            </div>
            <div class="custom-file ">
                <input type="file" id="uploadfile" name="desain" readonly> 
                <label for="uploadfile">Unggah file anda dalam format .zip (max ukuran file 30mb) Jika ukuran file anda melebihi batas silahkan kirim file melalui <a href="mailto:aldion819@gmail.com">email ini.</a></label>
            </div>
            <p class="font-m-semi mt-3">Jumlah</p>
            <input id="jumlah_produk" type="number" class="form-control mb-4 w-50" placeholder="Masukkan Jumlah Cetak" name="jumlah_produk">
            <p class="font-m-semi">TOTAL</p>
            <div id="pembayaran"  class="pl-4 mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="total1" name="total" class="custom-control-input" value="2">
                    <label class="custom-control-label" for="total1">Uang muka</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="total2" name="total" class="custom-control-input" value="1">
                    <label class="custom-control-label" for="total2">Lunas</label>
                </div>
            </div>
            <input type="number" id="sub_total" class="form-control mb-4 w-50" placeholder="Total Pembayaran" name="sub_total" pattern="(^\d+(\.|\,)\d{2}$)" readonly>
            <div class="cutom-inline text-center">
                <input type="submit" name="pemesanan_produk" value="Keranjang" class="btn btn-primary font-m-med">
                <input type="submit" name="pemesanan_produk" value="Bayar" class="btn btn-primary font-m-med">
            </div>
            </form>
            </div>
            <div class="pt-5 mb-4">
                <div class="card shadow col-lg p-5 bg-light text-dark">
                    <div class="font-m-semi">
                        <h6>Langkah-Langkah Pemesanan Cetak Secara Online</h6>
                    </div>
                <p>1. Lengkapi formulir di atas<br>- Silahkan lengkapi data di atas, dengan memilih salah satu warna, bahan, dan ukuran. kemudian upload desain kamu jika ada. input jumlah cetak yang diinginkan.</br></p>
                <p>2. Konfirmasi Pemesanan<br>- Pastikan data yang telah dipilih sudah benar, dan cek kembali desain yang telah anda upload.</br></p>
                <p>3. Pembayaran<br>- Silahkan pilih salah metode pembayaran Uang muka atau Lunas, jika masih ingin ada yang ingin dicetak silahkan klik tombol "Keranjang", jika ingin langsung membayar silahkan klik "Bayar".</br></p>
                <p>4. Proses Produksi<br>- Tunggu notifikasi dari kami jika ada kesalahan atau pemberitahuan tentang pesanan anda.</br></p>
                <p>5. Diambil atau Dikirim<br>- Setelah selesai produksi barang bisa diambil langsung ke toko atau bisa juga kita kirim melalui beberapa kurir yang sudah bekerja sama dengan kami diantaranya.</br></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="src/js/main.js"></script>

<?php

    require 'includes/footer.php';

?>