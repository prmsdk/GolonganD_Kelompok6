<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animation-slider.css" media="all">
    
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
    <header>
        <div id="logo">
            <a href="#slidercontainer">
                <h1>CAHAYA ABADI</h1>
                <h2>PERKASA</h2>
            </a>
        </div>

        <nav>
            <ul class="akunuser">
                <li><a href="#produk">Produk</a></li>
                <li><a href="#testimoni">Testimoni</a></li>
                <li><a href="#buttoncarakerja">Cara Kerja</a></li>
                <li><a href="#contactus">Contact Us</a></li>
            </ul>
            <ul class="akunmasuk">
                <li><a href="#" style="color: #F69322">Login</a></li>
                <li><a href="#" style="color: #25A8E0">Register</a></li>
            </ul>
        </nav>
    </header>
    
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
        <section id="slidercontainer">
            <div id="css3slider">
                <img src="img/slider/slider-1.jpg" alt="SLIDER1">
                <img src="img/slider/slider-2.jpg" alt="SLIDER2">
                <img src="img/slider/slider-3.jpg" alt="SLIDER3">
            </div>
        </section>

        <div id="buttoncarakerja"></div>
        <section id="carakerja">
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
        </section>

        <section id="produk">

        </section>

        <section id="testimoni">
            
        </section>

        <footer>
            <div id="contactus">

            </div>
            <div class="copyright">

            </div>
        </footer>
    </div>
</body>
</html>