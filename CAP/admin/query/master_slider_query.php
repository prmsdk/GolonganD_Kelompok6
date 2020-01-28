<?php
include '../includes/config.php';
if(isset($_GET['id_slider'])){
$id_slider = $_GET['id_slider'];

if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
    $resultslider = mysqli_query($con, "SELECT * FROM slider WHERE ID_SLIDER ='$id_slider'");
    $dataslider = mysqli_fetch_assoc($resultslider);
    $namaslider = $dataslider['GAMBAR'];
    unlink('../../src/img/slider/'.$namaslider);

    $result = mysqli_query($con, "DELETE FROM slider WHERE ID_SLIDER='$id_slider'");
    header("location:../master_slider.php");
    }
}
}

if(isset($_POST['edit_slider'])){

if($_FILES['gambar']['name'] == null){
    $id_slider = $_POST['id_slider'];
    $tombol = $_POST['tombol'];
    $link = $_POST['link'];
    $desc = $_POST['deskripsi'];

    $query = mysqli_query ($con, "UPDATE slider 
    SET TOMBOL = '$tombol',
        LINK = '$link',
        DESKRIPSI = '$desc'
    WHERE ID_SLIDER ='$id_slider'");
        if($query) {
            header("location:../master_slider.php?pesan=sukses_upload");
        }else{
            header("location:../master_slider.php?pesan=gagal_upload");
        }

}else{
    $id_slider = $_POST['id_slider'];
    $tombol = $_POST['tombol'];
    $link = $_POST['link'];
    $desc = $_POST['deskripsi'];

    $ekstensi_boleh = array('png','jpg','jpeg','JPG','PNG','JPEG'); //ekstensi file yang boleh diupload
    $nama = $_FILES['gambar']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['gambar']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['gambar']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 3132210 && $ukuran != 0){ 
                $resultslider = mysqli_query($con, "SELECT * FROM slider WHERE ID_SLIDER ='$id_slider'");
                $dataslider = mysqli_fetch_assoc($resultslider);
                $namaslider = $dataslider['GAMBAR'];
                unlink('../../src/img/slider/'.$namaslider);

                $id = rand(0,100);
                $uniq = uniqid($id,true);
                
                move_uploaded_file($file_temporary, '../../src/img/slider/'.$uniq.'.'.$ekstensi); //untuk upload file
                $query = mysqli_query ($con, "UPDATE slider 
                SET GAMBAR = '$uniq.$ekstensi',
                    TOMBOL = '$tombol',
                    LINK = '$link',
                    DESKRIPSI = '$desc'
                WHERE ID_SLIDER ='$id_slider'");
                    if($query) {
                        header("location:../master_slider.php?pesan=sukses_upload");
                    }else{
                        header("location:../master_slider.php?pesan=gagal_upload");
                    }
            }else{
                header("location:../master_slider.php?pesan=ukuran_besar");
            }
        }else{
            header("location:../master_slider.php?pesan=ekstensi_salah");
        }
}
}

if(isset($_POST['tambah_slider'])){
$tombol = $_POST['tombol'];
$link = $_POST['link'];
$desc = $_POST['deskripsi'];

// UNTUK MENGAMBIL ID TERAKHIR
$data = mysqli_query($con, "select ID_SLIDER from slider ORDER BY ID_SLIDER DESC LIMIT 1");
    while($slider_data = mysqli_fetch_array($data))
    {
        $sld_id = $slider_data['ID_SLIDER'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
    $id_slider = autonumber($sld_id, 3, 6);
    }else{
    $id_slider = 'SLD000001';
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
                move_uploaded_file($file_temporary, '../../src/img/slider/'.$uniq.'.'.$ekstensi); //untuk upload file
                $query = mysqli_query ($con, "INSERT INTO slider VALUES(
                    '$id_slider','$tombol','$link','$desc','$uniq.$ekstensi')");
                    if($query) {
                        header("location:../master_slider.php?pesan=sukses_upload");
                    }else{
                        header("location:../master_slider.php?pesan=gagal_upload");
                    }
            }else{
                header("location:../master_slider.php?pesan=ukuran_besar");
            }
        }else{
            header("location:../master_slider.php?pesan=ekstensi_salah");
        }

}

