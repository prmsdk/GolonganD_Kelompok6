<?php
include '../includes/config.php';
if(isset($_GET['id_ukuran'])){
  $id_ukuran = $_GET['id_ukuran'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM ukuran WHERE ID_UKURAN='$id_ukuran'");
      if($result){
        header("location:../master_ukuran.php?pesan=sukses_delete");
      }else{
        header("location:../master_ukuran.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_ukuran'])){
  $id_ukuran = $_POST['id_ukuran'];
  $jenis_ukuran = $_POST['jenis_ukuran'];
  $harga_ukuran = $_POST['harga_ukuran'];
  $kategori_ukuran = $_POST['kategori_ukuran'];

  $result = mysqli_query($con, "UPDATE ukuran SET 
    JENIS_UKURAN = '$jenis_ukuran',
    HARGA_UKURAN = '$harga_ukuran',
    ID_KAT_UKURAN = '$kategori_ukuran'
    WHERE
    ID_UKURAN = '$id_ukuran'
  ");

  if($result){
    header("location:../master_ukuran.php?pesan=sukses_edit");
  }else{
    header("location:../master_ukuran.php?pesan=gagal_edit");
  }
}

if(isset($_POST['tambah_ukuran'])){
  $jenis_ukuran = $_POST['jenis_ukuran'];
  $harga_ukuran = $_POST['harga_ukuran'];
  $kategori_ukuran = $_POST['kategori_ukuran'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_UKURAN from ukuran ORDER BY ID_UKURAN DESC LIMIT 1");
    while($kategori_data = mysqli_fetch_array($data))
    {
        $kat_id = $kategori_data['ID_UKURAN'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_kategori = autonumber($kat_id, 3, 6);
    }else{
      $id_kategori = 'UKN000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    ukuran
    VALUES('$id_kategori', '$kategori_ukuran', '$jenis_ukuran', '$harga_ukuran')
    ");

  if($result){
    header("location:../master_ukuran.php?pesan=sukses_insert");
  }else{
    header("location:../master_ukuran.php?pesan=gagal_insert");
  }
}