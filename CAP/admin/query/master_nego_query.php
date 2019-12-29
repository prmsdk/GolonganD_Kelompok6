<?php
include '../includes/config.php';
if(isset($_GET['id_nego'])){
  $id_nego = $_GET['id_nego'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM nego WHERE ID_NEGO='$id_nego'");
      if($result){
        header("location:../master_nego.php?pesan=sukses_delete");
      }else{
        header("location:../master_nego.php?pesan=gagal_delete");
      }
    }
  }

}

if(isset($_POST['nego_tombol'])){
  $id_nego = $_POST['id_nego'];
  $harga_nego = $_POST['nego_harga'];

  $update_query = mysqli_query($con, "UPDATE nego SET NEGO_HARGA = '$harga_nego', NEGO_STATUS = 2 WHERE ID_NEGO = '$id_nego'");
  if($update_query){
    header("location:../master_nego.php?pesan=sukses_edit");
  }else{
    header("location:../master_nego.php?pesan=gagal_edit");
  }
}