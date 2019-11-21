<?php
    include 'includes/config.php';

    $result = mysqli_query($con, "SELECT tampil_produk.NAMA_TAMPIL_PRODUK, tampil_produk.ID_TAMPIL_PRODUK, gambar_produk.GBR_FILE_NAME,
    (warna.HARGA_WARNA + ukuran.HARGA_UKURAN) + bahan.ISI_PER_BAHAN * (bahan.HARGA_BAHAN * (1 / satuan_bahan.JUMLAH_SATUAN)) 
    FROM
    tampil_produk, warna, bahan, ukuran, tampil_warna, tampil_ukuran, tampil_bahan, gambar_produk, satuan_bahan
    WHERE
    tampil_produk.ID_TAMPIL_PRODUK = tampil_warna.ID_TAMPIL_PRODUK AND
    tampil_produk.ID_TAMPIL_PRODUK = tampil_ukuran.ID_TAMPIL_PRODUK AND
    tampil_produk.ID_TAMPIL_PRODUK = tampil_bahan.ID_TAMPIL_PRODUK AND
    tampil_warna.ID_WARNA = warna.ID_WARNA AND
    tampil_ukuran.ID_UKURAN = ukuran.ID_UKURAN AND
    tampil_bahan.ID_BAHAN = bahan.ID_BAHAN AND
    tampil_produk.ID_TAMPIL_PRODUK = gambar_produk.ID_TAMPIL_PRODUK AND
    satuan_bahan.ID_SATUAN = bahan.ID_SATUAN
    
    ORDER BY 
    (warna.HARGA_WARNA + ukuran.HARGA_UKURAN) + bahan.ISI_PER_BAHAN * (bahan.HARGA_BAHAN * (1 / satuan_bahan.JUMLAH_SATUAN))
    ASC
    LIMIT 1");
?>
<span id="produkbtn" class="anchor"></span>
<div class="container container-fluid-md">
    <section id="produk" class="text-center mt-5 font-m-semi">
        <h2 class="pt-5">PRODUK KAMI</h2>
        <div class="produk-card">
            <div class="row mt-5 text-center justify-content-center font-m-light">
                <?php
                while($data_produk = mysqli_fetch_assoc($result)){
                    $produk_id = $data_produk['ID_TAMPIL_PRODUK'];
                    $produk_nama = $data_produk['NAMA_TAMPIL_PRODUK'];
                    $produk_harga = $data_produk['(warna.HARGA_WARNA + ukuran.HARGA_UKURAN) + bahan.ISI_PER_BAHAN * (bahan.HARGA_BAHAN * (1 / satuan_bahan.JUMLAH_SATUAN))'];
                    $produk_harga_awal = substr($produk_harga, 0, -5);
                    $gambar_produk = $data_produk['GBR_FILE_NAME'];
                ?>
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <a href="produk_user.php?produk_id=<?=$produk_id?>">
                        <img src="src/img/produk/<?=$gambar_produk?>" class="card-img-top " alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title font-m-semi"><?=$produk_nama;?></h5>
                            <p class="card-text small">Mulai dari Rp. <?=$produk_harga_awal?>/psc</p>
                            <a href="produk_user.php?produk_id=<?=$produk_id?>" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <img src="src/img/icons/cara-3.png" class="card-img-top p-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-m-semi">Nama Produk</h5>
                            <p class="card-text">Contoh Deskripsi Produk yang akan ditampilkan dibawah judul produk.</p>
                            <a href="#" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <img src="src/img/icons/cara-3.png" class="card-img-top p-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-m-semi">Nama Produk</h5>
                            <p class="card-text">Contoh Deskripsi Produk yang akan ditampilkan dibawah judul produk.</p>
                            <a href="#" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <img src="src/img/icons/cara-3.png" class="card-img-top p-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-m-semi">Nama Produk</h5>
                            <p class="card-text">Contoh Deskripsi Produk yang akan ditampilkan dibawah judul produk.</p>
                            <a href="#" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Batas ROW -->

            <div class="row mt-3 text-center justify-content-center font-m-light">
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <img src="src/img/icons/cara-3.png" class="card-img-top p-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-m-semi">Nama Produk</h5>
                            <p class="card-text">Contoh Deskripsi Produk yang akan ditampilkan dibawah judul produk.</p>
                            <a href="#" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <img src="src/img/icons/cara-3.png" class="card-img-top p-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-m-semi">Nama Produk</h5>
                            <p class="card-text">Contoh Deskripsi Produk yang akan ditampilkan dibawah judul produk.</p>
                            <a href="#" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <img src="src/img/icons/cara-3.png" class="card-img-top p-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-m-semi">Nama Produk</h5>
                            <p class="card-text">Contoh Deskripsi Produk yang akan ditampilkan dibawah judul produk.</p>
                            <a href="#" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="card mb-3">
                        <img src="src/img/icons/cara-3.png" class="card-img-top p-4" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-m-semi">Nama Produk</h5>
                            <p class="card-text">Contoh Deskripsi Produk yang akan ditampilkan dibawah judul produk.</p>
                            <a href="#" class="btn btn-primary font-m-med">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>