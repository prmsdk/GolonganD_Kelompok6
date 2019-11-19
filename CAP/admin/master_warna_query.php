<?php
include '../includes/config.php';
if(isset($_GET['id_warna'])){
  $id_warna = $_GET['id_warna'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM master_warna WHERE ID_WARNA='$id_warna'");
      header("location:../master_warna.php?pesan=hapus_done");
    }
  }
}

if(isset($_POST['editi_warna'])){
  $id_warna = $_POST['id_warna'];
  $namaa_warna = $_POST['nama_warna'];

  $result = mysqli_query($con, "UPDATE jenis_warna SET 
    JENIS_WARNA= '$nama_warna'
    WHERE
    ID_WARNA = '$id_warna'
  ");

header("location:../master_warna.php?pesan=update_done_$nama_admin");
}

if(isset($_POST['tambah_warna'])){
  $nama_warna = $_POST['nama_warna'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_WARNA from jenis_warna ORDER BY ID_WARNA DESC LIMIT 1");
    while($kategori_data = mysqli_fetch_array($data))
    {
        $kat_id = $kategori_data['ID_WARNA'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_warna = autonumber($kat_id, 3, 6);
    }else{
      $id_warna = 'KPD000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    master_warna(ID_WARNA, JENIS_WARNA)
    VALUES('$id_warna', '$jenis_warna')
    ");

    header("location:../master_warna.php?pesan=Anda berhasil mendaftar!&status=success");
}

