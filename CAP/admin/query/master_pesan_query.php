<?php
include '../includes/config.php';
if(isset($_GET['id_msg'])){
  $id_msg = $_GET['id_msg'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM messages WHERE ID_MSG='$id_msg'");
      if($result){
        header("location:../master_pesan.php?pesan=sukses_delete");
      }else{
        header("location:../master_pesan.php?pesan=gagal_delete");
      }
    }
  }

  if(isset($_GET['action'])){
    if($_GET['action']=='sudah'){
      $result = mysqli_query($con, "UPDATE messages SET MSG_STATUS = 1 WHERE ID_MSG='$id_msg'");
      header("location:../master_pesan.php");
    }
  }

  if(isset($_GET['action'])){
    if($_GET['action']=='belum'){
      $result = mysqli_query($con, "UPDATE messages SET MSG_STATUS = 0 WHERE ID_MSG='$id_msg'");
      header("location:../master_pesan.php");
    }
  }
}