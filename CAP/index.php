<?php

    require 'includes/config.php';
    require 'includes/header_home.php';
    require 'slider.php';
    require 'pilih_produk.php';

    

?>

<!-- ============ INI ISI DARI HALAMAN UTAMA ============== -->

<!-- CARA KERJA -->
<span id="carakerjabtn" class="anchor"></span>
<section id="carakerja" class="text-center mt-5 font-m-semi">
    <div class="container container-fluid-md">
    <h2>CARA KERJA PEMESANAN</h2>
        <div class="row text-left">
        <div class="col-lg">
            <div class="card card-ck mb-3">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-sm-4">
                    <img src="src/img/icons/cara-1.png" class="img-fluid mt-4 ml-3" alt="CARA3">
                    </div>
                    <div class="col-lg-7 col-sm-8">
                        <div class="card-body font-m-med mt-3">
                            <h5 class="card-text">Pilih Produk,</h5>
                            <h5 class="card-text">Lengkapi Form Pengisian,</h5>
                            <h5 class="card-text">Upload Desain/ Hubungi Desainer</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
        <div class="card card-ck mb-3">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-sm-4">
                    <img src="src/img/icons/cara-2.png" class="img-fluid mt-4 ml-3" alt="CARA3">
                    </div>
                    <div class="col-lg-7 col-sm-8">
                        <div class="card-body font-m-med mt-3">
                            <h5 class="card-text">Bayar DP/ Nego,</h5>
                            <h5 class="card-text">Login dan Isi data diri Anda,</h5>
                            <h5 class="card-text">Tunggu Notifikasi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card card-ck mb-3">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-sm-4">
                        <img src="src/img/icons/cara-3.png" class="img-fluid mt-4 ml-3" alt="CARA3">
                    </div>
                    <div class="col-lg-7 col-sm-8">
                        <div class="card-body font-m-med mt-3">
                            <h5 class="card-text">Upload Bukti Pembayaran,</h5>
                            <h5 class="card-text">Pesanan Dikirim,</h5>
                            <h5 class="card-text">Berikan Feedback</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- END CARA KERJA -->

