<?php
session_start();
include 'includes/config.php';

if(isset($_GET['id_nego'])){
  $id_nego = $_GET['id_nego'];
  $delete = mysqli_query($con, "DELETE FROM nego WHERE ID_NEGO = '$id_nego'");
  if($delete){
    header("location:nego_user.php?pesan=sukses_delete");
  }else{
    header("location:nego_user.php?pesan=gagal_delete");
  }
}

if(isset($_POST['nego_pembayaran'])){
  $id_user = $_POST['id_user'];
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $id_ukuran = $_POST['pilihukuran'];
  $id_warna = $_POST['pilihwarna'];
  $id_bahan = $_POST['pilihbahan'];
  $status_desain = $_POST['pilihdesain'];
  $nama_desain = $_POST['namadesain'];
  $ket_pembayaran = $_POST['ket_pembayaran'];
  $isi_produk = $_POST['isibahan'];
  $catatan = $_POST['catatan'];
  $jumlah_produk = $_POST['jumlah_produk'];
  $sub_total = $_POST['sub_total'];
  $total = $_POST['sub_total'];
  $id_bank = $_POST['pilihbank'];
  $id_nego = $_POST['id_nego'];

  // PESANAN ==================

  $data = mysqli_query($con, "select ID_PESANAN from pesanan ORDER BY ID_PESANAN DESC LIMIT 1");
  while($pesanan_data = mysqli_fetch_array($data))
  {
      $psn_id = $pesanan_data['ID_PESANAN'];
  }

  $row = mysqli_num_rows($data);
  if($row>0){
    $id_pesanan = autonumber($psn_id, 3, 6);
  }else{
    $id_pesanan = 'PSN000001';
  }

  ini_set('date.timezone', 'Asia/Jakarta');

  $date = date("Y-m-d");
  $time = date("H:i:s");

    $pesanan = mysqli_query($con, "INSERT INTO pesanan 

    VALUES('$id_pesanan','ADM000001','$id_user','$id_bank','$date $time','$total','1',NULL,0,0,0)");

    if($pesanan){
      echo"berhasil menambah pesanan <br>";
    }else{
      echo"gagal menambah pesanan <br>";
    }

  // PRODUK =====================

  $data = mysqli_query($con, "select ID_PRODUK from produk ORDER BY ID_PRODUK DESC LIMIT 1");
  while($produk_data = mysqli_fetch_array($data))
  {
      $prd_id = $produk_data['ID_PRODUK'];
  }

  $row = mysqli_num_rows($data);
  if($row>0){
    $id_produk = autonumber($prd_id, 3, 6);
  }else{
    $id_produk = 'PRD000001';
  }

  
  $produk = mysqli_query($con, "INSERT INTO produk 
  VALUES('$id_produk','$id_ukuran','$id_bahan','$id_warna','$nama_produk')");

  if($produk){
    echo"berhasil menambah produk <br>";
  }else{
    echo"gagal menambah produk <br>";
  }

  $detail_pesanan = mysqli_query($con, "INSERT INTO detail_pesanan 
  VALUES('$id_produk','$id_pesanan','$jumlah_produk','$sub_total','$nama_desain','$status_desain','$isi_produk','$ket_pembayaran','$catatan')");

  if($detail_pesanan){
    $query_update = mysqli_query($con, "UPDATE nego SET NEGO_STATUS = 3 WHERE ID_NEGO = '$id_nego'");
    header("location:verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank");
    echo"berhasil menambah detail pesanan <br>";
  }else{
    header("location:nego_pembayaran.php?id_nego=$id_nego");
    echo"gagal menambah detail pesanan <br>";
  }
}