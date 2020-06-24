<?php

include '../includes/config.php';
if(isset($_GET['id_produk'])){
  $id_produk = $_GET['id_produk'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $data = mysqli_query($con, "SELECT * from tampil_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $data_tampil = mysqli_fetch_assoc($data);
      $nama_produk = $data_tampil['KET_TAMPIL_PRODUK'];
      $nama_file = "../src/file/$nama_produk";
      unlink($nama_file);

      $result_warna = mysqli_query($con, "DELETE FROM tampil_warna WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result_bahan = mysqli_query($con, "DELETE FROM tampil_bahan WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result_ukuran = mysqli_query($con, "DELETE FROM tampil_ukuran WHERE ID_TAMPIL_PRODUK='$id_produk'");
      
      $result_gambar = mysqli_query($con, "SELECT * from gambar_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");
      while($data_gambar = mysqli_fetch_assoc($result_gambar)){
      $nama_gambar = $data_gambar['GBR_FILE_NAME'];
      $nama_gambar = "../../pictures/produk_thumb/$nama_gambar";
      unlink($nama_gambar);
      }

      $result_gbr = mysqli_query($con, "DELETE FROM gambar_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result = mysqli_query($con, "DELETE FROM tampil_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");

      if($result&&$result_warna&&$result_bahan&&$result_ukuran&&$result_gbr){
        header("location:../master_produk.php?pesan=sukses_delete");
      }else{
        header("location:../master_produk.php?pesan=gagal_delete");
      }
    }
  }
}



// ====================== PRODUK TAMBAH ===================================



if(isset($_POST['tambah_produk'])){
  $nama_produk = $_POST['nama_produk'];
  $desc_produk = $_POST['desc_produk'];
  $kategori_produk = $_POST['kategori_produk'];
  $status_produk = $_POST['status_produk'];
  $isi_produk = $_POST['isi_produk'];
  if($isi_produk == 1){
    $isi_custom = $_POST['isi_custom'];
  }else{
    $isi_custom = '';
  }
  $min_pemesanan = $_POST['min_pemesanan'];

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
      if($size < 3132210 && $size != 0){ 
          $id = rand(0,100);
          $uniq = uniqid($id,true);
          move_uploaded_file($file_temporary, '../../src/file/'.$uniq.'.'.$ekstensi); //untuk upload file
          $query = mysqli_query ($con, "INSERT INTO tampil_produk 
          VALUES('$id_produk', '$kategori_produk', '$nama_produk', '$desc_produk', '$uniq.$ekstensi', '$isi_produk','$isi_custom','$min_pemesanan','$status_produk') 
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
            header("location:../master_produk.php?pesan=sukses_insert");
          }else{
            header("location:../master_produk.php?pesan=gagal_insert");
          }
      }else{
        header("location:../master_produk.php?pesan=ukuran_besar");
      }
  }else{
    header("location:../master_produk.php?pesan=ekstensi_salah");
  }

}


// =============================== PRODUK EDIT =====================================


if(isset($_POST['edit_produk'])){
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $desc_produk = $_POST['desc_produk'];
  $kategori_produk = $_POST['kategori_produk'];
  $status_produk = $_POST['status_produk'];
  $isi_produk = $_POST['isi_produk'];
  if($isi_produk == 1){
    $isi_custom = $_POST['isi_custom'];
  }else{
    $isi_custom = '';
  }
  $min_pemesanan = $_POST['min_pemesanan'];

  var_dump($_FILES['ket_produk']);

  if($_FILES['ket_produk']['name'] != null){
  $ekstensi_boleh = array('htm','html'); //ekstensi file yang boleh diupload
  $nama = $_FILES['ket_produk']['name']; //menunjukkan letak dan nama file yang akan di upload
  $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
  $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
  $size = $_FILES['ket_produk']['size']; //untuk mendapatkan size file yang diupload
  $file_temporary = $_FILES['ket_produk']['tmp_name']; //untuk mendapatkan temporary file yang di upload
    
    if(in_array($ekstensi,$ekstensi_boleh)===true){
        if($size < 3132210 && $size != 0){ 
            $resultprd = mysqli_query($con, "SELECT * FROM tampil_produk WHERE ID_TAMPIL_PRODUK = '$id_produk'");
            $dataprd = mysqli_fetch_assoc($resultprd);
            $namaprd = $dataprd['KET_TAMPIL_PRODUK'];
            unlink('../../src/file/'.$namaprd);

            $id = rand(0,100);
            $uniq = uniqid($id,true);
            move_uploaded_file($file_temporary, '../../src/file/'.$uniq.'.'.$ekstensi); //untuk upload file
            $query = mysqli_query ($con, "UPDATE tampil_produk SET
            ID_KATEGORI = '$kategori_produk', 
            NAMA_TAMPIL_PRODUK = '$nama_produk', 
            DESC_TAMPIL_PRODUK = '$desc_produk', 
            KET_TAMPIL_PRODUK = '$uniq.$ekstensi', 
            STATUS_ISI = '$isi_produk',
            BATAS_ISI = '$isi_custom',
            MIN_JUMLAH = '$min_pemesanan',
            STATUS_TAMPIL_PRODUK = '$status_produk'
            WHERE
            ID_TAMPIL_PRODUK = '$id_produk'
            ");

            $result_warna = mysqli_query($con, "DELETE FROM tampil_warna WHERE ID_TAMPIL_PRODUK='$id_produk'");
            $result_bahan = mysqli_query($con, "DELETE FROM tampil_bahan WHERE ID_TAMPIL_PRODUK='$id_produk'");
            $result_ukuran = mysqli_query($con, "DELETE FROM tampil_ukuran WHERE ID_TAMPIL_PRODUK='$id_produk'");

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
              header("location:../master_produk.php?id_produk=$id_produk&pesan=sukses_edit");
            }else{
              header("location:../master_produk.php?pesan=gagal_edit");
            }
        }else{
          header("location:../master_produk.php?pesan=ukuran_besar");
        }
    }else{
      header("location:../master_produk.php?pesan=ekstensi_salah");
    }
  }else{
    $query = mysqli_query ($con, "UPDATE tampil_produk SET
    ID_KATEGORI = '$kategori_produk', 
    NAMA_TAMPIL_PRODUK = '$nama_produk', 
    DESC_TAMPIL_PRODUK = '$desc_produk', 
    STATUS_TAMPIL_PRODUK = '$status_produk'
    WHERE
    ID_TAMPIL_PRODUK = '$id_produk'
    ");

    $result_warna = mysqli_query($con, "DELETE FROM tampil_warna WHERE ID_TAMPIL_PRODUK='$id_produk'");
    $result_bahan = mysqli_query($con, "DELETE FROM tampil_bahan WHERE ID_TAMPIL_PRODUK='$id_produk'");
    $result_ukuran = mysqli_query($con, "DELETE FROM tampil_ukuran WHERE ID_TAMPIL_PRODUK='$id_produk'");

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
      header("location:../master_produk_detail.php?id_produk=$id_produk&pesan=sukses_edit");
    }else{
      header("location:../master_produk.php?pesan=gagal_edit");
    }
  }
    
}