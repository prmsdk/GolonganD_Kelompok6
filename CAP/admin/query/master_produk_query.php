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
      unlink($nama_produk);

      $result_warna = mysqli_query($con, "DELETE FROM tampil_warna WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result_bahan = mysqli_query($con, "DELETE FROM tampil_bahan WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result_ukuran = mysqli_query($con, "DELETE FROM tampil_ukuran WHERE ID_TAMPIL_PRODUK='$id_produk'");
      
      $result_gambar = mysqli_query($con, "SELECT * from gambar_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");
      while($data_gambar = mysqli_fetch_assoc($result_gambar)){
      $nama_gambar = $data_tampil['GBR_FILE_NAME'];
      $nama_gambar = "../pictures/produk_thumb/$nama_gambar";
      unlink($nama_gambar);
      }

      $result_gbr = mysqli_query($con, "DELETE FROM gambar_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");
      $result = mysqli_query($con, "DELETE FROM tampil_produk WHERE ID_TAMPIL_PRODUK='$id_produk'");

      
      header("location:../master_produk.php");
    }
  }
}



// ====================== PRODUK TAMBAH ===================================



if(isset($_POST['tambah_produk'])){
  $nama_produk = $_POST['nama_produk'];
  $desc_produk = $_POST['desc_produk'];
  $kategori_produk = $_POST['kategori_produk'];
  $status_produk = $_POST['status_produk'];

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
          move_uploaded_file($file_temporary, '../../src/file/'.$nama); //untuk upload file
          $query = mysqli_query ($con, "INSERT INTO tampil_produk 
          VALUES('$id_produk', '$kategori_produk', '$nama_produk', '$desc_produk', '$nama', '$status_produk') 
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
              // header("location:../master_produk.php");
          }else{
              echo "MAAF...., UPLOAD GAGAL";
          }
      }else{
          echo "UKURAN FILE TERLALU BESAR";
      }
  }else{
      echo "FILE TIDAK SESUAI DENGAN EKSTENSI YANG DIBERIKAN";
  }

  if(isset($_FILES['gambar_produk'])){

    // File upload configuration
    $targetDir = "../../pictures/produk_thumb/";
    $allowTypes = array('jpg','png','jpeg','JPG','PNG','JPEG');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $i = 0;
    if(!empty(array_filter($_FILES['gambar_produk']['name']))){
        foreach($_FILES['gambar_produk']['name'] as $key=>$val){
            $i+=1;
            // File upload path
            $fileName = basename($_FILES['gambar_produk']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["gambar_produk"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL = $fileName;
                }else{
                    $errorUpload .= $_FILES['gambar_produk']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['gambar_produk']['name'][$key].', ';
            }

            $data_gbr = mysqli_query($con, "select GBR_ID from gambar_produk ORDER BY GBR_ID DESC LIMIT 1");
            while($data_gambar = mysqli_fetch_array($data_gbr))
            {
                $gbr_id = $data_gambar['GBR_ID'];
            }

            $row = mysqli_num_rows($data);
            if($row>0){
              $id_gambar = autonumber($gbr_id, 3, 6);
            }else{
              $id_gambar = 'GBR000001';
            }

            if(empty($errorUpload OR $errorUploadType OR $errorMsg)){
              // Insert image file name into database
              $insert = mysqli_query($con, "INSERT INTO gambar_produk(GBR_ID, ID_TAMPIL_PRODUK, GBR_FILE_NAME) VALUES('$id_gambar','$id_produk','$insertValuesSQL')");
              var_dump($insertValuesSQL);
              var_dump($id_gambar);
              if($insert){
                  $statusMsg = "Files are uploaded successfully.".$errorMsg;
                  
              }else{
                  $statusMsg = "Sorry, there was an error uploading your file.".$errorMsg;
              }
            }else{
              $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
              $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
              $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
              $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }
        }

        
        
        
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
    
    // Display status message
    echo $statusMsg;

    header("location:../master_produk.php");
  }
}


// =============================== PRODUK EDIT =====================================


if(isset($_POST['edit_produk'])){
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $desc_produk = $_POST['desc_produk'];
  $kategori_produk = $_POST['kategori_produk'];
  $status_produk = $_POST['status_produk'];

  var_dump($_FILES['ket_produk']);

  if(is_null($_FILES['ket_produk']['name'])){
  $ekstensi_boleh = array('htm','html'); //ekstensi file yang boleh diupload
  $nama = $_FILES['ket_produk']['name']; //menunjukkan letak dan nama file yang akan di upload
  $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
  $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
  $size = $_FILES['ket_produk']['size']; //untuk mendapatkan size file yang diupload
  $file_temporary = $_FILES['ket_produk']['tmp_name']; //untuk mendapatkan temporary file yang di upload
    
    if(in_array($ekstensi,$ekstensi_boleh)===true){
        if($size < 3132210){ 
            move_uploaded_file($file_temporary, '../../src/file/'.$nama); //untuk upload file
            $query = mysqli_query ($con, "UPDATE tampil_produk SET
            ID_KATEGORI = '$kategori_produk', 
            NAMA_TAMPIL_PRODUK = '$nama_produk', 
            DESC_TAMPIL_PRODUK = '$desc_produk', 
            KET_TAMPIL_PRODUK = '$nama', 
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
                // header("location:../master_produk.php");
            }else{
                echo "MAAF...., UPLOAD GAGAL";
            }
        }else{
            echo "UKURAN FILE TERLALU BESAR";
        }
    }else{
        echo "FILE TIDAK SESUAI DENGAN EKSTENSI YANG DIBERIKAN";
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
        header("location:../master_produk_detail.php?id_produk=$id_produk");
    }else{
        echo "GAGAL UPDATE";
    }
  }
    
}