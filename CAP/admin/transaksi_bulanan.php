<?php
  session_start();
  $_SESSION['active_link'] = 'dashboard';
  include 'includes/config.php';
  require 'includes/header.php';

  // QUERY UNTUK CHART BATANG
  $tanggal_now = date("Y-m-d");
  $tanggal_1hari = mktime(0,0,0,date("n"),date("j")-1,date("Y"));
  $tanggal_2hari = mktime(0,0,0,date("n"),date("j")-2,date("Y"));
  $tanggal_3hari = mktime(0,0,0,date("n"),date("j")-3,date("Y"));
  $tanggal_4hari = mktime(0,0,0,date("n"),date("j")-4,date("Y"));
  $tanggal_5hari = mktime(0,0,0,date("n"),date("j")-5,date("Y"));
  $tanggal_6hari = mktime(0,0,0,date("n"),date("j")-6,date("Y"));

  $tgl_1hari = date('Y-m-d', $tanggal_1hari);
  $tgl_2hari = date('Y-m-d', $tanggal_2hari);
  $tgl_3hari = date('Y-m-d', $tanggal_3hari);
  $tgl_4hari = date('Y-m-d', $tanggal_4hari);
  $tgl_5hari = date('Y-m-d', $tanggal_5hari);
  $tgl_6hari = date('Y-m-d', $tanggal_6hari);

  $result_today = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_NOW FROM pesanan WHERE TANGGAL_PESANAN LIKE '$tanggal_now%'");
  $data_today = mysqli_fetch_assoc($result_today);
  // ====================== 1hari
  $result_1hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_1HARI FROM pesanan WHERE TANGGAL_PESANAN LIKE '$tgl_1hari%'");
  $data_1hari = mysqli_fetch_assoc($result_1hari);
  // ====================== 2hari
  $result_2hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_2HARI FROM pesanan WHERE TANGGAL_PESANAN LIKE '$tgl_2hari%'");
  $data_2hari = mysqli_fetch_assoc($result_2hari);
  // ====================== 3hari
  $result_3hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_3HARI FROM pesanan WHERE TANGGAL_PESANAN LIKE '$tgl_3hari%'");
  $data_3hari = mysqli_fetch_assoc($result_3hari);
  // ====================== 4hari
  $result_4hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_4HARI FROM pesanan WHERE TANGGAL_PESANAN LIKE '$tgl_4hari%'");
  $data_4hari = mysqli_fetch_assoc($result_4hari);
  // ====================== 5hari
  $result_5hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_5HARI FROM pesanan WHERE TANGGAL_PESANAN LIKE '$tgl_5hari%'");
  $data_5hari = mysqli_fetch_assoc($result_5hari);
  // ====================== 6hari
  $result_6hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_6HARI FROM pesanan WHERE TANGGAL_PESANAN LIKE '$tgl_6hari%'");
  $data_6hari = mysqli_fetch_assoc($result_6hari);
  // AKHIR QUERY CHART BATANG
  
  // BULAN INI ADALAH
  $bulan_now = date("Y-m");
  // JUMLAH PESANAN BULAN INI
  $rjml_pesanan_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PESANAN FROM pesanan WHERE TANGGAL_PESANAN LIKE '$bulan_now%'");
  $djml_pesanan_bulan = mysqli_fetch_assoc($rjml_pesanan_bulan);

  // JUMLAH PRODUK YANG DIPESAN BULAN INI
  $rjml_produk_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PRODUK FROM detail_pesanan, pesanan WHERE pesanan.TANGGAL_PESANAN LIKE '$bulan_now%' AND pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN");
  $djml_produk_bulan = mysqli_fetch_assoc($rjml_produk_bulan);

  // JUMLAH OMSET BULAN INI
  $romset_bulan = mysqli_query($con, "SELECT SUM(TOTAL_HARGA) as TOT_OMSET FROM pesanan WHERE TANGGAL_PESANAN LIKE '$bulan_now%'");
  $domset_bulan = mysqli_fetch_assoc($romset_bulan);

  if(isset($_SESSION['admin_login'])){
  ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between text-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pesanan per Bulan</h1>
            <form action="" method="post">
              <input type="date">
              <input type="submit" value="Cari">
            </form>
          </div>

          <div class="row">

            <!-- TOTAL PESANAN BULAN INI -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Transaksi Tahun Ini</div>
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
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Produk dipesan Tahun Ini</div>
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
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Omset Tahun Ini</div>
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
                  <h6 class="m-0 font-weight-bold text-primary">Statistik Pemesanan per Bulan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="text-center">
                    <h4 class="m-0">Tahun <?=month(date("n"))?></h4>
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
                          title: "Pesanan"
                        },

                        data: [
                        {
                          indexLabelFontColor: "green",
                          type: "area",
                          dataPoints: [//array
                          { x: new Date(2012, 00, 1), y: 2600},
                          { x: new Date(2012, 01, 1), y: 3800 },
                          { x: new Date(2012, 02, 1), y: 4300 },
                          { x: new Date(2012, 03, 1), y: 2900 },
                          { x: new Date(2012, 04, 1), y: 4100 },
                          { x: new Date(2012, 05, 1), y: 4500 },
                          { x: new Date(2012, 06, 1), y: 8600 },
                          { x: new Date(2012, 07, 1), y: 6400 },
                          { x: new Date(2012, 08, 1), y: 5300 },
                          { x: new Date(2012, 09, 1), y: 6000 },
                          { x: new Date(2012, 10, 1), y: 5400 },
                          { x: new Date(2012, 11, 1), y: 1200 }
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
