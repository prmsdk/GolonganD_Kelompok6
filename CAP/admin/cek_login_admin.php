<?php

    session_start();

    include 'includes/config.php';

    $username = $_POST['username-admin'];
    $password = md5($_POST['password-admin']);

    $data = mysqli_query($con, "select * from admin where ADM_USERNAME='$username' and ADM_PASSWORD='$password'");
    $data_admin = mysqli_fetch_assoc($data);
    $status_admin = $data_admin['ADM_STATUS'];
    $row = mysqli_num_rows($data);

    if($row > 0){
        $_SESSION['username'] = $username;
        $_SESSION['admin_login'] = 'login';
        $_SESSION['admin_status'] = $status_admin;
        header("location:index.php?pesan=loginberhasil");
    }else{
        header("location:index.php?pesan=gagal");
    }

?>