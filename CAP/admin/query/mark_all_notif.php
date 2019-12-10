<?php
include '../includes/config.php';

if(isset($_GET['id_pesanan'])){
  $id_psn = $_GET['id_pesanan'];

  if(isset($_GET['action'])){
    $action = $_GET['action'];
  }

  if($action == 'sudah'){
    $data = mysqli_query($con, "UPDATE pesanan SET ADMIN_NOTIF = 1 WHERE ID_PESANAN = '$id_psn'");

    if($data > 0){
      header("location:../trs_notifikasi_admin.php");
    }else{
      echo "GAGAL";
    }
  }else{
    $data = mysqli_query($con, "UPDATE pesanan SET ADMIN_NOTIF = 0 WHERE ID_PESANAN = '$id_psn'");

    if($data > 0){
      header("location:../trs_notifikasi_admin.php");
    }else{
      echo "GAGAL";
    }
  }
  
}else{
  $data = mysqli_query($con, "UPDATE pesanan SET ADMIN_NOTIF = 1 WHERE ADMIN_NOTIF = 0");

    if($data > 0){
      header("location:../trs_notifikasi_admin.php");
    }else{
      echo "GAGAL";
    }
}
