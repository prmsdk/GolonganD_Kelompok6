<?php
    include 'includes/config.php';
    require 'includes/header.php';

    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
    }

    if(isset($_GET['produk_id'])){
        $produk_id = $_GET['produk_id'];
        $data = mysqli_query($con, "select * from tampil_produk where ID_TAMPIL_PRODUK = '$produk_id'");
            while($data_produk = mysqli_fetch_assoc($data)){
                $nama_produk = $data_produk['NAMA_TAMPIL_PRODUK'];
            }
    
?>

<div class="container container-fluid-md">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-9 pt-4">
            <div class="card shadow p-5">
            <div class="border-bottom text-center border-warning font-m-semi">
            <h2><?=$nama_produk?></h2>
            </div>

            <p class="font-m-semi">Desain</p>
            <div id="pilihan_desain" class="pl-4 mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="pilihdesain1" name="pilihdesain" class="custom-control-input" value="0" required>
                    <label class="custom-control-label" for="pilihdesain1">Upload Desain</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="pilihdesain2" name="pilihdesain" class="custom-control-input" value="1" checked required>
                    <label class="custom-control-label" for="pilihdesain2">Belum punya Desain</label>
                </div>
            </div>
            <form id="uploadImage" action="upload_desain_jquery.php" method="post">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" accept=".zip, .rar, .pdf" class="custom-file-input" id="uploadfile" name="desain" readonly required>
                    <label class="custom-file-label" for="uploadfile">Pilih file</label>
                </div>
                <div class="input-group-append">
                    <input type="submit" id="uploadSubmit" value="Upload" class="btn btn-outline-secondary" onclick="return confirm('Apakah anda yakin ingin mengupload desain? Pilihan anda tidak dapat diubah kembali ketika selesai mengupload desain anda.');">
                </div>
            </div>
            </form>
            <div class="progress mt-2" style="display:none; width: 100%;">
                <div class="progress-bar" width="100%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- <div id="desaindiv"><input type="hidden" class="namadesain" id="namadesain" name="namadesain" value=""></div> -->
            <div id="targetLayer" class="text-center mt-2" style="display:none; width:100%;"></div>
            <div id="loader-icon" class="text-center mt-2" style="display:none; width:100%;"><h5 class="text-gray-500 pt-0">Mohon Tunggu . .</h5></div>
            <label for="uploadfile">Unggah file anda dalam format .zip .rar .pdf (max ukuran file 30mb) Jika ukuran file anda melebihi batas silahkan kirim file melalui <a href="mailto:aldion819@gmail.com">email ini.</a></label>

            <!-- BATAS UPLOAD DESAIN -->
            <form id="form_pemesanan" action="index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="id_produk" value="<?=$produk_id?>" name="id_produk">
            <input type="hidden" id="nama_produk" value="<?=$nama_produk?>" name="nama_produk">
            <input type="hidden" value="<?=$id_user?>" name="id_user">
            
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

                        <input type="radio" namawarna="'.$nama_warna.'" aria-describedby="'.$harga_warna.'" id="pilihwarna'.$i.'" name="pilihwarna" value="'.$detail_warna.'" class="custom-control-input" required>

                        <label class="custom-control-label" for="pilihwarna'.$i.'">'.$nama_warna.'</label>
                        <input type="hidden" id="">
                        </div>';
                        $i+=1;
                }   
            ?>
                <div id="WRN000002" class="box_warna">
                    <select class="form-control w-50" id="warna_khusus">
                        <option value="Cyan">Cyan</option>
                        <option value="Magenta">Magenta</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Black">Black</option>
                        <option value="Redn">Red</option>
                        <option value="Green">Green</option>
                        <option value="Blue">Blue</option>
                    </select>
                </div>
                <div id="WRN000004" class="box_warna">
                    <select class="form-control w-50" id="warna_khusus">
                        <option value="Cyan">Cyan</option>
                        <option value="Magenta">Magenta</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Black">Black</option>
                        <option value="Redn">Red</option>
                        <option value="Green">Green</option>
                        <option value="Blue">Blue</option>
                    </select>
                </div>
                <div id="WRN000005" class="box_warna">
                    <select class="form-control w-50" id="warna_khusus">
                        <option value="Cyan">Cyan</option>
                        <option value="Magenta">Magenta</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Black">Black</option>
                        <option value="Redn">Red</option>
                        <option value="Green">Green</option>
                        <option value="Blue">Blue</option>
                    </select>  
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

                        <input type="radio" namabahan="'.$nama_bahan.'" placeholder="'.$satuan_bahan.'" aria-describedby="'.$harga_bahan.'" id="pilihbahan'.$i.'" name="pilihbahan" value="'.$detail_bahan.'" class="custom-control-input" required>

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

                        <input type="radio" namaukuran="'.$nama_ukuran.'" aria-describedby="'.$harga_ukuran.'" id="pilihukuran'.$i.'" name="pilihukuran" value="'.$detail_ukuran.'" class="custom-control-input" required>

                        <label class="custom-control-label" for="pilihukuran'.$i.'">'.$nama_ukuran.'</label>
                        </div>';
                        $i+=1;
                }
    }   
            ?>           
            </div>
            
            <!-- <div class="custom-file ">
                <input type="file" class="custom-file-input" id="uploadfile" name="desain" readonly required>
                <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                <label for="uploadfile">Unggah file anda dalam format .zip .rar .pdf (max ukuran file 30mb) Jika ukuran file anda melebihi batas silahkan kirim file melalui <a href="mailto:aldion819@gmail.com">email ini.</a></label>
            </div> -->
            


            <p class="font-m-semi mt-3">Jumlah</p>
            <input id="jumlah_produk" type="number" class="form-control mb-4 w-50" placeholder="Masukkan Jumlah Cetak" name="jumlah_produk" required min="1">
            <p class="font-m-semi">TOTAL</p>
            <div id="pembayaran"  class="pl-4 mb-3">
                <div class="custom-control custom-radio custom-control-inline">

                    <input type="radio" id="total1" name="ket_pembayaran" class="custom-control-input" value="2" required>
                    <label class="custom-control-label" for="total1">Uang muka</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="total2" name="ket_pembayaran" class="custom-control-input" value="1" required>

                    <label class="custom-control-label" for="total2">Lunas</label>
                </div>
            </div>
            <input type="number" id="sub_total" class="form-control mb-4 w-50" placeholder="Total Pembayaran" name="sub_total" pattern="(^\d+(\.|\,)\d{2}$)" readonly>

            <!-- <input type="number" id="modal_total" class="form-control mb-4 w-50" placeholder="Modal Pembayaran" name="modal_total" pattern="(^\d+(\.|\,)\d{2}$)" readonly> -->
            
            <input type="hidden" id="var1" class="form-control mb-4 w-50" placeholder="Modal Pembayaran" name="var1" pattern="(^\d+(\.|\,)\d{2}$)" readonly>
            <input type="hidden" id="var2" class="form-control mb-4 w-50" placeholder="Modal Pembayaran" name="var2" pattern="(^\d+(\.|\,)\d{2}$)" readonly>
            <input type="hidden" id="var3" class="form-control mb-4 w-50" placeholder="Modal Pembayaran" name="var3" pattern="(^\d+(\.|\,)\d{2}$)" readonly>
            <input type="hidden" id="var4" class="form-control mb-4 w-50" placeholder="Modal Pembayaran" name="var4" pattern="(^\d+(\.|\,)\d{2}$)" readonly>

            <div class="cutom-inline text-center">
                <?php
                    if(!isset($_SESSION['id_user'])){
                ?>
                <button type="button" class="btn btn-primary" data-target="#login_user" data-toggle="modal">Keranjang</button>
                <button type="button" class="btn btn-primary" data-target="#login_user" data-toggle="modal">Bayar</button>
                <?php }else{?>

                <input type="submit" class="add-to-cart btn btn-primary font-m-med" name="pemesanan_produk" href="index.php" id="keranjang" onclick="return confirm('Yakin memasukkan produk yang anda pilih ke keranjang?');" value="Keranjang">

                <input type="submit" name="pemesanan_produk" value="Bayar" class="btn btn-primary font-m-med">
                <?php }?>
                <a class="btn btn-secondary" href="produk_user.php?produk_id=<?=$produk_id?>">Kembali</a>
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

<!-- <script src="src/js/main.js"></script> -->

<?php

    require 'includes/footer.php';

?>