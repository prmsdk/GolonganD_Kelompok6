<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/css/main.css">
    <link rel="stylesheet" href="src/css/animation-slider.css">
    <link rel="stylesheet" href="src/css/kategori.css">

    <!--
    <style type="text/css">
		.containerr{
			width: 500px;
            margin: auto;
            position: fixed;
            top:300px;
            left 250px;
            z-index: 99;
			background: #F3F3F3;
			box-shadow: 5px 5px 5px 5px #555;
			text-align: center;
        }
        
		.containerr_2{
			width: 60px;
			margin: auto;
        }
        
		.containerr p{
			background-color: magenta;
			width: 300px;
			margin: auto;
			padding: 5px;
			border-radius: 5px;
		}
		
    </style>
    -->

    <title>Cahaya Abadi Perkasa</title>
</head>
<body>

    <header id="info">
        <p>
            <img src="img/icons/telepon.png" alt="telepon">
            (0331) 412990
        </p>
    </header>

    <header id="navbar">
        <div id="logo">
            <a href="#slidercontainer">
                <h1>CAHAYA ABADI PERKASA</h1>
            </a>
        </div>

        <nav>
            <ul class="akunuser">
                <a href="#" onclick="TopScroll(); KatSekolah();"><li>Sekolah</li></a>
                <a href="#" onclick="TopScroll(); KatUsaha();"><li>Usaha</li></a>
                <a href="#buttoncarakerja"><li>Packaging</li></a>
                <a href="#buttoncarakerja"><li>Promosi</li></a>
                <a href="#contactus"><li>Other</li></a>
            </ul>
            <ul>

            </ul>
            <ul class="akunmasuk">
                <a href="#" style="color: #F69322"><li>Login</li></a>
                <a href="#" style="color: #25A8E0"><li>Register</li></a>
            </ul>
        </nav>
    </header>

    <div id="slidercontainer">
        
        <div class="overlay-slider"></div>
    <!-- Slideshow container -->
        <div class="slideshow-container">

        <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <a href="produk.php">
                    <div class="numbertext">1 / 3</div>
                    <img src="img/slider/print-1.jpg">
                </a>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="img/slider/print-2.jpg">
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="img/slider/print-5.jpg">
                <div class="text">Caption Three</div>
            </div>

        <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

    </div>
    
    <!--
    <div class="containerr">
		<h1>Cara Mengetahui Lebar dan Tinggi Jendela Web Browser</h1>
		<p id="demo"></p>
		
	    <script>
        var widthNode = window.innerWidth
        document.documentElement.clientWidth
        document.body.clientWidth;

        var heightNode = window.innerHeight
        document.documentElement.clientHeight
        document.body.clientHeight;

        var demoNode = document.getElementById("demo");
        demoNode.innerHTML = "Telah di Ketahui tinggi dan lebar jendela Web Browser ini Adalah: <br> " + "Lebar "+ widthNode + ", Tinggi: " + heightNode + ".";
        </script>
    </div>
    -->

    <div class="container">

        <!-- ============= INI ISI DARI KATEGORI COOYY =============== -->

        <section>
            <div id="kategori-sekolah" style="display:none;">
                <div class="kat">
                    <h2>PILIH PRODUK</h2>
                    <div class="grid-container">
                        <a href="#"><div class="grid-item">BUKU</div></a>
                        <a href="#"><div class="grid-item">IJAZAH</div></a>
                        <a href="#"><div class="grid-item">RAPOR</div></a>
                        <a href="#"><div class="grid-item">BUKU NOTA</div></a>
                        <a href="#"><div class="grid-item">BUKU KENANGAN</div></a>
                    </div>
                    <div class="grid-gambar">
                        <img src="img/icons/cara-1.png" alt="Gambar Sekolah">
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div id="kategori-usaha" style="display:none;">
                <div class="kat">
                    <h2>PILIH PRODUK</h2>
                    <div class="grid-container">
                        <a href="#"><div class="grid-item">KALENDER</div></a>
                        <a href="#"><div class="grid-item">BROSUR</div></a>
                        <a href="#"><div class="grid-item">FLYER</div></a>
                        <a href="#"><div class="grid-item">KOP SURAT</div></a>
                        <a href="#"><div class="grid-item">MAP</div></a>
                        <a href="#"><div class="grid-item">AMPLOP</div></a>
                        <a href="#"><div class="grid-item">KALENDER</div></a>
                        <a href="#"><div class="grid-item">BROSUR</div></a>
                        <a href="#"><div class="grid-item">FLYER</div></a>
                        <a href="#"><div class="grid-item">KOP SURAT</div></a>
                        <a href="#"><div class="grid-item">MAP</div></a>
                        <a href="#"><div class="grid-item">AMPLOP</div></a>
                    </div>
                    <div class="grid-gambar">
                        <img src="img/icons/cara-2.png" alt="Gambar Usaha">
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ INI ISI DARI HALAMAN UTAMA ============== -->

        

        <section id="produk">
            <h2>PRODUK KAMI</h2>
            <div class="produk-card">
                <div class="row">
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                </div>

        <!-- Batas ROW -->

                <div class="row">
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img src="img/icons/cara-3.png" alt="INICARD">
                            <h5>NAMA PRODUK - 1</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div id="buttoncarakerja"></div>
            <div id="carakerja">
                <h2>CARA KERJA PEMESANAN</h2>
                <div>
                    <img src="img/icons/cara-1.png" alt="CARA 1">
                    <p>Pilih Kategori, <br>Lengkapi Formulir, <br>Upload Desain</p>
                </div>
                <div>
                    <img src="img/icons/cara-2.png" alt="CARA 1">
                    <p>Login Akun, <br>Check Out Bayar, <br>Tunggu Notifikasi</p>
                </div>
                <div>
                    <img src="img/icons/cara-3.png" alt="CARA 1">
                    <p>Tunjukkan Struk, <br>Ambil Pesanan, <br>Beri Testimonial</p>
                </div>
            </div>
        </section>

        <section id="portofolio">
            <h2>PORTOFOLIO</h2>
            <div class="card-portofolio">
                <img src="img/icons/cara-2.png" alt="Gambar Portofolio">
                <div class="overlay-card">Judul Portofolio</div>
            </div>
            <div class="card-portofolio">
                <img src="img/icons/cara-2.png" alt="Gambar Portofolio">
                <div class="overlay-card">Judul Portofolio</div>
            </div>
            <div class="card-portofolio">
                <img src="img/icons/cara-2.png" alt="Gambar Portofolio">
                <div class="overlay-card">Judul Portofolio</div>
            </div>
        </section>

        <section id="testimoni">
            <h2>TESTIMONIAL</h2>
        </section>

        <section id="daftar">
            <div class="daftar-kiri">
                <h2>Cetak Buku, Kalender, Brosur, dan hal lainnya yang kamu butuhkan tanpa ribet? <br><span>Segera Daftar Sekarang!</span></h2>
                <a href="registter.php">
                    <div class="tombol-daftar">
                        <h4>DAFTAR</h4>
                        <div class="tombol-animasi"><h4>DAFTAR</h4></div>
                        
                    </div>
                </a>
            </div>
            <div class="daftar-kanan">
                <img src="img/stuff/laptop-01.png" alt="Gambar daftar">
            </div>
        </section>

        <section id="maps">
            <h2>TEMUKAN KAMI DISINI</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15796.320951698634!2d113.6504616!3d-8.1946722!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa1b14bf0a02f1256!2sCV.%20Cahaya%20Abadi%20Perkasa!5e0!3m2!1sid!2sid!4v1571834460966!5m2!1sid!2sid" frameborder="0" style="border:0;" allowfullscreen="">

            </iframe>
        </section>

        <footer>
            <div id="contactus">

            </div>
            <div class="copyright">
                <p>&copy Copyright 2019 ~ <span style="color: #F69322;">Pe</span><span style="color: #25A8E0;">Takon</span></p>
            </div>
        </footer>
    </div>

    <!-- Membuat script scroll down, sticky-->
    <script src="js/sticky-scroll.js"></script>
    <script src="js/slideshow.js"></script>
    <script src="js/kategori.js"></script>

</body>
</html>