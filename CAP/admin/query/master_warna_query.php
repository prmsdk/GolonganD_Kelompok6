<?php
include '../includes/config.php';
if(isset($_GET['id_warna'])){
  $id_warna = $_GET['id_warna'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM warna WHERE ID_WARNA='$id_warna'");
      if($result){
        header("location:../master_warna.php?pesan=sukses_delete");
      }else{
        header("location:../master_warna.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_warna'])){
  $id_warna = $_POST['id_warna'];
  $jenis_warna = $_POST['jenis_warna'];
  $desc_warna = $_POST['desc_warna'];
  $harga_warna = $_POST['harga_warna'];

  $result = mysqli_query($con, "UPDATE warna SET 
    JENIS_WARNA = '$jenis_warna',
    WARNA_DESC = '$desc_warna',
    HARGA_WARNA = '$harga_warna'
    WHERE
    ID_WARNA = '$id_warna'
  ");

  if($result){
    header("location:../master_warna.php?pesan=sukses_edit");
  }else{
    header("location:../master_warna.php?pesan=gagal_edit");
  }
}

if(isset($_POST['tambah_warna'])){
  $jenis_warna = $_POST['jenis_warna'];
  $desc_warna = $_POST['desc_warna'];
  $harga_warna = $_POST['harga_warna'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_WARNA from warna ORDER BY ID_WARNA DESC LIMIT 1");
    while($warna_data = mysqli_fetch_array($data))
    {
        $warna_id = $warna_data['ID_WARNA'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_warna = autonumber($warna_id, 3, 6);
    }else{
      $id_warna = 'WRN000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    warna(ID_WARNA, JENIS_WARNA, WARNA_DESC, HARGA_WARNA)
    VALUES('$id_warna', '$jenis_warna', '$desc_warna', '$harga_warna')
    ");

  if($result){
    header("location:../master_warna.php?pesan=sukses_insert");
  }else{
    header("location:../master_warna.php?pesan=gagal_insert");
  }
}

