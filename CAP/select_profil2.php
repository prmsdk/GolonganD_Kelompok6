<?php
require 'koneksi.php';

// if(isset($_POST)['post_profile']){
$result = mysqli_query($koneksi, "SELECT * FROM user");
// var_dump ($result);
// }else{
//     echo $result;
// }
// // WHILE ($user = mysqli_fetch_assoC($result)) { //mengembalikan array numerik
// var_dump($user);
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ambil Data</title>
</head>
<body>
    <table border="1" cellpadding="10" cellspacing="10">
        <tr>
            <th>NO</th>
            <th>USER ID</th>
            <th>AKSI</th>
            <th>NAMA LENGKAP</th>
            <th>EMAIL</th>
            <th>NO HP</th>
            <th>ALAMAT</th>
            <th>PROFIL</th>
            <th>COVER</th>
            <th>USER NAMA</th>
        </tr>
        <?php  WHILE ($user = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td>1</td>
            <td>
                <a href="#">Edit</a>
            </td>
            <td><?= $user["USER_ID"]; ?></td>
            <td><?= $user["USER_NAMA_LENGKAP"]; ?></td>
            <td><?= $user["USER_EMAIL"]; ?></td>
            <td><?=$user["USER_NO_HP"]; ?></td>
            <td><?=$user["USER_ALAMAT"]; ?></td>
            <td><img src="<?php echo $user ["USER_PROFIL"] ?>" alt="foto"></td>
            <td><img src="<?php echo $user ["USER_COVER"] ?>" alt="foto"></td>
            <td>dyta</td>
        </tr>
        <?php endwhile ; ?>

    </table>
    
</body>
</html>