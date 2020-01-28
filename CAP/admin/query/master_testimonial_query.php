<?php
include '../includes/config.php';
if(isset($_GET['id_testimonial'])){
  $id_testimonial = $_GET['id_testimonial'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $resulttesti = mysqli_query($con, "SELECT * FROM testimonial WHERE ID_TESTI ='$id_testimonial'");
      $datatesti = mysqli_fetch_assoc($resulttesti);
      $namatesti = $datatesti['TESTI_FOTO'];
      unlink('../../src/img/testimonial/'.$namatesti);
      
      $result = mysqli_query($con, "DELETE FROM testimonial WHERE ID_TESTI='$id_testimonial'");
      if($result){
        header("location:../master_testimonial.php?pesan=sukses_delete");
      }else{
        header("location:../master_testimonial.php?pesan=gagal_delete");
      }
    }
  }
}

if(isset($_POST['edit_testimonial'])){

  $id_testimonial = $_POST['id_testi'];
  $nama_testi = $_POST['nama'];
  $profesi = $_POST['profesi'];
  $deskripsi = $_POST['deskripsi'];

  if($_FILES['gambar']['name'] == null){

    $result = mysqli_query($con, "UPDATE testimonial SET 
      TESTI_NAMA = '$nama_testi',
      TESTI_PROFESI = '$profesi',
      TESTI_DESC = '$deskripsi'
      WHERE
      ID_TESTI = '$id_testimonial'
    ");

    if($result){
      header("location:../master_testimonial.php?pesan=sukses_edit");
    }else{
      header("location:../master_testimonial.php?pesan=gagal_edit");
    }
  }else{
    $ekstensi_boleh = array('png','jpg','jpeg','JPG','PNG','JPEG'); //ekstensi file yang boleh diupload
    $nama = $_FILES['gambar']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['gambar']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['gambar']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 3132210 && $ukuran != 0){ 
                $resulttesti = mysqli_query($con, "SELECT * FROM testimonial WHERE ID_TESTI ='$id_testimonial'");
                $datatesti = mysqli_fetch_assoc($resulttesti);
                $namatesti = $datatesti['TESTI_FOTO'];
                unlink('../../src/img/testimonial/'.$namatesti);

                $id = rand(0,100);
                $uniq = uniqid($id,true);
                move_uploaded_file($file_temporary, '../../src/img/testimonial/'.$uniq.'.'.$ekstensi); //untuk upload file
                $query = mysqli_query ($con, "UPDATE testimonial 
                SET TESTI_NAMA = '$nama_testi',
                    TESTI_PROFESI = '$profesi',
                    TESTI_DESC = '$deskripsi',
                    TESTI_FOTO = '$uniq.$ekstensi'
                WHERE ID_TESTI ='$id_testimonial'");
                    if($query) {
                        header("location:../master_testimonial.php?pesan=sukses_edit");
                    }else{
                        header("location:../master_testimonial.php?pesan=gagal_edit");
                    }
            }else{
                header("location:../master_testimonial.php?pesan=ukuran_besar");
            }
        }else{
            header("location:../master_testimonial.php?pesan=ekstensi_salah");
        }
  }

}

if(isset($_POST['tambah_testimonial'])){
  $nama_testi = $_POST['nama'];
  $profesi = $_POST['profesi'];
  $deskripsi = $_POST['deskripsi'];
  
      // UNTUK MENGAMBIL ID TERAKHIR
      $data = mysqli_query($con, "select ID_TESTI from testimonial ORDER BY ID_TESTI DESC LIMIT 1");
      while($testimonial_data = mysqli_fetch_array($data))
      {
          $tst_id = $testimonial_data['ID_TESTI'];
      }
  
      $row = mysqli_num_rows($data);
      if($row>0){
      $id_testimonial = autonumber($tst_id, 3, 6);
      }else{
      $id_testimonial = 'TST000001';
      }
  
      $ekstensi_boleh = array('png','jpg','jpeg','JPG','PNG','JPEG'); //ekstensi file yang boleh diupload
      $nama = $_FILES['gambar']['name']; //menunjukkan letak dan nama file yang akan di upload
      $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
      $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
      $ukuran = $_FILES['gambar']['size']; //untuk mendapatkan ukuran file yang diupload
      $file_temporary = $_FILES['gambar']['tmp_name']; //untuk mendapatkan temporary file yang di upload
          if(in_array($ekstensi,$ekstensi_boleh)===true){
              if($ukuran < 3132210 && $ukuran != 0){ 
                  $id = rand(0,100);
                  $uniq = uniqid($id,true);
                  move_uploaded_file($file_temporary, '../../src/img/testimonial/'.$uniq.'.'.$ekstensi); //untuk upload file
                  $query = mysqli_query ($con, "INSERT INTO testimonial VALUES(
                      '$id_testimonial','$nama_testi','$profesi','$deskripsi','$uniq.$ekstensi')");
                      if($query) {
                          header("location:../master_testimonial.php?pesan=sukses_insert");
                      }else{
                          header("location:../master_testimonial.php?pesan=gagal_insert");
                      }
              }else{
                  header("location:../master_testimonial.php?pesan=ukuran_besar");
              }
          }else{
              header("location:../master_testimonial.php?pesan=ekstensi_salah");
          }
  
  }
