<?php

    session_start();

    include 'config.php';

    $username = $_POST['username-user'];
    $password = md5($_POST['password-user']);

    $data = mysqli_query($koneksi, "select * from user where USER_USERNAME='$username' and USER_PASSWORD='$password'");

    $row = mysqli_num_rows($data);

    if($row > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location:index.php");
    }else{
        header("location:index.php?pesan=gagal");
    }

?>