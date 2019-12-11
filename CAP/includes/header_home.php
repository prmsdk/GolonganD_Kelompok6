<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/css/main.css">
    <link rel="stylesheet" href="src/css/animation-slider.css">
    <link rel="stylesheet" href="src/css/kategori.css">
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <link rel="stylesheet" href="src/css/fontawesome-all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <title>Cahaya Abadi Perkasa</title>
</head>
<body>
  
    <header id="info">
        <p class="m-0 p-2 pr-3 text-light text-right">
            <img src="src/img/icons/telepon.png" height="20" alt="telepon">
            (0331) 412990
        </p>
    </header>

    <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=='gagal'){
                echo '<div id="alert-login" class="alert alert-danger alert-dismissible fade show position-fixed alert-login mx-auto" role="alert">
                        Login anda <strong>Gagal!</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }else if($_GET['pesan']=='logout'){
              echo '<div id="alert-login" class="alert alert-success alert-dismissible fade show position-fixed alert-login mx-auto" role="alert">
                      Anda <strong>Berhasil!</strong> melakukan logout!.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
            }else if($_GET['pesan']=='loginberhasil'){
                $_SESSION['status']='login';
                echo '<div id="alert-login" class="alert alert-success alert-dismissible fade show position-fixed alert-login mx-auto" role="alert">
                        Login <strong>Berhasil!</strong> semoga harimu menyenangkan!.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
        }
    ?>
  <div class="container-fluid-lg">
  <header id="navbar">
    <nav id="logo" class="m-0 navbar navbar-expand-lg navbar-dark nav-tr">
      <a class="navbar-brand logo" href="#slidercontainer" style="color:#F69322;">CAHAYA ABADI PERKASA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link nav-custom" href="#produkbtn">PRODUK <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link nav-custom" href="#carakerjabtn">CARA KERJA</a>
          <a class="nav-item nav-link nav-custom" href="#portfoliobtn">PORTOFOLIO</a>
          <a class="nav-item nav-link nav-custom" href="#testimonibtn">TESTIMONI</a>
          <a class="nav-item nav-link nav-custom" href="#contuctusbtn">CONTACT US</a>
          <?php
              session_start();
              error_reporting(0);
              if($_SESSION['status']=='login'){
                ?><div class="dropdown notif-custom">
                    <a class="nav-item nav-link icon-custom" style="color:#F69322;" type="button" data-toggle="dropdown"><i class="fa fa-bell fa-1x"></i></a>
                    <div class="dropdown-menu dropdown-menu-right p-3 text-center" style="width: 50vw">
                      <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-left">
                          <span><strong>Notifications (3)</strong></span>
                          <a href="#" class="float-right text-dark text-light">Mark all as read</a>
                        </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row">
                          <div class="col-lg-2 col-sm-4 text-right">
                            <img src="http://placehold.it/80x80" class="rounded">
                          </div>    
                          <div class="col-lg-10 col-sm-8 text-left justify-content-start">
                            <a href="#"><strong class="text-info">Pesanan Anda Telah Selesai Dikerjakan!</strong></a>
                            <div>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel mollitia ipsam officia enim aspernatur culpa in nulla aliquam minima? Eum accusamus repellendus eius quidem modi libero consequuntur doloribus, corrupti sint?</p>
                            </div>
                            <small class="text-info">27.11.2015, 15:00</small>
                          </div>    
                        </div>
                      <div class="dropdown-divider"></div>
                        <a href="#" class="text-dark ">View All</a>
                      </div>
                  </div>
                  <!-- BATAS BELL -->
                  <a class="nav-item nav-link icon-custom" style="color:#25A8E0;" type="button" data-toggle="modal" data-target="#cart"><i class="fa fa-shopping-cart fa-1x"></i></a>
                  <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="menu-profile" data-toggle="dropdown">
                    <img class="rounded-circle img-circle" src="http://placehold.it/25x25">
                      <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right text-right">
                      <a class="dropdown-item" href="#">Setting Profile</a>
                      <a class="dropdown-item" href="#">Bantuan</a>
                      <a class="dropdown-item" href="#">Keamanan</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                  </div><?php
              }else if($_SESSION['status']!='login'){
                  // header("location:../index.php?=belum login");
                  echo '<button type="button" class="btn rounded-0 nav-item nav-custom mr-auto" data-toggle="modal" data-target="#login_user" style="color: #25A8E0">
                  MASUK
                  </button>
                  <a class="nav-item nav-link nav-custom" style="color:#F69322;" href="register_user.php">DAFTAR</a>';
              }
          ?>
          
        </div>
      </div>
    </nav>
    <!-- KERANJANG -->
                
  </header>
  </div>
  