<?php
session_start();
include '../includes/config.php';
if(isset($_GET['status']) AND isset($_GET['id_pesanan'])){
  $status = $_GET['status'];
  $id_pesanan = $_GET['id_pesanan'];

  if($status == 2){
    $update = mysqli_query($con, "UPDATE pesanan SET STATUS_PESANAN = 3 WHERE ID_PESANAN = '$id_pesanan'");

    if($update){
      header("location:../trs_detail_pesanan_admin.php?id_pesanan=$id_pesanan");
    }
  }else if($status == 3){
    $update = mysqli_query($con, "UPDATE pesanan SET STATUS_PESANAN = 4 WHERE ID_PESANAN = '$id_pesanan'");

    if($update){
      header("location:../trs_detail_pesanan_admin.php?id_pesanan=$id_pesanan");
    }
  }else if($status == 4){
    $update = mysqli_query($con, "UPDATE pesanan SET STATUS_PESANAN = 5 WHERE ID_PESANAN = '$id_pesanan'");

    if($update){
      header("location:../trs_detail_pesanan_admin.php?id_pesanan=$id_pesanan");
    }
  }else if($status == 1){
    $update = mysqli_query($con, "UPDATE pesanan SET STATUS_PESANAN = 6 WHERE ID_PESANAN = '$id_pesanan'");

    if($update){
      header("location:../trs_detail_pesanan_admin.php?id_pesanan=$id_pesanan");
    }
  }
}

if(isset($_POST['masukkan_antrian'])){
  $antrian = $_POST['antrian'];
  $id_admin = $_SESSION['id_admin'];
  $id_pesanan = $_POST['id_pesanan'];

  $result_antrian = mysqli_query($con, "UPDATE pesanan SET
                    ADM_ID = '$id_admin', ANTRIAN = '$antrian', STATUS_PESANAN = 2 WHERE ID_PESANAN = '$id_pesanan'");

  if($result_antrian){
    header("location:../trs_history_admin.php");
  }
}