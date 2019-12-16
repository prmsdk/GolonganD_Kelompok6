<div id="slidercontainer">

<div class="overlay-slider"></div>
<!-- Slideshow container -->
<div class="slideshow-container">

<!-- Full-width images with number and caption text -->
<?php
// include 'includes/config.php';
$a = 0;
$result_slider = mysqli_query($con, "SELECT * FROM slider");
while($data_slider = mysqli_fetch_assoc($result_slider)){
$a +=1;
$tombol = $data_slider['TOMBOL'];
$link = $data_slider['LINK'];
$desc = $data_slider['DESKRIPSI'];
$gambar = $data_slider['GAMBAR'];
?>
<div class="mySlides fadeSlide img-fluid">
    <!-- <div class="numbertext">1 / 3</div> -->
    <img src="src/img/slider/<?=$gambar?>">
    <div class="banner-absolute<?php if($a ==1){echo "1";}else if($a == 2){echo "3";}else if($a ==3){echo "2";}?> text-light text-center font-m-semi">
    <h1><?=$desc?></h1>
    <a class="btn btn-primary btn-lg mt-2" href="<?=$link?>" role="button"><?=$tombol?></a>
    </div>
</div>
<?php
}
?>
<!-- <div class="mySlides fadeSlide img-fluid">
    <img src="src/img/slider/print-5.jpg">
    <div class="banner-absolute3 text-light text-left font-m-semi">
    <h1>Udah deh, tunggu apa lagi? <br> Pesan semua kebutuhan kantor, kebutuhan kuliah, dll. Langsung disini!</h1>
    <a class="btn btn-primary btn-lg mt-2" href="register_user.php" role="button">Daftar Produk</a>
    </div>
</div>

<div class="mySlides fadeSlide img-fluid">
    <img src="src/img/slider/print-2.jpg">
    <div class="banner-absolute2 text-light text-right font-m-semi">
    <h1>Cetak Buku? Notes? LKS? Gift Book?<br> kok masih wira wiri? <br> Ayo Segera Pesan disini saja!</h1>
    <a class="btn btn-primary btn-lg mt-2" href="index.php#produkbtn" role="button">Pesan</a>
    </div>
</div> -->

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="nextt" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

</div>