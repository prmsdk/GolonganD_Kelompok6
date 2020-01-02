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

  $result_today = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_NOW FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$tanggal_now%'");
  $data_today = mysqli_fetch_assoc($result_today);
  // ====================== 1hari
  $result_1hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_1HARI FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$tgl_1hari%'");
  $data_1hari = mysqli_fetch_assoc($result_1hari);
  // ====================== 2hari
  $result_2hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_2HARI FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$tgl_2hari%'");
  $data_2hari = mysqli_fetch_assoc($result_2hari);
  // ====================== 3hari
  $result_3hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_3HARI FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$tgl_3hari%'");
  $data_3hari = mysqli_fetch_assoc($result_3hari);
  // ====================== 4hari
  $result_4hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_4HARI FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$tgl_4hari%'");
  $data_4hari = mysqli_fetch_assoc($result_4hari);
  // ====================== 5hari
  $result_5hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_5HARI FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$tgl_5hari%'");
  $data_5hari = mysqli_fetch_assoc($result_5hari);
  // ====================== 6hari
  $result_6hari = mysqli_query($con, "SELECT COUNT(*) AS TANGGAL_6HARI FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$tgl_6hari%'");
  $data_6hari = mysqli_fetch_assoc($result_6hari);
  // AKHIR QUERY CHART BATANG
  
  // BULAN INI ADALAH
  $bulan_now = date("Y-m");
  // JUMLAH PESANAN BULAN INI
  $rjml_pesanan_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PESANAN FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$bulan_now%'");
  $djml_pesanan_bulan = mysqli_fetch_assoc($rjml_pesanan_bulan);

  // JUMLAH PRODUK YANG DIPESAN BULAN INI
  $rjml_produk_bulan = mysqli_query($con, "SELECT COUNT(*) as TOT_PRODUK FROM detail_pesanan, pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND pesanan.TANGGAL_PESANAN LIKE '$bulan_now%' AND pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN");
  $djml_produk_bulan = mysqli_fetch_assoc($rjml_produk_bulan);

  // JUMLAH OMSET BULAN INI
  $romset_bulan = mysqli_query($con, "SELECT SUM(TOTAL_HARGA) as TOT_OMSET FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '$bulan_now%'");
  $domset_bulan = mysqli_fetch_assoc($romset_bulan);

  if(isset($_SESSION['admin_login'])){
  ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">
          <?php
          if(isset($_SESSION['admin_status'])){
          if($_SESSION['admin_status']==1){?>
            <!-- TOTAL PESANAN BULAN INI -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Transaksi Bulan Ini</div>
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
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Produk dipesan Bulan Ini</div>
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
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Omset Bulan Ini</div>
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
          <?php } }?>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Statistik Pemesanan Minggu ini</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area text-center">
                    <h4 class="m-0">Bulan <?=month(date("n"))?></h4>
                    <canvas id="chart-mingguan" width="100" height="43"></canvas>
                  </div>
                  <script>
                    var ctx = document.getElementById("chart-mingguan");
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["<?=date('Y-m-d', $tanggal_6hari)?>", 
                            "<?=date('Y-m-d', $tanggal_5hari)?>", 
                            "<?=date('Y-m-d', $tanggal_4hari)?>", 
                            "<?=date('Y-m-d', $tanggal_3hari)?>", 
                            "<?=date('Y-m-d', $tanggal_2hari)?>", 
                            "<?=date('Y-m-d', $tanggal_1hari)?>", 
                            "<?=$tanggal_now?>"],
                            datasets: [{
                                    label: 'Jumlah Pesanan per Hari',
                                    data: 
                                    [<?=$data_6hari['TANGGAL_6HARI']?>, 
                                    <?=$data_5hari['TANGGAL_5HARI']?>, 
                                    <?=$data_4hari['TANGGAL_4HARI']?>, 
                                    <?=$data_3hari['TANGGAL_3HARI']?>, 
                                    <?=$data_2hari['TANGGAL_2HARI']?>, 
                                    <?=$data_1hari['TANGGAL_1HARI']?>,
                                    <?=$data_today['TANGGAL_NOW']?>],
                                    backgroundColor: [
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                            }
                        }
                    });
                </script>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">5 Produk Terlaris Bulan <?=month(date("n"))?></h6>
                </div>
                <div class="card-body text-center">
                  <div class="chart-area">
                    <canvas id="inicanvas" width="100" height="100"></canvas>
                  </div>
                </div>
                <!-- Card Body -->
                <?php
                $result_produk_populer = mysqli_query($con, "SELECT DISTINCT detail_pesanan.ID_PRODUK, SUM(JUMLAH_PRODUK) as TOT_PEMBELIAN_PRODUK, NAMA_PRODUK
                FROM detail_pesanan, pesanan, produk
                WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND 
                pesanan.TANGGAL_PESANAN LIKE '$bulan_now%' AND
                pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN AND
                produk.ID_PRODUK = detail_pesanan.ID_PRODUK
                GROUP BY NAMA_PRODUK 
                ORDER BY `TOT_PEMBELIAN_PRODUK`  DESC LIMIT 5");

                $result_jumlah_populer = mysqli_query($con, "SELECT DISTINCT detail_pesanan.ID_PRODUK, SUM(JUMLAH_PRODUK) as TOT_PEMBELIAN_PRODUK, NAMA_PRODUK
                FROM detail_pesanan, pesanan, produk
                WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND 
                pesanan.TANGGAL_PESANAN LIKE '$bulan_now%' AND
                pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN AND
                produk.ID_PRODUK = detail_pesanan.ID_PRODUK
                GROUP BY NAMA_PRODUK 
                ORDER BY `TOT_PEMBELIAN_PRODUK`  DESC LIMIT 5");
                ?>


                <script>
                var ctx = document.getElementById("inicanvas").getContext("2d");
                // tampilan chart
                var piechart = new Chart(ctx,{type: 'pie',
                  data : {
                // label nama setiap Value
                labels:[
                  <?php
                  while($data_produk_populer = mysqli_fetch_assoc($result_produk_populer)){
                    $nama_produk = $data_produk_populer['NAMA_PRODUK'];
                      echo "'$nama_produk',";
                  }
                  ?>
                  ],
                datasets: [{
                  // Jumlah Value yang ditampilkan
                    data:
                    [
                      <?php
                      while($data_produk_populer = mysqli_fetch_assoc($result_jumlah_populer)){
                        $jumlah_produk = $data_produk_populer['TOT_PEMBELIAN_PRODUK'];
                          echo "'$jumlah_produk' ,";
                      }
                      ?>
                    ],

                  backgroundColor:[
                          'rgba(255, 159, 64, 0.5)',
                          'rgba(54, 162, 235, 0.5)',
                          'rgba(255, 99, 132, 0.5)',
                          'rgba(255, 206, 86, 0.5)',
                          'rgba(75, 192, 192, 0.5)'
                          ]
                }],
                }
                });

                </script>
              </div>
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
