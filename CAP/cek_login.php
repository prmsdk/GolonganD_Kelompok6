<?php

    session_start();

    include 'includes/config.php';

    $username = $_POST['username-user'];
    $password = md5($_POST['password-user']);
    var_dump($username);

    $data = mysqli_query($con, "select * from user where USER_USERNAME='$username' and USER_PASSWORD='$password'");

    $row = mysqli_num_rows($data);

    if($row > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status'] = 'login';
        header("location:index.php?pesan=loginberhasil");
    }else{
        header("location:index.php?pesan=gagal");
    }

?>