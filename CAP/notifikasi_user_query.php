<?php
session_start();
include 'includes/config.php';

if(!isset($_SESSION['status'])){
  header("location:index.php");
}

$id_user = $_SESSION['id_user'];

if(isset($_GET['id_pesanan'])){
  $id_psn = $_GET['id_pesanan'];

  if(isset($_GET['action'])){
    $action = $_GET['action'];
  }

  if($action == 'sudah'){
    $data = mysqli_query($con, "UPDATE pesanan SET USER_NOTIF = 1 WHERE ID_PESANAN = '$id_psn' AND USER_ID = '$id_user'");

    if($data > 0){
      header("location:notifikasi_user.php");
    }else{
      echo "GAGAL";
    }
  }else{
    $data = mysqli_query($con, "UPDATE pesanan SET USER_NOTIF = 0 WHERE ID_PESANAN = '$id_psn' AND USER_ID = '$id_user'");

    if($data > 0){
      header("location:notifikasi_user.php");
    }else{
      echo "GAGAL";
    }
  }
  
}else{
  $data = mysqli_query($con, "UPDATE pesanan SET USER_NOTIF = 1 WHERE USER_NOTIF = 0 AND USER_ID = '$id_user'");

    if($data > 0){
      header("location:notifikasi_user.php");
    }else{
      echo "GAGAL";
    }
}
