<?php 
include 'includes/config.php';

if($_POST['post_cover_admin']) {
    $id_admin = $_POST['id_admin'];
    $ekstensi_boleh = array('png','jpg','jpeg','JPG','PNG','JPEG'); //ekstensi file yang boleh diupload
    $nama = $_FILES['file']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['file']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['file']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 3132210 && $ukuran != 0){ 
                $resultadm = mysqli_query($con, "SELECT * FROM admin WHERE ADM_ID = '$id_admin'");
                $dataadm = mysqli_fetch_assoc($resultadm);
                $coveradm = $dataadm['ADM_COVER'];
                if($coveradm != 'betak.jpg'){
                    unlink('../pictures/admin_cover/'.$coveradm);
                }

                $id = rand(0,100);
                $uniq = uniqid($id,true);
                move_uploaded_file($file_temporary, '../pictures/admin_cover/'.$uniq.'.'.$ekstensi); //untuk upload file
                $query = mysqli_query ($con, "UPDATE admin SET ADM_COVER ='$uniq.$ekstensi' WHERE ADM_ID ='$id_admin'");
                    if($query) {
                        header("location:admin_profil.php?pesan=sukses_upload");
                    }else{
                        header("location:admin_profil.php?pesan=gagal_upload");
                    }
            }else{
                header("location:admin_profil.php?pesan=ukuran_besar");
            }
        }else{
            header("location:admin_profil.php?pesan=ekstensi_salah");
        }
}

?>