<?php

include 'includes/config.php';

if(isset($_POST['verif_pembayaran'])){

    $id_pesanan = $_POST['id_pesanan'];
    $id_bank = $_POST['id_bank'];
    $ekstensi_boleh = array('png','jpg','jpeg','PNG','JPG','JPEG'); //ekstensi file yang boleh diupload
    $nama = $_FILES['file']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['file']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['file']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 10132210 && $ukuran != 0){ 
                $id = rand(0,100);
                $uniq = uniqid($id,true);
                move_uploaded_file($file_temporary, 'pictures/bukti_transfer/'.$uniq.'.'.$ekstensi); //untuk upload file
                // $query = mysqli_query ($con, "SELECT * FROM user");
                $query = mysqli_query ($con, "UPDATE pesanan SET BUKTI_TRANSFER='$uniq.$ekstensi' WHERE ID_PESANAN='$id_pesanan'");
                    if($query) {
                        header("location:history_user.php");
                    }else{
                        header("location:verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank");
                    }
            }else{
                header("location:verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank");
            }
        }else{
            header("location:verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank");
        }
}