<!-- PORTFOLIO -->
<span id="portfoliobtn" class="anchor"></span>
<section id="portfolio" class="text-center mt-5 py-5 font-m-semi">
    <div class="container container-fluid-md">
    <h2>PORTFOLIO</h2>
    <div class="portfolio-cap">
        <div class="row mt-5 px-5 text-center justify-content-center font-m-light">
            <?php
            $result_portfolio = mysqli_query($con, "SELECT * FROM portfolio");
            while($data_portfolio = mysqli_fetch_assoc($result_portfolio)){
            $id_portfolio = $data_portfolio['ID_PORTFOLIO'];
            $judul_port = $data_portfolio['JUDUL'];
            $deskripsi_port = $data_portfolio['DESKRIPSI'];
            $link_port = $data_portfolio['LINK'];
            $gambar_port = $data_portfolio['GAMBAR'];
            ?>
            <div class="col-lg-4 mb-3 col-md-6">
                <div class="card mb-3 shadow">
                    <a class="portfolio-link" data-toggle="modal" href="#<?=$id_portfolio?>">
                    <img src="src/img/portfolio/<?=$gambar_port?>" style="height: 300px;" class="card-img-top img-fluid" alt="<?=$judul_port?>">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title font-m-semi"><?=$judul_port?></h5>
                        <p style="font-size: 10pt;" class="card-text"><?=$deskripsi_port?></p>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
    </div>
</section>
<!-- END PORTFOLIO -->

<span id="testimonibtn" class="anchor"></span>
<section id="testimoni" class="text-center mt-3 font-m-semi">
    <div class="container testi">
        <div class="row pb-3">
            <div class="col-md-8 offset-md-2 col-10 offset-1 pb-5">
                <h2 class="text-center mt-5 mb-5 pb-2 text-uppercase text-dark"><strong>Testimonials</strong></h2>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators" style="z-index: 1;">
                    <?php
                    $result_testi = mysqli_query($con, "SELECT * FROM testimonial");
                    $result_count = mysqli_num_rows($result_testi);
                    for($i = 0; $i < $result_count; $i++){
                    ?>
                    <li class="" data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>" class="<?php if($i == 0){echo "active";}?>"></li>
                    <?php }?>
                    </ol>
                    <div class="carousel-inner mt-4">
                        <?php
                        $i = 0;
                        while($data_testimonial = mysqli_fetch_assoc($result_testi)){
                        $id_testi = $data_testimonial['ID_TESTI'];
                        $nama_testi = $data_testimonial['TESTI_NAMA'];
                        $profesi_testi = $data_testimonial['TESTI_PROFESI'];
                        $deskripsi_testi = $data_testimonial['TESTI_DESC'];
                        $gambar_testi = $data_testimonial['TESTI_FOTO'];
                        ?>
                        <div class="carousel-item text-center <?php if($i == 0){echo "active";}?>">
                            <div class="img-box p-1 shadow border rounded-circle m-auto">
                                <img class="img-fluid d-block h-100 w-100 rounded-circle" src="src/img/testimonial/<?=$gambar_testi?>" alt="<?=$nama_testi?>">
                            </div>
                            <h5 class="mt-4 mb-0"><strong class="text-light text-uppercase"><?=$nama_testi?></strong></h5>
                            <h6 class="text-dark m-0"><?=$profesi_testi?></h6>
                            <p class="m-0 pt-3 text-white">"<?=$deskripsi_testi?>"</p>
                        </div>
                        <?php
                        $i+=1; 
                        }?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>            
        </div>
    </div>
</div>
</section>
<?php
if($_SESSION['status']!='login'){
?>
<section id="daftar">
    <div class="daftar-gambar">
    <div class="daftar-absolute">
    <div class="container container-fluid-md">
        <div class="row my-5">
            <div class="col-lg">
                    <div class="row no-gutters justify-content-center text-light">
                        <div class="col-lg-8 col-sm-12 my-auto">
                            <div class="card-body font-m-med ml-3 mt-1">
                                <h2>Cetak Buku, Kalender, Brosur, dan hal lainnya yang kamu butuhkan tanpa ribet? <br><span>Segera Daftar Sekarang!</span></h2>
                                <a class="btn btn-primary btn-lg" href="register_user.php" role="button">DAFTAR</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-0">
                            <img src="src/img/stuff/laptop-01.png" class="img-fluid mt-4 ml-3" alt="CARA1">
                        </div>
                    </div>
            </div> 
        </div>
    </div>
    </div>
    </div>
</section>
<?php }
$result_adm = mysqli_query($con, "SELECT * FROM admin WHERE ADM_ID = 'ADM000001'");
$data_adm = mysqli_fetch_assoc($result_adm);
?>

<div class="container">
<section id="contact" class="pt-3 my-5 font-m-light text-center">
    <h2 class="font-m-bold pt-5">HUBUNGI KAMI</h2>
    <h5 class="w-75 mx-auto">Isi formulir dibawah untuk memberi saran, menanyakan ketersediaan produk yang tak tersedia di Website kami, atau menghubungi kami.</h5>
    
    <form action="contact_us.php" method="post">
    <div class="row text-left mt-5">
        <div class="col-6">
            <div class="form-group">
                <input type="text" class="form-control" id="kontak_nama" name="kontak_nama" aria-describedby="usernameHelp" placeholder="Masukkan Nama" required pattern="^[A-Za-z -.]+$" title="Mohon masukkan hanya huruf">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="kontak_email" name="kontak_email" aria-describedby="usernameHelp" placeholder="Masukkan Email" required title="Mohon masukkan Email Valid">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="kontak_telepon" name="kontak_telepon" aria-describedby="usernameHelp" placeholder="Masukkan Telepon/HP" required pattern="[0-9 ()]{12,13}" title="Mohon masukkan hanya angka dan ( ), 12 - 13 digit">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="kontak_subject" name="kontak_subject" aria-describedby="usernameHelp" placeholder="Masukkan Subject" required>
            </div>
            <div class="form-group">
                <textarea name="kontak_pesan" id="kontak_pesan" class="form-control" placeholder="Tuliskan pesan yang anda kirimkan, minimal 20 karakter" required minlength=20 title="Kirim Komplain, Request Produk, dan Mulai kerja sama perusahaan dengan cara menghubungi kami dan mengisi form ini."></textarea>
            </div>
            <div class="form-froup text-right">
                <input type="submit" name="kontak_kirim" id="kontak_kirim" class="btn btn-primary" value="KIRIM">
            </div>
            </form>
        </div>
        <div class="col-6 text-center">
            <h2>KONTAK KAMI</h2>
            <div class="row text-left justify-content-center mt-3">
                <div class="col-1 text-right">
                    <p><i class="fa fa-tag fa-1x"></i></p>
                </div>
                <div class="col-8">
                    <p>
                    CV. <?=$data_adm['ADM_NAMA_USAHA_ADM']?> <br> <?=$data_adm['ADM_ALAMAT']?>
                    </p>
                </div>
            </div>
            <div class="row text-left justify-content-center">
                <div class="col-1 text-right">
                    <p><i class="fa fa-phone fa-1x"></i></p>
                </div>
                <div class="col-8">
                    <p>
                    <?=$data_adm['ADM_NO_HP']?> (Hp) <br> <?=$data_adm['ADM_NO_TELP']?> (Telp)
                    </p>
                </div>
            </div>
            <div class="row text-left justify-content-center">
                <div class="col-1 text-right">
                    <p><i class="fa fa-envelope fa-1x"></i></p>
                </div>
                <div class="col-8">
                    <p>
                    <?=$data_adm['ADM_EMAIL']?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<section id="about">
    <div class="about-gambar">
    <div class="about-absolute">
    <div class="container container-fluid-md">
        <div class="row my-5">
            <div class="col-lg">
                <div class="row no-gutters justify-content-center text-light">
                    <div class="col-lg-10 col-sm-12 my-auto">
                        <div class="card-body text-center my-auto font-m-med ml-3 mt-1">
                            <h2>CV. <?=$data_adm['ADM_NAMA_USAHA_ADM']?></h2>
                            <?php
                            $deskripsi_admin = $data_adm['ADM_DESC'];
                            ?>
                            <h5 class="text-justify"><?=$deskripsi_admin?></h5>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    </div>
    </div>
</section>

<!-- Modal 1 -->
<?php
$result_portfolio2 = mysqli_query($con, "SELECT * FROM portfolio");
while($data_portfolio2 = mysqli_fetch_assoc($result_portfolio2)){
$id_portfolio = $data_portfolio2['ID_PORTFOLIO'];
$judul_port = $data_portfolio2['JUDUL'];
$deskripsi_port = $data_portfolio2['DESKRIPSI'];
$link_port = $data_portfolio2['LINK'];
$gambar_port = $data_portfolio2['GAMBAR'];
?>
<div class="portfolio-modal modal fade bd-example-modal-lg" id="<?=$id_portfolio?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
            <div class="rl"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
            <div class="col-lg-12 mx-auto text-center justify-content-center">
                <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase"><?=$judul_port?></h2>
                <img class="img-fluid d-block mx-auto rounded" src="src/img/portfolio/<?=$gambar_port?>" width="100%" alt="">
                <button class="btn mt-4 btn-primary mx-auto" data-dismiss="modal" type="button">
                    <i class="fas fa-times"></i>
                    Close </button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php 
}
    require 'includes/footer.php';

?>