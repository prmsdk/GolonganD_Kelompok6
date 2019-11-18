<?php
include '../includes/config.php';
if(isset($_GET['id_kategori_bahan'])){
  $id_kategori_bahan = $_GET['id_kategori_bahan'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM kategori_bahan WHERE ID_KATEGORI='$id_kategori_bahan'");
      header("location:../kategori_bahan.php?pesan=hapus_done");
    }
  }
}

if(isset($_POST['edit_kategori_bahan'])){
  $id_kategori_bahan = $_POST['id_kategori_bahan'];
  $nama_kategori_bahan = $_POST['nama_kategori_bahan'];

  $result = mysqli_query($con, "UPDATE kategori_bahan SET 
    NAMA_KAT_BAHAN= '$nama_kategori_bahan'
    WHERE
    ID_KATEGORI = '$id_kategori_bahan'
  ");

header("location:../kategori_bahan.php?pesan=update_done_$nama_admin");
}

if(isset($_POST['tambah_kategori_bahan'])){
  $nama_kategori = $_POST['nama_kategori'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_KATEGORI from kategori_bahan ORDER BY ID_KATEGORI DESC LIMIT 1");
    while($kategori_data = mysqli_fetch_array($data))
    {
        $kat_id = $kategori_data['ID_KATEGORI'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_kategori = autonumber($kat_id, 3, 6);
    }else{
      $id_kategori = 'KPD000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    kategori_bahan(ID_KATEGORI, NAMA_KAT_BAHAN)
    VALUES('$id_kategori', '$nama_kategori')
    ");

    header("location:../kategori_bahan.php?pesan=Anda berhasil mendaftar!&status=success");
}

