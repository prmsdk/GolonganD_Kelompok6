<?php
    include 'includes/config.php';

    $result_produk = mysqli_query($con, "SELECT * FROM tampil_produk");
    
?>
<span id="produkbtn" class="anchor"></span>
<div class="container container-fluid-md">
    <section id="produk" class="text-center mt-5 font-m-semi">
        <h2 class="pt-5">PRODUK KAMI</h2>
        <div class="produk-card">
            <div class="row mt-5 text-center justify-content-center font-m-light">
                <?php
                while($data_produk = mysqli_fetch_assoc($result_produk)){
                    $produk_id = $data_produk['ID_TAMPIL_PRODUK'];
                    $produk_nama = $data_produk['NAMA_TAMPIL_PRODUK'];
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card shadow mb-3">
                        <a href="produk_user.php?produk_id=<?=$produk_id?>">
                        <?php $result_gambar = mysqli_query($con, "SELECT gambar_produk.GBR_FILE_NAME FROM
                        gambar_produk, tampil_produk WHERE
                        gambar_produk.ID_TAMPIL_PRODUK = tampil_produk.ID_TAMPIL_PRODUK AND
                        tampil_produk.ID_TAMPIL_PRODUK = '$produk_id'
                        LIMIT 1");

                        $data_gambar = mysqli_fetch_assoc($result_gambar);
                        $gambar_produk = $data_gambar['GBR_FILE_NAME'];
                        ?>
                        <div class="inner">
                        <img src="pictures/produk_thumb/<?=$gambar_produk?>" class="card-img-top " alt="...">
                        </div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title font-m-semi"><?=$produk_nama;?></h5>
                            <?php 
                            $result = mysqli_query($con, "SELECT tampil_produk.NAMA_TAMPIL_PRODUK, tampil_produk.ID_TAMPIL_PRODUK,
                            (warna.HARGA_WARNA + ukuran.HARGA_UKURAN) + bahan.ISI_PER_BAHAN * (bahan.HARGA_BAHAN * (1 / satuan_bahan.JUMLAH_SATUAN)) AS HARGA_MIN
                            FROM
                            tampil_produk, warna, bahan, ukuran, tampil_warna, tampil_ukuran, tampil_bahan, satuan_bahan
                            WHERE
                            tampil_produk.ID_TAMPIL_PRODUK = tampil_warna.ID_TAMPIL_PRODUK AND
                            tampil_produk.ID_TAMPIL_PRODUK = tampil_ukuran.ID_TAMPIL_PRODUK AND
                            tampil_produk.ID_TAMPIL_PRODUK = tampil_bahan.ID_TAMPIL_PRODUK AND
                            tampil_warna.ID_WARNA = warna.ID_WARNA AND
                            tampil_ukuran.ID_UKURAN = ukuran.ID_UKURAN AND
                            tampil_bahan.ID_BAHAN = bahan.ID_BAHAN AND
                            satuan_bahan.ID_SATUAN = bahan.ID_SATUAN AND
                            tampil_produk.ID_TAMPIL_PRODUK = '$produk_id'
                            
                            ORDER BY 
                            HARGA_MIN
                            ASC
                            LIMIT 1");

                            $data_harga = mysqli_fetch_assoc($result);
                            $produk_harga = $data_harga['HARGA_MIN'];
                            $produk_harga_awal = substr($produk_harga, 0, -5);
                            ?>
                            <p id="rupiah" class="card-text small">Mulai dari Rp. <?= number_format($produk_harga_awal, 0, ".", ".");?>/psc</p>
                            <a href="produk_user.php?produk_id=<?=$produk_id?>" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
</div>