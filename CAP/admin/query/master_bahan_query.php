<?php
include '../includes/config.php';
if(isset($_GET['id_bahan'])){
  $id_bahan = $_GET['id_bahan'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM bahan WHERE ID_BAHAN='$id_bahan'");
      header("location:../master_bahan.php");
    }
  }
}

if(isset($_POST['edit_bahan'])){
  $id_bahan = $_POST['id_bahan'];
  $nama_bahan = $_POST['nama_bahan'];
  $satuan_bahan = $_POST['satuan_bahan'];
  $jumlah_satuan = $_POST['jumlah_satuan'];
  $isi_bahan = $_POST['isi_per_bahan'];
  $harga_bahan = $_POST['harga_bahan'];
  $kategori_bahan = $_POST['kategori_bahan'];

  $result = mysqli_query($con, "UPDATE bahan SET 
    NAMA_BAHAN = '$nama_bahan',
    SATUAN = '$satuan_bahan',
    JUMLAH_SATUAN = '$jumlah_satuan',
    ISI_PERBAHAN = '$isi_bahan',
    HARGA_BAHAN = '$harga_bahan',
    ID_KAT_BAHAN = '$kategori_bahan'
    WHERE
    ID_BAHAN = '$id_bahan'
  ");

header("location:../master_bahan.php");
}

if(isset($_POST['tambah_bahan'])){
  $nama_bahan = $_POST['nama_bahan'];
  $satuan_bahan = $_POST['satuan_bahan'];
  $jumlah_satuan = $_POST['jumlah_satuan'];
  $isi_bahan = $_POST['isi_per_bahan'];
  $harga_bahan = $_POST['harga_bahan'];
  $kategori_bahan = $_POST['kategori_bahan'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_BAHAN from bahan ORDER BY ID_BAHAN DESC LIMIT 1");
    while($data_bahan = mysqli_fetch_array($data))
    {
        $kat_id = $data_bahan['ID_BAHAN'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_bahan = autonumber($kat_id, 3, 6);
    }else{
      $id_bahan = 'BHN000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    bahan
    VALUES('$id_bahan', '$kategori_bahan', '$nama_bahan', '$harga_bahan', '$satuan_bahan', '$jumlah_satuan', '$isi_bahan')
    ");

    header("location:../master_bahan.php");
}