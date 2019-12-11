<?php
include 'includes/config.php';

if(isset($_POST['pemesanan_produk'])){

    $id_user = $_POST['id_user'];
    $id_produk = $_POST['id_produk'];

    
    $id_warna = $_POST['pilihwarnaa'];
    $id_bahan = $_POST['pilihbahan'];
    $id_ukuran = $_POST['pilihukuran'];
    $nama_produk = $_POST['nama_produk'];
    $status_desain = $_POST['pilihdesain'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $ket_pembayaran = $_POST['ket_pembayaran'];
    $sub_total = $_POST['sub_total'];
    $total = $_POST['total'];
    $id_bank = $_POST['pilihbank'];


$data = mysqli_query($con, "select ID_PRODUK from produk ORDER BY ID_PRODUK DESC LIMIT 1");
    while($produk_data = mysqli_fetch_array($data))
    {
        $prd_id = $produk_data['ID_PRODUK'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_produk = autonumber($prd_id, 3, 6);
    }else{
      $id_produk = 'PRD000001';
    }

$produk = mysqli_query($con, "INSERT INTO produk 
    VALUES('$id_produk','$id_ukuran','$id_bahan','$id_warna','$nama_produk')");

$data = mysqli_query($con, "select ID_PESANAN from pesanan ORDER BY ID_PESANAN DESC LIMIT 1");
    while($pesanan_data = mysqli_fetch_array($data))
    {
        $psn_id = $pesanan_data['ID_PESANAN'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_pesanan = autonumber($psn_id, 3, 6);
    }else{
      $id_pesanan = 'PSN000001';
    }

    $date = date("Y-m-d");
    $time = date("h:i:sa");

$pesanan = mysqli_query($con, "INSERT INTO pesanan 
    VALUES('$id_pesanan','ADM000001','$id_user','$date $time','$total','1',NULL,'$ket_pembayaran')");

$detail_pesanan = mysqli_query($con, "INSERT INTO detail_pesanan 
    VALUES('$id_produk','$id_pesanan','$jumlah_produk','$sub_total',NULL,'$status_desain')");

if($detail_pesanan > 0){
  header("location:verif_pembayaran.php?id_pesanan=$id_pesana&id_bank=$id_bank");
}else{
  echo "detail_pesanan gagal";
}

    // $ekstensi_boleh = array('zip','rar','pdf'); //ekstensi file yang boleh diupload
    // $desain = $_FILES['desain']['name']; //menunjukkan letak dan desain file yang akan di upload
    // $ex = explode ('.',$desain); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    // $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    // $ukuran = $_FILES['desain']['size']; //untuk mendapatkan ukuran file yang diupload
    // $file_temporary = $_FILES['desain']['tmp_name']; //untuk mendapatkan temporary file yang di upload
    //     if(in_array($ekstensi, $ekstensi_boleh)===true){
    //         if($ukuran < 31322100){ 
    //             move_uploaded_file($file_temporary, 'pictures/desain_pesanan/'.$desain); //untuk upload file
    //             // $query = mysqli_query ($koneksi, "SELECT * FROM user");
    //                 $detail_pesanan = mysqli_query($con, "INSERT INTO detail_pesanan 
    //                 VALUES('$id_produk','$id_pesanan','$jumlah_produk','$sub_total','$desain','$status_desain')");
    //                 if($detail_pesanan){
    //                     // header("location:keranjang.php");
    //                 }else{
    //                     echo "MAAF...., UPLOAD GAGAL";
    //                 }
    //         }else{
    //             echo "UKURAN FILE TERLALU BESAR";
    //         }
    //     }else{
    //         echo "FILE TIDAK SESUAI DENGAN EKSTENSI YANG DIBERIKAN";
    //     }



}
?>