<?php
require 'includes/config.php';

if($_POST['edit_profil_user']){
    $id_user = $_POST['id_user'];
    $nama_user = $_POST['nama_user'];
    $email_user = $_POST['email_user'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];

    $query = mysqli_query($con, "UPDATE user SET 
    USER_NAMA_LENGKAP ='$nama_user', 
    USER_EMAIL = '$email_user', 
    USER_NO_HP = '$no_hp', 
    USER_ALAMAT = '$alamat',
    USER_USERNAME = '$username' where USER_ID = '$id_user'");

    if($query){
        header("location:user_profil.php?id_user=$id_user");
    }
    
}


?>