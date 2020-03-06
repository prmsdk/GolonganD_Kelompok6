<?php
include '../includes/config.php';
if(isset($_GET['id_satuan_bahan'])){
  $id_satuan_bahan = $_GET['id_satuan_bahan'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM satuan_bahan WHERE ID_SATUAN = '$id_satuan_bahan'");
      if($result){
        header("location:../master_satuan.php?pesan=sukses_delete");
      }else{
        header("location:../master_satuan.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_satuan'])){
  $id_satuan = $_POST['id_satuan'];
  $nama_satuan = $_POST['nama_satuan'];
  $jumlah_satuan = $_POST['jumlah_satuan'];

  $result = mysqli_query($con, "UPDATE satuan_bahan SET 
    SATUAN = '$nama_satuan',
    JUMLAH_SATUAN = '$jumlah_satuan'
    WHERE
    ID_SATUAN = '$id_satuan'
  ");

  if($result){
    header("location:../master_satuan.php?pesan=sukses_edit");
  }else{
    header("location:../master_satuan.php?pesan=gagal_edit");
  }
}

if(isset($_POST['tambah_satuan'])){
  $nama_satuan = $_POST['nama_satuan'];
  $jumlah_satuan = $_POST['jumlah_satuan'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_SATUAN from satuan_bahan ORDER BY ID_SATUAN DESC LIMIT 1");
    while($satuan_data = mysqli_fetch_array($data))
    {
        $sat_id = $satuan_data['ID_SATUAN'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_satuan = autonumber($sat_id, 3, 6);
    }else{
      $id_satuan = 'SBN000001';
    }

    $result = mysqli_query($con, "INSERT INTO satuan_bahan
    VALUES('$id_satuan', '$nama_satuan', '$jumlah_satuan')
    ");

  if($result){
    header("location:../master_satuan.php?pesan=sukses_insert");
  }else{
    header("location:../master_satuan.php?pesan=gagal_insert");
  }
}

