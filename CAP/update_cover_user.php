<?php 
require 'includes/config.php';

if($_POST['post_cover']) {
    $id_user = $_POST['id_user'];
    $ekstensi_boleh = array('png','jpg','jpeg'); //ekstensi file yang boleh diupload
    $nama = $_FILES['file']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['file']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['file']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 3132210 && $ukuran != 0){ 
                $resultuser = mysqli_query($con, "SELECT * FROM user WHERE USER_ID = '$id_user'");
                $datauser = mysqli_fetch_assoc($resultuser);
                $coveruser = $datauser['USER_COVER'];
                if($coveruser != 'betak.jpg'){
                    unlink('pictures/user_cover/'.$coveruser);
                }

                $id = rand(0,100);
                $uniq = uniqid($id,true);
                move_uploaded_file($file_temporary, 'pictures/user_cover/'.$uniq.'.'.$ekstensi); //untuk upload file
                $query = mysqli_query ($con, "UPDATE user SET USER_COVER='$uniq.$ekstensi' WHERE USER_ID='$id_user'");
                    if($query) {
                        header("location:user_profil.php?pesan=sukses_upload");
                    }else{
                        header("location:user_profil.php?pesan=gagal_upload");
                    }
            }else{
                header("location:user_profil.php?pesan=ukuran_besar");
            }
        }else{
            header("location:user_profil.php?pesan=ekstensi_salah");
        }
}

?>