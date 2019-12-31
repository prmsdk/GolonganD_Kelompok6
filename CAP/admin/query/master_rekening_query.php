<?php
include '../includes/config.php';
if(isset($_GET['id_rekening'])){
  $id_rekening = $_GET['id_rekening'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM rekening_bank WHERE ID_REKENING='$id_rekening'");
      if($result){
        header("location:../master_rekening.php?pesan=sukses_delete");
      }else{
        header("location:../master_rekening.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_rekening'])){
  $id_rekening = $_POST['id_rekening'];
  $nama_rek = $_POST['nama_rek'];
  $no_rek = $_POST['no_rek'];
  $stat_rek = $_POST['stat_rek'];
  $atas_nama = $_POST['atas_nama'];

  $result = mysqli_query($con, "UPDATE rekening_bank SET 
    NAMA_REKENING = '$nama_rek',
    NOMOR_REKENING = '$no_rek',
    ATAS_NAMA = '$atas_nama',
    STATUS_REKENING = '$stat_rek'
    WHERE
    ID_REKENING = '$id_rekening'
  ");

if($result){
  header("location:../master_rekening.php?pesan=sukses_edit");
}else{
  header("location:../master_rekening.php?pesan=gagal_edit");
}

}

if(isset($_POST['tambah_rekening'])){
  $nama_rek = $_POST['nama_rek'];
  $no_rek = $_POST['no_rek'];
  $stat_rek = $_POST['status_rekening'];
  $atas_nama = $_POST['atas_nama'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_REKENING from rekening_bank ORDER BY ID_REKENING DESC LIMIT 1");
    while($rekening_data = mysqli_fetch_array($data))
    {
        $kat_id = $rekening_data['ID_REKENING'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_rekening = autonumber($kat_id, 3, 6);
    }else{
      $id_rekening = 'NRK000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    rekening_bank VALUES('$id_rekening', '$nama_rek', '$no_rek', '$atas_nama', '$stat_rek')
    ");

  if($result){
    header("location:../master_rekening.php?pesan=sukses_insert");
  }else{
    header("location:../master_rekening.php?pesan=gagal_insert");
  }
}

