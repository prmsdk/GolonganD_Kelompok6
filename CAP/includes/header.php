<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/css/main.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="src/css/animation-slider.css">
    <link rel="stylesheet" href="src/css/kategori.css">
    <link rel="stylesheet" href="src/css/bootstrap.css">
        <link rel="stylesheet" href="src/css/font-awesome.min.css">
        <link rel="stylesheet" href="src/css/jquery.fancybox.css">
        <link rel="stylesheet" href="src/css/owl.carousel.css">
        <link rel="stylesheet" href="src/css/animate.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        
        <link rel="stylesheet" type="text/css" href="src/DataTables/datatables.css">
        
        <link rel="icon" type="image/png" href="src/img/icons/cap.png">
    <title>Cahaya Abadi Perkasa</title>
</head>
<body>
  
    <header id="info">
        <p class="m-0 p-2 pr-3 text-light text-right">
            <img src="src/img/icons/telepon.png" height="20" alt="telepon">
            (0331) 412990
        </p>
    </header>

  <div class="container-fluid-lg">
  <header id="navbar">
    <nav id="logo" class="m-0 navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand logo" href="index.php" style="color:#F69322;">CAHAYA ABADI PERKASA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link nav-custom" href="index.php#produkbtn">PRODUK <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link nav-custom" href="index.php#carakerjabtn">CARA KERJA</a>
          <a class="nav-item nav-link nav-custom" href="index.php#portfoliobtn">PORTOFOLIO</a>
          <a class="nav-item nav-link nav-custom" href="index.php#testimonibtn">TESTIMONI</a>
          <a class="nav-item nav-link nav-custom" href="index.php#contact">CONTACT US</a>
          <?php
              session_start();
              error_reporting(0);
              if(isset($_SESSION['id_user'])){
                $id_user = $_SESSION['id_user'];
              }

              $result_user = mysqli_query($con, "SELECT * FROM user WHERE USER_ID = '$id_user'");
              $data_user = mysqli_fetch_assoc($result_user);

              if($_SESSION['status']=='login'){
                ?><div class="dropdown notif-custom ">
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
                  <a class="nav-item nav-link icon-custom" style="color:#25A8E0;" type="button" data-toggle="modal" data-target="#cart"><i class="fa fa-shopping-cart fa-1x"></i></a>
                  <!-- BATAS KERANJANG -->
                  <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="menu-profile" data-toggle="dropdown">
                    <img class="rounded-circle img-circle" width="25" src="file_upload/<?=$data_user['USER_PROFIL']?>">
                      <span class="caret"></span>
                    </button>
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
                  echo '<button type="button" class="btn rounded-0 nav-item nav-custom mr-auto login" data-toggle="modal" data-target="#login_user" style="color: #25A8E0">
                  MASUK
                  </button>
                  <a class="nav-item nav-link nav-custom" style="color:#F69322;" href="register_user.php">DAFTAR</a>';
              }
          ?>
        </div>
      </div>
    </nav>
  </header>
  </div>
  