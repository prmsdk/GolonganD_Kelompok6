<?php

include 'includes/config.php';
require 'includes/header.php';

if(isset($_POST['pemesanan_produk'])){

    $id_user = $_POST['id_user'];
    $id_produk = $_POST['id_produk'];

    $id_warna = $_POST['pilihwarnaa'];
    $id_bahan = $_POST['pilihbahan'];
    $id_ukuran = $_POST['pilihukuran'];
    $nama_produk = $_POST['nama_produk'];
    $status_desain = $_POST['pilihdesain'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $namadesain = $_POST['namadesain'];

    $ket_pembayaran = $_POST['ket_pembayaran'];
    $sub_total = $_POST['sub_total'];
    $total = $_POST['total'];
    $id_bank = $_POST['pilihbank'];

    
    $number = count($_POST["id_produk"]);

    // ============ PESANAN =================

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

        ini_set('date.timezone', 'Asia/Jakarta');

        $date = date("Y-m-d");
        $time = date("H:i:s");

    $pesanan = mysqli_query($con, "INSERT INTO pesanan 

    VALUES('$id_pesanan','ADM000001','$id_user','$date $time','$total','1',NULL,'$ket_pembayaran',0,0)");

    if($pesanan){
      echo"berhasil menambah pesanan <br>";
    }else{
      echo"gagal menambah pesanan <br>";
    }

    // PENGULANGAN PRODUK DAN DETAIL ===============

    if ($number >= 1){
      for ($i = 0; $i < $number; $i++){

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

        var_dump($id_produk);
        $id_ukn = $id_ukuran[$i];
        $id_bhn = $id_bahan[$i];
        $id_wrn = $id_warna[$i];
        $nama_prd = $nama_produk[$i];
        
        $produk = mysqli_query($con, "INSERT INTO produk 
        VALUES('$id_produk','$id_ukn','$id_bhn','$id_wrn','$nama_prd')");

        if($produk){
          echo"berhasil menambah produk <br>";
        }else{
          echo"gagal menambah produk <br>";
        }

        // DETAIL PESANAN ============================ DETAIL PESANAN

        $jml_prd = $jumlah_produk[$i];
        $nama_dsn = $namadesain[$i];
        $sub_ttl = $sub_total[$i];
        $stts_dsn= $status_desain[$i];

        $detail_pesanan = mysqli_query($con, "INSERT INTO detail_pesanan 
        VALUES('$id_produk','$id_pesanan','$jml_prd','$sub_ttl','$nama_dsn','$stts_dsn')");

        if($detail_pesanan){
          echo"berhasil menambah detail pesanan <br>";
        }else{
          echo"gagal menambah detail pesanan <br>";
        }
        
      }
    }

    

    


  echo "<button type='button' id='clear-cart' class='clear-cart'></button>";
  echo '<button onclick="window.location.href = '."'http://localhost/GolonganD_Kelompok6/CAP/verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank'".';" id="verif_pembayaran">Home</button>';
  // header("location:verif_pembayaran.php?id_pesanan=$id_pesana&id_bank=$id_bank");

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



    require 'includes/footer.php';
}
?>