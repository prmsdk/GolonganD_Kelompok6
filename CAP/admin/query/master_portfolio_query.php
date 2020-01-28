<?php
include '../includes/config.php';
if(isset($_GET['id_portfolio'])){
  $id_portfolio = $_GET['id_portfolio'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $resultport = mysqli_query($con, "SELECT * FROM portfolio WHERE ID_PORTFOLIO ='$id_portfolio'");
      $dataport = mysqli_fetch_assoc($resultport);
      $namaport = $dataport['GAMBAR'];
      unlink('../../src/img/portfolio/'.$namaport);

      $result = mysqli_query($con, "DELETE FROM portfolio WHERE ID_PORTFOLIO='$id_portfolio'");
      if($result){
        header("location:../master_portfolio.php?pesan=sukses_delete");
      }else{
        header("location:../master_portfolio.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_portfolio'])){

  $id_portfolio = $_POST['id_portfolio'];
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];

  if($_FILES['gambar']['name'] == null){

    $result = mysqli_query($con, "UPDATE portfolio SET 
      JUDUL = '$judul',
      DESKRIPSI = '$deskripsi',
      LINK = '$link'
      WHERE
      ID_PORTFOLIO = '$id_portfolio'
    ");

    if($result){
      header("location:../portfolio.php?pesan=sukses_edit");
    }else{
      header("location:../portfolio.php?pesan=gagal_edit");
    }
  }else{
    $ekstensi_boleh = array('png','jpg','jpeg','JPG','PNG','JPEG'); //ekstensi file yang boleh diupload
    $nama = $_FILES['gambar']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['gambar']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['gambar']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 10132210 && $ukuran != 0){ 
                $resultport = mysqli_query($con, "SELECT * FROM portfolio WHERE ID_PORTFOLIO ='$id_portfolio'");
                $dataport = mysqli_fetch_assoc($resultport);
                $namaport = $dataport['GAMBAR'];
                unlink('../../src/img/portfolio/'.$namaport);

                $id = rand(0,100);
                $uniq = uniqid($id,true);
                move_uploaded_file($file_temporary, '../../src/img/portfolio/'.$uniq.'.'.$ekstensi); //untuk upload file
                $query = mysqli_query ($con, "UPDATE portfolio 
                SET JUDUL = '$judul',
                    DESKRIPSI = '$deskripsi',
                    GAMBAR = '$uniq.$ekstensi'
                WHERE ID_PORTFOLIO ='$id_portfolio'");
                    if($query) {
                        header("location:../master_portfolio.php?pesan=sukses_edit");
                    }else{
                        header("location:../master_portfolio.php?pesan=gagal_edit");
                    }
            }else{
                header("location:../master_portfolio.php?pesan=ukuran_besar");
            }
        }else{
            header("location:../master_portfolio.php?pesan=ekstensi_salah");
        }
  }

}

if(isset($_POST['tambah_portfolio'])){
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_PORTFOLIO from portfolio ORDER BY ID_PORTFOLIO DESC LIMIT 1");
      while($portfolio_data = mysqli_fetch_array($data))
      {
          $sld_id = $portfolio_data['ID_PORTFOLIO'];
      }
  
      $row = mysqli_num_rows($data);
      if($row>0){
      $id_portfolio = autonumber($sld_id, 3, 6);
      }else{
      $id_portfolio = 'PFL000001';
      }
  
      $ekstensi_boleh = array('png','jpg','jpeg','JPG','PNG','JPEG'); //ekstensi file yang boleh diupload
      $nama = $_FILES['gambar']['name']; //menunjukkan letak dan nama file yang akan di upload
      $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
      $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
      $ukuran = $_FILES['gambar']['size']; //untuk mendapatkan ukuran file yang diupload
      $file_temporary = $_FILES['gambar']['tmp_name']; //untuk mendapatkan temporary file yang di upload
          if(in_array($ekstensi,$ekstensi_boleh)===true){
              if($ukuran < 10132210 && $ukuran != 0){ 
                  $id = rand(0,100);
                  $uniq = uniqid($id,true);
                  move_uploaded_file($file_temporary, '../../src/img/portfolio/'.$uniq.'.'.$ekstensi); //untuk upload file
                  $query = mysqli_query ($con, "INSERT INTO portfolio VALUES(
                      '$id_portfolio','$judul','$deskripsi','$uniq.$ekstensi')");
                      if($query) {
                          header("location:../master_portfolio.php?pesan=sukses_insert");
                      }else{
                          header("location:../master_portfolio.php?pesan=gagal_insert");
                      }
              }else{
                  header("location:../master_portfolio.php?pesan=ukuran_besar");
              }
          }else{
              header("location:../master_portfolio.php?pesan=ekstensi_salah");
          }
  
  }
