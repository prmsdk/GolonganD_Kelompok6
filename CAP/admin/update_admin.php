<?php
require 'includes/config.php';

if($_POST['edit_profil_admin']){
    $id_admin = $_POST['id_admin'];
    $nama_admin = $_POST['nama_admin'];
    $email_admin = $_POST['email_admin'];
    $no_hp = $_POST['no_hp'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $desc = $_POST['adm_desc'];
    $adminname = $_POST['adminname'];

    $query = mysqli_query($con, "UPDATE admin SET 
    ADM_NAMA_USAHA_ADM ='$nama_admin', 
    ADM_EMAIL = '$email_admin', 
    ADM_NO_HP = '$no_hp', 
    ADM_NO_TELP = '$no_telp',
    ADM_ALAMAT = '$alamat',
    ADM_DESC = '$desc',
    ADM_USERNAME = '$adminname' 
    where ADM_ID = '$id_admin'");

    if($query){
        header("location:admin_profil.php?pesan=sukses_update");
    }else{
        header("location:admin_profil.php?pesan=gagal_update");
    }
    
    
}


?>