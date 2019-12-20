<?php
    include 'includes/config.php';
    require 'includes/header.php';

    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
    } 
?>

<div class="container container-fluid-md">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-9 pt-4">

            <div class="card shadow p-5">
            <form action="pemesanan_query.php" method="post">
                <input type="hidden" name="id_user" value="<?=$id_user?>">
                    <p class="pt-3 font-m-semi">Detail Pemesanan :</p>          
                    <div class="modal-body">
                        <table class="show-cart-bayar table">
                        
                        </table>
                        <div class="text-right">Total pembayaran: Rp. <span class="total-cart"></span></div>
                    </div>

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
                        <input type="submit"    name="pemesanan_produk" value="Bayar" class="btn btn-primary font-m-med">
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