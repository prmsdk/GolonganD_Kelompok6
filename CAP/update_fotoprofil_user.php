<?php
include 'includes/config.php'; //mengoneksikan dengan database

if($_POST['post_profile']) {
    $id_user = $_POST['id_user'];
    $ekstensi_boleh = array('png','jpg','jpeg'); //ekstensi file yang boleh diupload
    $nama = $_FILES['file']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['file']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['file']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 3132210 && $ukuran != 0){ 
                $id = rand(0,100);
                $uniq = uniqid($id,true);
                move_uploaded_file($file_temporary, 'file_upload/'.$uniq.'.'.$ekstensi); //untuk upload file
                // $query = mysqli_query ($con, "SELECT * FROM user");
                $query = mysqli_query ($con, "UPDATE user SET USER_PROFIL='$uniq.$ekstensi' WHERE USER_ID='$id_user'");
                    if($query) {
                        header("location:user_profil.php?id_user=$id_user");
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

?>