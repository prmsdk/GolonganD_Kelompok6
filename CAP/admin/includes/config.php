<?php
    define('DB_HOST', 'localhost');
    define('DB_USER','root');
    define('DB_PASS' ,'');
    define('DB_NAME', 'db_cap');
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    function autonumber($id_terakhir, $panjang_kode, $panjang_angka) {

    // mengambil nilai kode ex: USR0015 hasil USR
    $kode = substr($id_terakhir, 0, $panjang_kode);
    
    // mengambil nilai angka
    // ex: USR0015 hasilnya 0015
    $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
    
    // menambahkan nilai angka dengan 1
    // kemudian memberikan string 0 agar panjang string angka menjadi 4
    // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
    // sehingga menjadi 0006
    $angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
    
    // menggabungkan kode dengan nilang angka baru
    $id_baru = $kode.$angka_baru;
    
    return $id_baru;
    }
?>
