<?php

    include 'includes/config.php';
    require 'includes/header.php';
    if(isset($_GET['produk_id'])){
        $produk_id = $_GET['produk_id'];
        // SELECT DARI TAMPIL PRODUK
        $data = mysqli_query($con, "select * from tampil_produk where ID_TAMPIL_PRODUK = '$produk_id'");
        while($data_produk = mysqli_fetch_assoc($data)){
            $nama_produk = $data_produk['NAMA_TAMPIL_PRODUK'];
            $deskirpsi_produk = $data_produk['DESC_TAMPIL_PRODUK'];
            $tabel_produk = $data_produk['KET_TAMPIL_PRODUK'];
        }
?>

<div class="bg-light">
<div class="p-2 mb-2 bg-secondary text-center cutom-inline">
    <h1 class="text-white font-m-bold pt-2">Cetak <?=$nama_produk?></h1>
</div>
<!-- MENAMPILKAN WARNING ESTIMASI ANTRIAN -->
<?php
$result_pesanan = mysqli_query($con, "SELECT * FROM pesanan WHERE STATUS_PESANAN = 1 OR STATUS_PESANAN = 2 OR STATUS_PESANAN = 3");
$row_pesanan = mysqli_num_rows($result_pesanan);
$result_jam = mysqli_query($con, "SELECT SUM(ANTRIAN) AS JAM FROM pesanan WHERE STATUS_PESANAN = 1 OR STATUS_PESANAN = 2 OR STATUS_PESANAN = 3");
$data_jam = mysqli_fetch_assoc($result_jam);
$antrian_jam = $data_jam['JAM'];

$int_jam = $antrian_jam/24;
$mod_jam = $antrian_jam%24;
?>

<div class="container pt-2">
    <div class="alert text-center alert-warning" role="alert">
        <h4 class="alert-heading font-weight-bold">Perhatian!</h4>
        <p class="w-75 mx-auto">Perhatikan sebelum melakukan pemesanan, kami menginformasikan bahwa transaksi online yang sedang dalam antrian dan sedang diproses saat ini sebanyak <strong><?=$row_pesanan?> Pesanan</strong> Mohon pertimbangkan terlebih dahulu sesuai kebutuhan Anda sebelum melakukan pemesanan, Terimakasih.</p>
        <hr>
        <p class="mb-0 w-50 mx-auto">Jika anda melakukan pemesanan, Pesanan Anda diperkirakan akan dikerjakan <strong><?=intval($int_jam)?> hari <?=$mod_jam?> jam</strong> yang akan datang <strong>(<?=$antrian_jam?> jam dari sekarang)</strong></p>
    </div>
    <!-- MENAMPILKAN SLIDE SHOW GAMBAR PRODUK -->
        <div class="row">
            <div class="col-lg-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        </ol>
        <div class="carousel-inner">
        <?php
            $output = '';
            $count = 0;
            // SELECT GAMBAR dari tabel gambar_produk berdasarkan ID_PRODUK
            $result = mysqli_query($con, "select * from gambar_produk where ID_TAMPIL_PRODUK = '$produk_id' LIMIT 3");
            while($data_gambar = mysqli_fetch_array($result))
            {
                if($count == 0){
                    $output = 'active';
                }
                else{
                    $output = '';
                }
                echo '
                <div class="carousel-item '.$output.'">
                <img src="pictures/produk_thumb/'.$data_gambar['GBR_FILE_NAME'].'" class="d-block w-100 img-fluid" alt="...">
                </div>';  
                $count+=1;
            }
        ?>
            
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
        <!-- MENAMPILKAN THUMBNAIL GAMBAR PRODUK -->
        <div class="pt-3">
            <?php
                $i = 0;
                $result = mysqli_query($con, "select * from gambar_produk where ID_TAMPIL_PRODUK = '$produk_id'");
                while($data_gambar = mysqli_fetch_assoc($result)){
                    $gambar_produk = $data_gambar['GBR_FILE_NAME'];
                    echo '<img src="pictures/produk_thumb/'.$gambar_produk.'" data-target="#carouselExampleIndicators" class="p-2 mb-5" data-slide-to="'.$i.'" style="width: 33%;" >';
                    $i+=1;
                }
            }
            ?>
        </div>
        </div>
        <div class="col-lg-6">
            <div class="font-m-semi border-bottom mb-3">
            <h2><?=$nama_produk?></h2>
            </div>
            <p class="text-justify my-4"><?=$deskirpsi_produk?></p>
            <div class="overflow-auto mb-4">
            <?php
                require 'src/file/'.$tabel_produk;
            ?>
            </div>
            <div class="text-center">
            <a href="pemesanan.php?produk_id=<?=$produk_id?>" class="btn btn-primary mr-1 font-m-med mb-5">Pesan Sekarang</a>
            <a href="index.php" class="btn btn-secondary font-m-med mb-5">Kembali</a>
            </div>
        </div>
    </div>
</div>
</div>

<?php
    require 'includes/footer.php';
?>