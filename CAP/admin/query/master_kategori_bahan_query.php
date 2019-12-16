<?php
include '../includes/config.php';
if(isset($_GET['id_kategori_bahan'])){
  $id_kategori_bahan = $_GET['id_kategori_bahan'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM kategori_bahan WHERE ID_KAT_BAHAN='$id_kategori_bahan'");
      if($result){
        header("location:../kategori_bahan.php?pesan=sukses_delete");
      }else{
        header("location:../kategori_bahan.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_kategori_bahan'])){
  $id_kategori_bahan = $_POST['id_kategori_bahan'];
  $nama_kategori_bahan = $_POST['nama_kategori_bahan'];

  $result = mysqli_query($con, "UPDATE kategori_bahan SET 
    NAMA_KAT_BAHAN= '$nama_kategori_bahan'
    WHERE
    ID_KAT_BAHAN = '$id_kategori_bahan'
  ");

  if($result){
    header("location:../kategori_bahan.php?pesan=sukses_edit");
  }else{
    header("location:../kategori_bahan.php?pesan=gagal_edit");
  }
}

if(isset($_POST['tambah_kategori_bahan'])){
  $nama_kategori_bahan = $_POST['nama_kategori_bahan'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_KAT_BAHAN from kategori_bahan ORDER BY ID_KAT_BAHAN DESC LIMIT 1");
    while($kategori_data = mysqli_fetch_array($data))
    {
        $kat_id = $kategori_data['ID_KAT_BAHAN'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_kategori = autonumber($kat_id, 3, 6);
    }else{
      $id_kategori = 'KBN000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    kategori_bahan(ID_KAT_BAHAN, NAMA_KAT_BAHAN)
    VALUES('$id_kategori', '$nama_kategori_bahan')
    ");

  if($result){
    header("location:../kategori_bahan.php?pesan=sukses_insert");
  }else{
    header("location:../kategori_bahan.php?pesan=gagal_insert");
  }
}

