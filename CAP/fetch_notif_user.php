<?php
  session_start();
  include 'includes/config.php';

  if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
  }

  if(isset($_POST['viewuser'])){

  // $con = mysqli_connect("localhost", "root", "", "notif");

  $query = "SELECT DISTINCT 
  user.USER_NAMA_LENGKAP, 
  pesanan.ID_PESANAN, 
  pesanan.TANGGAL_PESANAN, 
  produk.NAMA_PRODUK, 
  pesanan.USER_NOTIF,
  CASE 
  WHEN pesanan.STATUS_PESANAN = 1 THEN 'Sedang Menunggu Bukti Transfer' 
  WHEN pesanan.STATUS_PESANAN = 2 THEN 'Sedang Menunggu Antrian'
  WHEN pesanan.STATUS_PESANAN = 3 THEN 'Sedang Dalam Proses' 
  WHEN pesanan.STATUS_PESANAN = 4 THEN 'Telah Selesai Dikerjakan'
  WHEN pesanan.STATUS_PESANAN = 5 THEN 'Sedang Dalam Pengiriman' 
  WHEN pesanan.STATUS_PESANAN = 6 THEN 'Dibatalkan'
  WHEN pesanan.STATUS_PESANAN = 7 THEN 'Bukti TF Anda Salah'
  WHEN pesanan.STATUS_PESANAN = 8 THEN 'Nominal Bayar Salah'
  END AS KET_STATUS
  
  FROM user, pesanan, detail_pesanan, produk 
  
  WHERE
    pesanan.USER_ID = user.USER_ID AND
    pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN AND
    detail_pesanan.ID_PRODUK = produk.ID_PRODUK AND
    pesanan.USER_ID = '$id_user'
    ORDER BY pesanan.TANGGAL_PESANAN DESC LIMIT 4";
  $result = mysqli_query($con, $query);

  $output = '';
  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $admin_notif = $row['USER_NOTIF'];
      if($admin_notif == 0){
        $bg = 'text-info';
      }else{
        $bg = 'text-secondary';
      }
      
      $output .= '
      <div class="row">
        <div class="col-lg-2 pl-5 text-center">
          <i class="fas fa-file-alt fa-3x '.$bg.'"></i>
        </div>    
        <div class="col-lg-10 col-sm-8 text-left justify-content-start">
          <a href="detail_pesanan_user.php?id_pesanan='.$row['ID_PESANAN'].'" class="'.$bg.'">Pesanan <strong>'.$row['NAMA_PRODUK'].'</strong> Anda '.$row['KET_STATUS'].'!</a>
          <div>
            <p class="text-grey"><small>'.$row['TANGGAL_PESANAN'].'</small></p>
          </div>
        </div>
      </div>
      <div class="dropdown-divider"></div>
      ';
    }
  }
  else{
      $output .= '
      <div class="col-lg-12 text-center '.$bg.'">
        <h4>Tidak ada Notifikasi untuk Anda.</h4>
      </div> ';
  }



  $status_query = "SELECT DISTINCT * FROM pesanan WHERE USER_NOTIF = 0 AND USER_ID = '$id_user'";
  $result_query = mysqli_query($con, $status_query);
  $count = mysqli_num_rows($result_query);
  if($result_query == null){
    $count = 0;
  }
  $data = array(
      'notification' => $output,
      'unseen_notification'  => $count
  );

  echo json_encode($data);

  }

  ?>