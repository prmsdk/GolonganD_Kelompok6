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
    <div class="banner-absolute text-light text-center font-m-semi">
    <h1 class="w-75 mx-auto"><?=$desc?></h1>
    <a class="btn btn-primary btn-lg mt-2" href="<?=$link?>" role="button"><?=$tombol?></a>
    </div>
</div>
<?php
}
?>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="nextt" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

</div>