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
            <h1 class="h3 mb-0 text-gray-800">Pesanan per Bulan</h1>
            <form id="formrentang" action="" method="post">
              <input type="text" name="day1" id="daypicker1" required>
              <input type="text" name="day2" id="daypicker2" required>
              <input type="submit" name="cari" value="Cari">
            </form>
          </div>

          <div class="row">

          <?php

          if(isset($_POST['cari'])){

          ini_set('date.timezone', 'Asia/Jakarta');

          $day1 = substr($_POST['day1'],1,10);
          $day2 = substr($_POST['day2'],1,10);
          $dayakhir = strtotime("+1 day", strtotime($day2));
          $dayakhir = date("Y-m-d", $dayakhir);

          $diff = abs(strtotime($day1) - strtotime($day2));
          $row_hari = floor($diff / (60*60*24) + 1); // 7
          // $dayhari = $day2 - $day1;


          // QUERY UNTUK CHART BATANG
          $hari = array();
          $result_hari = array();
          $data_hari = array();
          $tahun = array();
          $bulan = array();
          $dayhari = $day1;

          for($i=1; $i<=$row_hari; $i++){
            $tahun[$i] = substr($dayhari,0,4);
            $bulan[$i] = substr($dayhari,5,2);
            $hari[$i] = substr($dayhari,8,2);

            $result_hari[$i] = mysqli_query($con, "SELECT SUM(TOTAL_HARGA) as TOT_OMSET FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '%$dayhari%'");
            $data_hari[$i] = mysqli_fetch_assoc($result_hari[$i]);
            // var_dump($data_hari[$i]['TOT_OMSET']); echo "<br>";
            
            $dayhari = strtotime("+1 day", strtotime($dayhari));
            $dayhari = date("Y-m-d", $dayhari);

          }
          
          // BULAN INI ADALAH
          // JUMLAH PESANAN BULAN INI
          $rjml_pesanan_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PESANAN FROM pesanan WHERE TANGGAL_PESANAN BETWEEN '$day1%' AND '$dayakhir%'");
          $djml_pesanan_bulan = mysqli_fetch_assoc($rjml_pesanan_bulan);

          // JUMLAH PRODUK YANG DIPESAN BULAN INI
          $rjml_produk_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PRODUK FROM detail_pesanan, pesanan WHERE pesanan.TANGGAL_PESANAN BETWEEN '$day1%' AND '$dayakhir%' AND pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN");
          $djml_produk_bulan = mysqli_fetch_assoc($rjml_produk_bulan);

          // JUMLAH OMSET BULAN INI
          $romset_bulan = mysqli_query($con, "SELECT SUM(TOTAL_HARGA) as TOT_OMSET FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN BETWEEN '$day1%' AND '$dayakhir%'");
          $domset_bulan = mysqli_fetch_assoc($romset_bulan);

          ?>

            <!-- TOTAL PESANAN BULAN INI -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Transaksi Dari <?=date("d-m-Y", strtotime($day1))?> <br>Hingga <?=date("d-m-Y", strtotime($day2))?></div>
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
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Produk dipesan Dari <?=date("d-m-Y", strtotime($day1))?> <br>Hingga <?=date("d-m-Y", strtotime($day2))?></div>
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
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Omset Dari <?=date("d-m-Y", strtotime($day1))?> <br>Hingga <?=date("d-m-Y", strtotime($day2))?></div>
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
                  <h6 class="m-0 font-weight-bold text-primary">Statistik Omset Dari <?=date("d-m-Y", strtotime($day1))?> Hingga <?=date("d-m-Y", strtotime($day2))?></h6>
                  <a class="mr-2 btn btn-outline-success ml-auto" href="laporan/report_rentang.php?awal=<?=$day1?>&akhir=<?=$day2?>"><i class="fas fa-print fa-1x"></i></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="text-center">
                    <h4 class="m-0">Dari <?=date("d-m-Y", strtotime($day1))?> Hingga <?=date("d-m-Y", strtotime($day2))?></h4>
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
                          valueFormatString: "DD" ,
                          interval: 1,
                          intervalType: "day"

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
                          $tot_omset_hari = array();
                          for($i=1; $i<=$row_hari; $i++){
                            if($data_hari[$i]['TOT_OMSET'] == null){
                              $tot_omset_hari[$i] = '0';
                            }else{
                              $tot_omset_hari[$i] = $data_hari[$i]['TOT_OMSET'];
                            }
                          echo '{ x: new Date('.$tahun[$i].', '.$bulan[$i].', '.$hari[$i].'), y: '.$tot_omset_hari[$i].' },';
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

            
          <div>
          <a id="btn-print" onclick="print()">Print</a>
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
