<?php
session_start();
if(isset($_SESSION['admin_login'])){
  header("location:admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/css/main.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="src/css/animation-slider.css">
    <link rel="stylesheet" href="src/css/kategori.css">
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <link rel="stylesheet" href="src/css/fontawesome-all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        

    <link rel="icon" type="image/png" href="src/img/icons/cap.png">
    <title>Abadi Cahaya Perkasa</title>
</head>
<body>
  
    <header id="info">
        <p class="m-0 p-2 pr-3 float-left text-right" style="z-index:19; color:#fff">
            Buka Senin - Sabtu Jam 09.000 - 20.00 <span style="color: #a1a1a1">(Hari Minggu dan Hari Besar Libur)</span>
        </p>
        <p class="m-0 p-2 pr-3 text-light text-right">
            <img src="src/img/icons/telepon.png" height="20" alt="telepon">
            (0331) 412990
        </p>
    </header>

    <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=='gagal'){
                echo '<div id="alert-login" class="alert alert-danger alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
                        Login anda <strong>Gagal!</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }else if($_GET['pesan']=='logout'){
              echo '<div id="alert-login" class="alert alert-success alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
                      Anda <strong>Berhasil!</strong> melakukan logout!.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
            }else if($_GET['pesan']=='loginberhasil'){
                $_SESSION['status']='login';
                echo '<div id="alert-logina" class="alert alert-success alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
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
      <a class="navbar-brand logo" href="#slidercontainer" style="color:#F69322;">ABADI CAHAYA PERKASA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <div class="dropdown">
          <!-- FOTO PROFIL -->
            <button class="btn btn-default dropdown-toggle" type="button" id="menu-profile" data-toggle="dropdown"><span class="nav-custom">
            PRODUK</span>
            </button>
            <!-- BATAS FOTO -->
            <div class="dropdown-menu text-left">
              <?php
              $result_kat = mysqli_query($con, "SELECT * FROM kategori_produk");
              while($data_kat = mysqli_fetch_assoc($result_kat)){
              $id_kat = $data_kat['ID_KATEGORI'];
              $nama_kat = $data_kat['NAMA_KAT_PRODUK']; ?>
              <a class="dropdown-item" href="index.php#<?=$id_kat?>">KATEGORI <?=$nama_kat?></a>
              <?php }?>
              <a href="index.php#produkbtn" class="dropdown-item">SEMUA PRODUK</a>
            </div>
          </div>
          <a class="nav-item nav-link nav-custom" href="index.php#carakerjabtn">CARA KERJA</a>
          <a class="nav-item nav-link nav-custom" href="index.php#portfoliobtn">PORTOFOLIO</a>
          <a class="nav-item nav-link nav-custom" href="index.php#testimonibtn">TESTIMONI</a>
          <a class="nav-item nav-link nav-custom" href="index.php#contact">HUBUNGI KAMI</a>
          <?php
              error_reporting(0);
              if(isset($_SESSION['id_user'])){
                $id_user = $_SESSION['id_user'];
              

              $result_user = mysqli_query($con, "SELECT * FROM user WHERE USER_ID = '$id_user'");
              $data_user = mysqli_fetch_assoc($result_user);
              }
              if($_SESSION['status']=='login'){
                ?><div class="dropdown notif-custom">
                    <a class="nav-item nav-link icon-custom notif-dropdown" style="color:#F69322;" type="button" data-toggle="dropdown">
                      <i class="fa fa-bell fa-1x">
                      </i>
                      <span class="badge badge-danger badge-counter notif-count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 text-center" style="width: 50vw">
                      <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-left">
                          <span><strong>Notifications (<span class="notif-count">0</span>)</strong></span>
                          <a href="notifikasi_user_query.php" class="float-right text-dark text-light">Mark all as read</a>
                        </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="wadah-notif-dropdown">
                        <div class="row">
                          <div class="col-lg-12 text-center">
                            <h4>Tidak ada Notifikasi untuk Anda.</h4>
                          </div>  
                        </div>
                      </div>
                      <div class="dropdown-divider"></div>
                        <a href="notifikasi_user.php" class="text-dark ">View All</a>
                      </div>
                  </div>
                  <!-- BATAS BELL -->
                  <!-- KERANJANG -->
                  <a class="nav-item nav-link icon-custom" id="cart-modal" style="color:#25A8E0;" type="button" data-toggle="modal" data-target="#cart"><i class="fa fa-shopping-cart fa-1x"></i><span id="jumlah_keranjang" class="badge badge-danger badge-counter total-count ml-1"></span></a>
                  <!-- BATAS KERANJANG -->
                  <div class="dropdown">
                  <!-- FOTO PROFIL -->
                    <button class="btn btn-default dropdown-toggle" type="button" id="menu-profile" data-toggle="dropdown">
                    <img class="rounded-circle img-circle" width="25" src="pictures/user_profile/<?=$data_user['USER_PROFIL']?>">
                      <span class="caret"></span>
                    </button>
                    <!-- BATAS FOTO -->
                    <div class="dropdown-menu dropdown-menu-right text-right">
                      <label class="dropdown-item bg-primary text-white pb-2"><?=$data_user['USER_USERNAME']?></label>
                      <a class="dropdown-item" href="user_profil.php">Setting Profile</a>
                      <a class="dropdown-item" href="notifikasi_user.php">Notifikasi</a>
                      <a class="dropdown-item" href="nego_user.php">Nego</a>
                      <a class="dropdown-item" href="history_user.php">History</a>
                      <a class="dropdown-item" href="404.php">Bantuan</a>
                      <a class="dropdown-item" href="keamanan_password.php">Keamanan</a>
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
  