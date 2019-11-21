<?php
    require 'includes/header.php';
    include 'includes/config.php';
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
            <div class="border-bottom border-warning font-m-semi">
            <h2><?=$nama_produk?></h2>
            </div>
            <p class="pt-3 font-m-semi">Pilih Warna :</p>
            <div ckass="">
                <?php
                $i = 1;
                $result = mysqli_query($con, "select * from tampil_warna, warna where ID_TAMPIL_PRODUK = '$produk_id' and warna.ID_WARNA = tampil_warna.ID_WARNA");
                    while($data_warnad = mysqli_fetch_assoc($result)){
                        $detail_warna = $data_warnad['ID_WARNA'];
                        $nama_warna = $data_warnad['JENIS_WARNA'];
                        echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                        <input type="radio" id="pilihwarna'.$i.'" name="pilihwarna" value="'.$detail_warna.'" class="custom-control-input">
                        <label class="custom-control-label" for="pilihwarna'.$i.'">'.$nama_warna.'</label>
                        </div>';
                        $i+=1;
                }   
            ?>           
            </div>
            <p class="pt-3 font-m-semi">Pilih Bahan :</p>
            <div ckass="">
                <?php
                $i = 1;
                $result = mysqli_query($con, "select * from tampil_bahan, bahan where ID_TAMPIL_PRODUK = '$produk_id' and bahan.ID_BAHAN = tampil_bahan.ID_BAHAN");
                    while($data_bahan = mysqli_fetch_assoc($result)){
                        $detail_bahan = $data_bahan['ID_BAHAN'];
                        $nama_bahan = $data_bahan['NAMA_BAHAN'];
                        echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                        <input type="radio" id="pilihbahan'.$i.'" name="pilihbahan" value="'.$detail_bahan.'" class="custom-control-input">
                        <label class="custom-control-label" for="pilihbahan'.$i.'">'.$nama_bahan.'</label>
                        </div>';
                        $i+=1;
                }   
            ?>           
            </div>
            <p class="pt-3 font-m-semi">Pilih Ukuran :</p>
            <div ckass="">
                <?php
                $i = 1;
                $result = mysqli_query($con, "select * from tampil_ukuran, ukuran where ID_TAMPIL_PRODUK = '$produk_id' and ukuran.ID_UKURAN = tampil_ukuran.ID_UKURAN");
                    while($data_ukuran = mysqli_fetch_assoc($result)){
                        $detail_ukuran = $data_ukuran['ID_UKURAN'];
                        $nama_ukuran = $data_ukuran['JENIS_UKURAN'];
                        echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                        <input type="radio" id="pilihukuran'.$i.'" name="pilihukuran" value="'.$detail_ukuran.'" class="custom-control-input">
                        <label class="custom-control-label" for="pilihukuran'.$i.'">'.$nama_ukuran.'</label>
                        </div>';
                        $i+=1;
                }
    }   
            ?>           
            </div>
            <p class="font-m-semi">Desain</p>
            <div class="pl-4 mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="pilihdesain1" name="pilihdesain" class="custom-control-input">
                    <label class="custom-control-label" for="pilihdesain1">Upload Desain</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="pilihdesain2" name="pilihdesain" class="custom-control-input">
                    <label class="custom-control-label" for="pilihdesain2">Belum punya Desain</label>
                </div>
            </div>
            <div class="custom-file p-4">
                <input type="file" class="custom-file-input" id="uploadfile" readonly>
                <label class="custom-file-label" for="uploadfile">Pilih File</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            <p class="font-m-semi">Jumlah</p>
            <input type="number" class="form-control mb-4" placeholder="Masukkan Jumlah Cetak">
            <p class="font-m-semi">TOTAL</p>
            <div class="pl-4 mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="total1" name="total" class="custom-control-input">
                    <label class="custom-control-label" for="total1">Uang muka</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="total2" name="total" class="custom-control-input">
                    <label class="custom-control-label" for="total2">Lunas</label>
                </div>
            </div>
            <input type="number" name="" id="" class="form-control mb-4" placeholder="Total Pembayaran" disabled>
            <div class="cutom-inline text-center">
                <a href="#" class="btn btn-primary font-m-med">Keranjang</a>
                <a href="#" class="btn btn-primary font-m-med">Bayar</a>
            </div>
            </div>
            <div class="pt-5 mb-4">
                <div class="card shadow col-lg p-5 bg-light text-dark">
                    <div class="font-m-semi">
                        <h6>Langkah-Langkah Pemesanan Cetak Secara Online</h6>
                    </div>
                <p>1. Lengkapi formulir di atas<br>- Silahkan pilih salah satu warna, bahan, dan ukuran. upload desain kamu jika ada.</br></p>
                <p>2. Konfirmasi Pemesanan<br>- Silahkan pilih salah satu warna, bahan, dan ukuran. upload desain kamu jika ada.</br></p>
                <p>3. Pembayaran<br>- Silahkan pilih salah satu warna, bahan, dan ukuran. upload desain kamu jika ada.</br></p>
                <p>4. Proses Produksi<br>- Silahkan pilih salah satu warna, bahan, dan ukuran. upload desain kamu jika ada.</br></p>
                <p>5. Diambil atau Dikirim<br>- Silahkan pilih salah satu warna, bahan, dan ukuran. upload desain kamu jika ada.</br></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="src/js/main.js"></script>

<?php
    require 'includes/footer.php';
?>