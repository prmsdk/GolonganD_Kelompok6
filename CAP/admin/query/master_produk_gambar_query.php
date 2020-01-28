<?php
include '../includes/config.php';
if(isset($_GET['id_produk_gambar'])){
$id_produk_gambar = $_GET['id_produk_gambar'];

    if(isset($_GET['action'])){
        if($_GET['action']=='delete'){
        $resultgbr = mysqli_query($con, "SELECT * FROM gambar_produk WHERE GBR_ID = '$id_produk_gambar'");
        $datagbr = mysqli_fetch_assoc($resultgbr);
        $namagbr = $datagbr['GBR_FILE_NAME'];
        unlink('../../pictures/produk_thumb/'.$namagbr);

        $result = mysqli_query($con, "DELETE FROM gambar_produk WHERE GBR_ID='$id_produk_gambar'");
        if($result){
                header("location:../master_produk_gambar.php?pesan=sukses_delete");
            }else{
                header("location:../master_produk_gambar.php?pesan=gagal_delete");
            }
        }
    }
}

if(isset($_POST['edit_gambar_produk'])){
$id_produk_gambar = $_POST['id_gambar'];
$id_produk = $_POST['id_produk'];

if($_FILES['gambar_produk']['name'] == null){
        
        $query = mysqli_query ($con, "UPDATE gambar_produk SET ID_TAMPIL_PRODUK='$id_produk' WHERE GBR_ID='$id_produk_gambar'");
        if($query){
            header("location:../master_produk_gambar.php?pesan=sukses_edit");
        }else{
            header("location:../master_produk_gambar.php?pesan=gagal_edit");
        }
    
}else{

$ekstensi_boleh = array('png','jpg','jpeg'); //ekstensi file yang boleh diupload
$nama = $_FILES['gambar_produk']['name']; //menunjukkan letak dan nama file yang akan di upload
$ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
$ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
$ukuran = $_FILES['gambar_produk']['size']; //untuk mendapatkan ukuran file yang diupload
$file_temporary = $_FILES['gambar_produk']['tmp_name']; //untuk mendapatkan temporary file yang di upload
    if(in_array($ekstensi,$ekstensi_boleh)===true){
        if($ukuran < 3132210 && $ukuran != 0){ 
            $resultgbr = mysqli_query($con, "SELECT * FROM gambar_produk WHERE GBR_ID = '$id_produk_gambar'");
            $datagbr = mysqli_fetch_assoc($resultgbr);
            $namagbr = $datagbr['GBR_FILE_NAME'];
            unlink('../../pictures/produk_thumb/'.$namagbr);

            $id = rand(0,100);
            $uniq = uniqid($id,true);
            move_uploaded_file($file_temporary, '../../pictures/produk_thumb/'.$uniq.'.'.$ekstensi); //untuk upload file
            // $query = mysqli_query ($koneksi, "SELECT * FROM user");
            $query = mysqli_query ($con, "UPDATE gambar_produk SET ID_TAMPIL_PRODUK='$id_produk', GBR_FILE_NAME='$uniq.$ekstensi' WHERE GBR_ID='$id_produk_gambar'");
                if($query){
                    header("location:../master_produk_gambar.php?pesan=sukses_edit");
                    
                    // $path = "C:\\xampp\htdocs\GolonganD_Kelompok6\CAP\pictures\produk_desain";
                    // exec("EXPLORER /E,$path");
                }else{
                    header("location:../master_produk_gambar.php?pesan=gagal_edit");
                }
        }else{
            header("location:../master_produk_gambar.php?pesan=ukuran_besar");
        }
    }else{
        header("location:../master_produk_gambar.php?pesan=ekstensi_salah");
    }
}
}

if(isset($_POST['tambah_gambar_produk'])){
$id_produk = $_POST['id_produk'];

$data = mysqli_query($con, "select GBR_ID from gambar_produk ORDER BY GBR_ID DESC LIMIT 1");
while($data_gambar = mysqli_fetch_array($data))
{
    $gbr_id = $data_gambar['GBR_ID'];
}

$row = mysqli_num_rows($data);
if($row>0){
    $id_gambar = autonumber($gbr_id, 3, 6);
}else{
    $id_gambar = 'GBR000001';
}

$ekstensi_boleh = array('png','jpg','jpeg'); //ekstensi file yang boleh diupload
$nama = $_FILES['gambar_produk']['name']; //menunjukkan letak dan nama file yang akan di upload
$ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
$ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
$ukuran = $_FILES['gambar_produk']['size']; //untuk mendapatkan ukuran file yang diupload
$file_temporary = $_FILES['gambar_produk']['tmp_name']; //untuk mendapatkan temporary file yang di upload
    if(in_array($ekstensi,$ekstensi_boleh)===true){
        if($ukuran < 3132210  && $ukuran != 0){ 
            $id = rand(0,100);
            $uniq = uniqid($id,true);
            move_uploaded_file($file_temporary, '../../pictures/produk_thumb/'.$uniq.'.'.$ekstensi); //untuk upload file
            // $query = mysqli_query ($koneksi, "SELECT * FROM user");
            $query = mysqli_query ($con, "INSERT INTO gambar_produk VALUES('$id_gambar','$id_produk','$uniq.$ekstensi')");
            if($query){
                header("location:../master_produk_gambar.php?pesan=sukses_edit");
            }else{
                header("location:../master_produk_gambar.php?pesan=gagal_edit");
            }
        }else{
            header("location:../master_produk_gambar.php?pesan=ukuran_besar");
        }
    }else{
        header("location:../master_produk_gambar.php?pesan=ekstensi_salah");
    }
}