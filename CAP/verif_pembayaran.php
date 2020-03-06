<?php
    include 'includes/config.php';
    require 'includes/header.php';

    if(isset($_GET['id_pesanan'])){
        $id_pesanan = $_GET['id_pesanan'];
        $id_rekening = $_GET['id_bank'];
    }
    $result = mysqli_query($con, "select * from rekening_bank where ID_REKENING = '$id_rekening'");
    while($data_rekening = mysqli_fetch_assoc($result)){
    $nama_admin = $data_rekening['ATAS_NAMA'];
    $nama_rekening = $data_rekening['NAMA_REKENING'];
    $nomer_rekening = $data_rekening['NOMOR_REKENING'];
    }
?>

<form action="verif_pembayaran_query.php" method="post" enctype="multipart/form-data">
<div class="container container-fluid-md">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-9 pt-4">

            <div class="card shadow p-5">
            <h2 class="text-center font-m-semi border-bottom mb-3">Verifikasi Pembayaran</h2>
            <div class="">
            <dl class="row" style="font-weight: 600;">
                <dd class="col-sm-4">Nama Bank</dd>
                <dd class="col-sm-1 text-right">:</dd>
                <dd class="col-sm-5"><?=$nama_rekening?></dd>

                <dd class="col-sm-4">Nomor Rekening</dd>
                <dd class="col-sm-1 text-right">:</dd>
                <dd class="col-sm-5"><?=$nomer_rekening?></dd>

                <dd class="col-sm-4">Atas Nama</dd>
                <dd class="col-sm-1 text-right">:</dd>
                <dd class="col-sm-5"><?=$nama_admin?></dd>
            </dl>
            </div>
            <div class="custom-file mb-5 ">
                <input type="hidden" name="id_pesanan" value="<?=$id_pesanan?>">
                <input type="hidden" name="id_bank" value="<?=$id_rekening?>">
                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept=".jpg, .jpeg, .png">
                <label class="custom-file-label" for="inputGroupFile01">Upload Bukti Pembayaran</label>
                <label for="uploadfile">Silahkan Transfer dan Upload bukti pembayaran, paling lambat 24 jam, agar pemesanan segera diproses, untuk melihat pesanan silahkan klik <a href="history_user.php">disini.</a></label>
            </div> 
            <div class="text-center">
            <input type="submit" name="verif_pembayaran" class="btn btn-primary font-m-med mb-5 mt-4 w-25" value="Selesai">
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
    </form>
    </div>
</div>


<script src="src/js/main.js"></script>

<?php

    require 'includes/footer.php';

?>