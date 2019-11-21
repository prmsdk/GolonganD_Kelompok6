<?php 
include 'koneksi.php';

if($_POST['post_cover_admin']) {
    $id_admin = $_POST['id_admin'];
    $ekstensi_boleh = array('png','jpg','jpeg'); //ekstensi file yang boleh diupload
    $nama = $_FILES['file']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['file']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['file']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 3132210){ 
                move_uploaded_file($file_temporary, 'file_upload/'.$nama); //untuk upload file
                $query = mysqli_query ($koneksi, "UPDATE admin SET ADM_COVER ='$nama' WHERE ADM_ID ='$id_admin'");
                    if($query) {
                       header("location:admin_profil.php?id_admin=$id_admin");
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