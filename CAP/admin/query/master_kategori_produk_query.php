<?php
include '../includes/config.php';
if(isset($_GET['id_kategori_produk'])){
  $id_kategori_produk = $_GET['id_kategori_produk'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM kategori_produk WHERE ID_KATEGORI='$id_kategori_produk'");
      if($result){
        header("location:../kategori_produk.php?pesan=sukses_delete");
      }else{
        header("location:../kategori_produk.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_kategori_produk'])){
  $id_kategori_produk = $_POST['id_kategori_produk'];
  $nama_kategori_produk = $_POST['nama_kategori_produk'];

  $result = mysqli_query($con, "UPDATE kategori_produk SET 
    NAMA_KAT_PRODUK= '$nama_kategori_produk'
    WHERE
    ID_KATEGORI = '$id_kategori_produk'
  ");

  if($result){
    header("location:../kategori_produk.php?pesan=sukses_edit");
  }else{
    header("location:../kategori_produk.php?pesan=gagal_edit");
  }
}

if(isset($_POST['tambah_kategori_produk'])){
  $nama_kategori = $_POST['nama_kategori'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_KATEGORI from kategori_produk ORDER BY ID_KATEGORI DESC LIMIT 1");
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
    kategori_produk(ID_KATEGORI, NAMA_KAT_PRODUK)
    VALUES('$id_kategori', '$nama_kategori')
    ");

  if($result){
    header("location:../kategori_produk.php?pesan=sukses_insert");
  }else{
    header("location:../kategori_produk.php?pesan=gagal_insert");
  }
}

