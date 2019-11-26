<?php

include '../includes/config.php';
if(isset($_GET['id_produk'])){
  $id_produk = $_GET['id_produk'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $data = mysqli_query($con, "SELECT * from tampil_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $data_tampil = mysqli_fetch_assoc($data);
      $nama_produk = $data_tampil['NAMA_PRODUK'];
      $nama_file = "../ket_produk/$nama_produk";

      $result_warna = mysqli_query($con, "DELETE FROM tampil_warna WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result_bahan = mysqli_query($con, "DELETE FROM tampil_bahan WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result_ukuran = mysqli_query($con, "DELETE FROM tampil_ukuran WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result = mysqli_query($con, "DELETE FROM tampil_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");
      unlink($nama_file);
      header("location:../master_produk.php");
    }
  }
}

if(isset($_POST['tambah_produk'])){
  $nama_produk = $_POST['nama_produk'];
  $desc_produk = $_POST['desc_produk'];
  $kategori_produk = $_POST['kategori_produk'];

  $data = mysqli_query($con, "select ID_TAMPIL_PRODUK from tampil_produk ORDER BY ID_TAMPIL_PRODUK DESC LIMIT 1");
    while($data_produk = mysqli_fetch_array($data))
    {
        $prd_id = $data_produk['ID_TAMPIL_PRODUK'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_produk = autonumber($prd_id, 3, 6);
    }else{
      $id_produk = 'PRD000001';
    }

  $ekstensi_boleh = array('htm','html'); //ekstensi file yang boleh diupload
  $nama = $_FILES['ket_produk']['name']; //menunjukkan letak dan nama file yang akan di upload
  $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
  $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
  $size = $_FILES['ket_produk']['size']; //untuk mendapatkan size file yang diupload
  $file_temporary = $_FILES['ket_produk']['tmp_name']; //untuk mendapatkan temporary file yang di upload
  
  if(in_array($ekstensi,$ekstensi_boleh)===true){
      if($size < 3132210){ 
          move_uploaded_file($file_temporary, '../ket_produk/'.$nama); //untuk upload file
          $query = mysqli_query ($con, "INSERT INTO tampil_produk 
          VALUES('$id_produk', '$kategori_produk', '$nama_produk', '$desc_produk', '$nama', 1) 
          ");

          foreach ($_POST['check_warna'] as $id_warna) {
            $warna = $id_warna;
            mysqli_query($con, "INSERT INTO tampil_warna VALUES ('$id_produk','$warna')") or die(mysqli_error());
          }

          foreach ($_POST['check_bahan'] as $id_bahan) {
            $bahan = $id_bahan;
            mysqli_query($con, "INSERT INTO tampil_bahan VALUES ('$id_produk','$bahan')") or die(mysqli_error());
          }

          foreach ($_POST['check_ukuran'] as $id_ukuran) {
            $ukuran = $id_ukuran;
            mysqli_query($con, "INSERT INTO tampil_ukuran VALUES ('$id_produk','$ukuran')") or die(mysqli_error());
          }

          if($query) {
              header("location:../master_produk.php");
          }else{
              echo "MAAF...., UPLOAD GAGAL";
          }
      }else{
          echo "UKURAN FILE TERLALU BESAR";
      }
  }else{
      echo "FILE TIDAK SESUAI DENGAN EKSTENSI YANG DIBERIKAN";
  }

  if(isset($_FILES['gambar_produk[]'])){

    foreach($_FILES['gambar_produk'] as $gambar){
    $ekstensi_boleh = array('png','jpg','jpeg'); //ekstensi file yang boleh diupload
    $nama_gbr = $gambar['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama_gbr); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $gambar['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $gambar['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 3132210){ 
                move_uploaded_file($file_temporary, '../pictures/produk_thumb/'.$nama_gbr); //untuk upload file
                $query = mysqli_query ($con, "INSERT INTO gambar_produk VALUES('$id_gambar', '$id_produk', '$nama_gbr')");
                    if($query) {
                        header("location:../master_produk.php");
                    }else{
                        echo "MAAF...., UPLOAD GAGAL";
                    }
            }else{
                echo "UKURAN FILE TERLALU BESAR";
            }
        }else{
            echo "FILE TIDAK SESUAI DENGAN EKSTENSI YANG DIBERIKAN";
        }
    }
  }
}