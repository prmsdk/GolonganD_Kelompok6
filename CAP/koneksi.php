<?php
$koneksi = mysqli_connect("localhost","root","","db_cap_coba");

// Untuk cek koneksi
if (mysqli_connect_errno()) {
   echo "Gagal Terhubung ke Database". mysqli_connect_error();
} else {
   echo "Berhasil Terkoneksi ke Database";
}

?>