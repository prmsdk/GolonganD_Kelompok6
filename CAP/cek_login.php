<?php
    // Memulai session
    session_start();

    // Memanggil koneksi (dari folder includes)
    include 'includes/config.php';

    // merekam value dari post modal login
    $username = $_POST['username-user'];
    $password = md5($_POST['password-user']);
    var_dump($username);

    if(substr($username, 0, 1) != '@'){
        $data = mysqli_query($con, "select * from admin where ADM_USERNAME='$username' and ADM_PASSWORD='$password'");
        $data_admin = mysqli_fetch_assoc($data);
        $status_admin = $data_admin['ADM_STATUS'];
        $id_admin = $data_admin['ADM_ID'];
        $row = mysqli_num_rows($data);

        if($row > 0){
            $_SESSION['username'] = $username;
            $_SESSION['admin_login'] = 'login';
            $_SESSION['admin_status'] = $status_admin;
            $_SESSION['id_admin'] = $id_admin;
            header("location:admin/index.php?pesan=loginberhasil");
        }else{
            header("location:index.php?pesan=gagal");
        }
    }else{
        $data = mysqli_query($con, "select * from user where USER_USERNAME='$username' and USER_PASSWORD='$password'");
        $data_user = mysqli_fetch_assoc($data);
        $id_user = $data_user['USER_ID'];

        $row = mysqli_num_rows($data);

        if($row > 0){
            $_SESSION['id_user'] = $id_user;
            $_SESSION['username'] = $username;
            $_SESSION['status'] = 'login';
            header("location:index.php?pesan=loginberhasil");
        }else{
            header("location:index.php?pesan=gagal");
        }
    }


?>