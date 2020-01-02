<?php
session_start();
include 'api_key.php';
require 'C:\xampp\sendgrid\vendor\autoload.php';
include 'includes/config.php';

if(isset($_GET['id_nego'])){
  $id_nego = $_GET['id_nego'];
  $delete = mysqli_query($con, "DELETE FROM nego WHERE ID_NEGO = '$id_nego'");
  if($delete){
    header("location:nego_user.php?pesan=sukses_delete");
  }else{
    header("location:nego_user.php?pesan=gagal_delete");
  }
}

if(isset($_POST['nego_pembayaran'])){
  $id_user = $_POST['id_user'];
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $id_ukuran = $_POST['pilihukuran'];
  $id_warna = $_POST['pilihwarna'];
  $id_bahan = $_POST['pilihbahan'];
  $status_desain = $_POST['pilihdesain'];
  $nama_desain = $_POST['namadesain'];
  $ket_pembayaran = $_POST['ket_pembayaran'];
  $isi_produk = $_POST['isibahan'];
  $catatan = $_POST['catatan'];
  $jumlah_produk = $_POST['jumlah_produk'];
  $sub_total = $_POST['sub_total'];
  $total = $_POST['sub_total'];
  $id_bank = $_POST['pilihbank'];
  $id_nego = $_POST['id_nego'];

  // PESANAN ==================

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

    VALUES('$id_pesanan','ADM000001','$id_user','$id_bank','$date $time','$total','1',NULL,0,0,0)");

    if($pesanan){
      echo"berhasil menambah pesanan <br>";
    }else{
      echo"gagal menambah pesanan <br>";
    }

  // PRODUK =====================

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

  if($produk){
    echo"berhasil menambah produk <br>";
  }else{
    echo"gagal menambah produk <br>";
  }

  $detail_pesanan = mysqli_query($con, "INSERT INTO detail_pesanan 
  VALUES('$id_produk','$id_pesanan','$jumlah_produk','$sub_total','$nama_desain','$status_desain','$isi_produk','$ket_pembayaran','$catatan')");

  if($detail_pesanan){
    $query_update = mysqli_query($con, "UPDATE nego SET NEGO_STATUS = 3 WHERE ID_NEGO = '$id_nego'");
    header("location:verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank");
    echo"berhasil menambah detail pesanan <br>";
  }else{
    header("location:nego_pembayaran.php?id_nego=$id_nego");
    echo"gagal menambah detail pesanan <br>";
  }

  $our_email = 'dickayunia1@gmail.com';

  $result_user = mysqli_query($con, "SELECT * FROM user WHERE USER_ID = '$id_user'");
  $data_user = mysqli_fetch_assoc($result_user);
  $user_email = $data_user['USER_EMAIL'];
  $user_nama = $data_user['USER_NAMA_LENGKAP'];

  $result_bank = mysqli_query($con, "SELECT * FROM rekening_bank WHERE ID_REKENING = '$id_bank'");
  $data_bank = mysqli_fetch_assoc($result_bank);
  $nama_bank = $data_bank['NAMA_REKENING'];
  $nomor_bank = $data_bank['NOMOR_REKENING'];
  $atas_nama = $data_bank['ATAS_NAMA'];

  date_default_timezone_set('Asia/Jakarta');
  ini_set('date.timezone', 'Asia/Jakarta');

  // $dotenv = new Dotenv\Dotenv(__DIR__);
  // $dotenv->load();
  $for = '';
  
  // PERULANGAN DETAIL PESANAN
  for($j = 0; $j < 1; $j++){
    $for.= '<tr>
        <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
            <!-- TWO COLUMNS -->
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td valign="top" class="mobile-wrapper">
                        <!-- LEFT COLUMN -->
                        <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                            <tr>
                                <td style="padding: 0 0 10px 0;">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">'.$nama_produk.' ('.$jumlah_produk.')</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!-- RIGHT COLUMN -->
                        <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                            <tr>
                                <td style="padding: 0 0 10px 0;">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td align="right" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Rp. '.number_format($sub_total, 0,".",".").'</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>';
    }
                    // END PERULANGAN

  

  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom($our_email, 'Cahaya Abadi Perkasa');
  $email->setSubject('Pesanan Diterima');
  $email->addTo($user_email, $user_nama);
  // $email->addContent("text/plain", "$message");
  $message = '';
  include 'verif_pembayaran_email.php';
  $email->addContent(
      "text/html", $message
  );
  // $sendgrid = new \SendGrid(getenv(SENDGRID_API_KEY));
  // $apiKey = getenv('SENDGRID_API_KEY');
  // $sendgrid = new \SendGrid($apiKey);
  $apiKey = SENDGRID_API_KEY;
  $sendgrid = new \SendGrid($apiKey);
  try {
      $response = $sendgrid->send($email);
      print $response->statusCode() . "\n";
      print_r($response->headers());
      print $response->body() . "\n";
  } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
  }
}