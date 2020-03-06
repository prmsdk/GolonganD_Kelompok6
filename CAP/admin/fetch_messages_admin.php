<?php
  include 'includes/config.php';


  if(isset($_POST['view'])){

  // $con = mysqli_connect("localhost", "root", "", "notif");

  $query = "SELECT * FROM messages
  ORDER BY messages.MSG_TGL DESC LIMIT 4";
  $result = mysqli_query($con, $query);

  $output = '';
  if(mysqli_num_rows($result) > 0)
  {
  while($row = mysqli_fetch_assoc($result))
  {
    $admin_notif = $row['MSG_STATUS'];
    if($admin_notif == 0){
      $bg = 'bg-light';
    }else{
      $bg = 'bg-white';
    }
    $output .= '
    <a class="dropdown-item '.$bg.' d-flex align-items-center" href="master_pesan_detail.php?ID_MSG='.$row['ID_MSG'].'">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="img/profil/no_profil.jpg" alt="">
        <div class="status-indicator bg-success"></div>
      </div>
      <div class="font-weight-bold">
        '.$row['MSG_SUBJECT'].'<br>
        <span class="font-weight-normal">'.$row['MSG_NAMA'].'</span>
        <p class="m-0" style="font-weight:200;">'.$row['MSG_EMAIL'].'</p>
        <div class="small text-gray-500">'.$row['MSG_TGL'].'</div>
      </div>
    </a>
    ';

  }
  }
  else{
      $output .= '
      <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="img/profil/no_profil.jpg" alt="">
          <div class="status-indicator bg-success"></div>
        </div>
        <div class="font-weight-bold">
          <div class="text-truncate">Tidak ada pesan.</div>
          <div class="small text-gray-500"></div>
        </div>
      </a>';
  }



  $status_query = "SELECT * FROM messages WHERE MSG_STATUS = 0";
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