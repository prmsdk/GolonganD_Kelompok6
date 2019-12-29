<?php

include 'includes/config.php';

if(isset($_POST['nego_tombol'])){

  $id_user = $_POST['id_user'];

  $id_produk = $_POST['id_produk'];
  $id_warna = $_POST['pilihwarna'];
  $id_bahan = $_POST['pilihbahan'];
  $id_ukuran = $_POST['pilihukuran'];
  $nama_produk = $_POST['nama_produk'];
  $status_desain = $_POST['pilihdesain'];
  $nama_desain = $_POST['namadesain'];
  $jumlah_produk = $_POST['jumlah_produk'];
  $isi_produk = $_POST['isibahan'];
  $catatan = $_POST['cttwarna1'];

  $ket_pembayaran = $_POST['ket_pembayaran'];
  $sub_total = $_POST['sub_total'];
  $nego_harga = $_POST['nego_harga'];

  $data = mysqli_query($con, "select ID_NEGO from nego ORDER BY ID_NEGO DESC LIMIT 1");
  while($nego_data = mysqli_fetch_array($data))
  {
      $neg_id = $nego_data['ID_NEGO'];
  }

  $row = mysqli_num_rows($data);
  if($row>0){
    $id_nego = autonumber($neg_id, 3, 6);
  }else{
    $id_nego = 'NEG000001';
  }

  ini_set('date.timezone', 'Asia/Jakarta');

  $date = date("Y-m-d");
  $time = date("H:i:s");

  $nego = mysqli_query($con, "INSERT INTO nego 

    VALUES('$id_nego','$id_user','$id_produk','$id_ukuran','$id_warna','$id_bahan','$date $time','$nama_produk','$jumlah_produk','$sub_total','$nama_desain','$status_desain','$ket_pembayaran','$isi_produk','$catatan','$nego_harga','1')");

    if($nego){
      // echo"berhasil menambah pesanan <br>";
      header('location:nego_user.php');
    }else{
      echo"gagal menambah pesanan <br>";
    }

    
}
