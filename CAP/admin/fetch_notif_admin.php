<?php
  include 'includes/config.php';


  if(isset($_POST['view'])){

  // $con = mysqli_connect("localhost", "root", "", "notif");

  $query = "SELECT DISTINCT user.USER_NAMA_LENGKAP, pesanan.ID_PESANAN, pesanan.TANGGAL_PESANAN, produk.NAMA_PRODUK, pesanan.ADMIN_NOTIF FROM user, admin, pesanan, detail_pesanan, produk WHERE
  pesanan.ADM_ID = admin.ADM_ID AND
  pesanan.USER_ID = user.USER_ID AND
  pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN AND
  detail_pesanan.ID_PRODUK = produk.ID_PRODUK
  ORDER BY pesanan.TANGGAL_PESANAN DESC LIMIT 4";
  $result = mysqli_query($con, $query);

  $output = '';
  if(mysqli_num_rows($result) > 0)
  {
  while($row = mysqli_fetch_assoc($result))
  {
    $admin_notif = $row['ADMIN_NOTIF'];
    if($admin_notif == 0){
      $bg = 'bg-light';
    }else{
      $bg = 'bg-white';
    }
    $output .= '
    <a class="dropdown-item d-flex align-items-center '.$bg.'" href="trs_detail_pesanan_admin.php?id_pesanan='.$row['ID_PESANAN'].'">
      <div class="mr-3">
        <div class="icon-circle bg-primary">
          <i class="fas fa-file-alt text-white"></i>
        </div>
      </div>
      <div>
        <div class="small text-gray-500">'.$row['TANGGAL_PESANAN'].'</div>
        <span class="font-weight-medium">Pesanan <strong>'.$row['NAMA_PRODUK'].'</strong> baru dari '.$row['USER_NAMA_LENGKAP'].' mohon segera diperiksa!</span>
      </div>
    </a>
    ';

  }
  }
  else{
      $output .= '
      <a class="dropdown-item d-flex align-items-center" href="#">
      <div class="mr-3">
        <div class="icon-circle bg-primary">
          <i class="fas fa-danger text-white"></i>
        </div>
      </div>
      <div>
        <div class="small text-gray-500">ANDA TIDAK MEMILIKI NOTIFIKASI BARU</div>
      </div>
    </a>';
  }



  $status_query = "SELECT DISTINCT * FROM pesanan WHERE ADMIN_NOTIF=0";
  $result_query = mysqli_query($con, $status_query);
  $count = mysqli_num_rows($result_query);
  $data = array(
      'notification' => $output,
      'unseen_notification'  => $count
  );

  echo json_encode($data);

  }

  ?>