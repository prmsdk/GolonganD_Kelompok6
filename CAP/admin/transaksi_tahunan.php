<?php
  session_start();
  $_SESSION['active_link'] = 'laporan';
  include 'includes/config.php';
  require 'includes/header.php';

  if(isset($_SESSION['admin_login'])){
  ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between text-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pesanan per Tahun</h1>
            <form action="" method="post">
              <input type="text" name="year" id="yearpicker" required>
              <input type="submit" name="cari" value="Cari">
            </form>
          </div>

          <div class="row">

          <?php

          if(isset($_POST['cari'])){

          $year = substr($_POST['year'],1,4);
          
          
          // QUERY UNTUK CHART BATANG
          $bulan = array();
          $result_bulan = array();
          $data_bulan = array();
          for($i=1; $i<=12; $i++){
            $digit2 = sprintf("%02d", $i);
            $bulan[$i] = $year.'-'.$digit2;
            $month = $bulan[$i];

            $result_bulan[$i] = mysqli_query($con, "SELECT SUM(TOTAL_HARGA) as TOT_OMSET FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '%$month%'");
            $data_bulan[$i] = mysqli_fetch_assoc($result_bulan[$i]);
          }
          
          // BULAN INI ADALAH
          // JUMLAH PESANAN BULAN INI
          $rjml_pesanan_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PESANAN FROM pesanan WHERE TANGGAL_PESANAN LIKE '%$year%'");
          $djml_pesanan_bulan = mysqli_fetch_assoc($rjml_pesanan_bulan);

          // JUMLAH PRODUK YANG DIPESAN BULAN INI
          $rjml_produk_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PRODUK FROM detail_pesanan, pesanan WHERE pesanan.TANGGAL_PESANAN LIKE '$year%' AND pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN");
          $djml_produk_bulan = mysqli_fetch_assoc($rjml_produk_bulan);

          // JUMLAH OMSET BULAN INI
          $romset_bulan = mysqli_query($con, "SELECT SUM(TOTAL_HARGA) as TOT_OMSET FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '%$year%'");
          $domset_bulan = mysqli_fetch_assoc($romset_bulan);

          ?>

            <!-- TOTAL PESANAN BULAN INI -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Transaksi Tahun <?=$year?></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="Count"><?=number_format($djml_pesanan_bulan['TOT_PESANAN'], 0,".",".")?></span> Pesanan</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- AKHIR TOTAL PESANAN BULAN INI -->

            <!-- TOTAL PRODUK YANG DIPESAN BULAN INI -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Produk dipesan Tahun <?=$year?></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="Count"><?=number_format($djml_produk_bulan['TOT_PRODUK'], 0,".",".")?></span> Produk</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- AKHIR TOTAL PRODUK YANG DIPESAN BULAN INI -->

            <!-- TOTAL OMSET BULAN INI -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Omset Tahun <?=$year?></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <span class="Count"><?=$domset_bulan['TOT_OMSET']?></span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-money-bill-wave fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- AKHIR TOTAL OMSET BULAN INI -->
            
          </div>

          

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Statistik Omset per Bulan</h6>
                  <a class="mr-2 btn btn-outline-success ml-auto" href="laporan/report_tahunan.php?year=<?=$year?>"><i class="fas fa-print fa-1x"></i></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="text-center">
                    <h4 class="m-0">Tahun <?=$year?></h4>
                    <div id="chartContainer" style="height: 430px; width: 100%;"></div>
                    <!-- <canvas id="chart-mingguan" width="100" height="43"></canvas> -->
                  </div>
                  <script type="text/javascript">
                    window.onload = function () {
                      var chart = new CanvasJS.Chart("chartContainer",
                      {
                        // title: {
                        //   text: "Pemesanan Bulanan",
                        //   fontSize: 25
                        // },
                        axisX:{
                          valueFormatString: "MMM" ,
                          interval: 1,
                          intervalType: "month"

                        },
                        axisY: {
                          title: "Omset Pesanan"
                        },

                        data: [
                        {
                          indexLabelFontColor: "green",
                          type: "area",
                          dataPoints: [//array
                          <?php 
                          $tot_omset_bulan = array();
                          for($i=1; $i<=12; $i++){
                            if($data_bulan[$i]['TOT_OMSET'] == null){
                              $tot_omset_bulan[$i] = '0';
                            }else{
                              $tot_omset_bulan[$i] = $data_bulan[$i]['TOT_OMSET'];
                            }
                          echo '{ x: new Date('.$year.', '.($i-1).', 1), y: '.$tot_omset_bulan[$i].' },';
                          }
                          ?>
                          ]
                        }
                        ]
                      });

                      chart.render();
                    }
                    </script>
                </div>
              </div>
            </div>

            


            
          </div>

          <?php }?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      

<?php
  }else{
    echo '<div class="container text-center" style="height:80vh;">
          <h1 class="my-auto">Harap Login terlebih dahulu!</h1>
          </div>';
  }
  require 'login_admin.php';
  require 'includes/footer.php';
?>
