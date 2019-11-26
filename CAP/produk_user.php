<?php
    require 'includes/header.php';
    include 'includes/config.php';
    if(isset($_GET['produk_id'])){
        $produk_id = $_GET['produk_id'];
        $data = mysqli_query($con, "select * from tampil_produk where ID_TAMPIL_PRODUK = '$produk_id'");
        while($data_produk = mysqli_fetch_assoc($data)){
            $nama_produk = $data_produk['NAMA_TAMPIL_PRODUK'];
            $deskirpsi_produk = $data_produk['DESC_TAMPIL_PRODUK'];
            $tabel_produk = $data_produk['KET_TAMPIL_PRODUK'];
        }
    function gambar_slide($con){
        
    }
?>

<div class="bg-light">
<div class="p-2 mb-4 bg-secondary text-center cutom-inline">
    <h1 class="text-white font-m-bold pt-2">Cetak <?=$nama_produk?></h1>
</div>
<div class="container pt-4">
        <div class="row">
            <div class="col-lg-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        </ol>
        <div class="carousel-inner">
        <?php
            $output = '';
            $count = 0;
            $result = mysqli_query($con, "select * from gambar_produk where ID_TAMPIL_PRODUK = '$produk_id'");
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
                <img src="src/img/produk/'.$data_gambar['GBR_FILE_NAME'].'" class="d-block w-100" alt="...">
                </div>';  
                $count+=1;
            }
            // return $output;
        ?>
            <!-- <div class="carousel-item active">
            <img src="src/img/produk/brosur1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="src/img/produk/brosur2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="src/img/produk/brosur3.jpg" class="d-block w-100" alt="...">
            </div> -->
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
        <div class="pt-3">
            <?php
                $i = 0;
                $result = mysqli_query($con, "select * from gambar_produk where ID_TAMPIL_PRODUK = '$produk_id'");
                while($data_gambar = mysqli_fetch_assoc($result)){
                    $gambar_produk = $data_gambar['GBR_FILE_NAME'];
                    echo '<img src="src/img/produk/'.$gambar_produk.'" data-target="#carouselExampleIndicators" class="p-2 mb-5" data-slide-to="'.$i.'" style="width: 33%;" >';
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