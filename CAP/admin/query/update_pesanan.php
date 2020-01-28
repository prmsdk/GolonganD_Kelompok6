<?php
session_start();
include '../../api_key.php';

require 'C:\xampp\sendgrid\vendor\autoload.php';
include '../includes/config.php';
if(isset($_GET['status']) AND isset($_GET['id_pesanan'])){
  $status = $_GET['status'];
  $id_pesanan = $_GET['id_pesanan'];

  if($status == 2){
    $update = mysqli_query($con, "UPDATE pesanan SET STATUS_PESANAN = 3,
    USER_NOTIF = 0  WHERE ID_PESANAN = '$id_pesanan'");

    if($update){
      header("location:../trs_history_admin.php");
    }
  }else if($status == 3){
    $update = mysqli_query($con, "UPDATE pesanan SET STATUS_PESANAN = 4,
    USER_NOTIF = 0  WHERE ID_PESANAN = '$id_pesanan'");

    if($update){
      header("location:../trs_history_admin.php");
    }
  }else if($status == 4){
    $update = mysqli_query($con, "UPDATE pesanan SET STATUS_PESANAN = 5,
    USER_NOTIF = 0  WHERE ID_PESANAN = '$id_pesanan'");

    // MENGIRIM EMAIL SELESAI
    if($update){

      $result_pesanan = mysqli_query($con, "SELECT * FROM pesanan WHERE ID_PESANAN = '$id_pesanan'");
      $data_pesanan = mysqli_fetch_assoc($result_pesanan);
      $id_user = $data_pesanan['USER_ID'];

      $result_user = mysqli_query($con, "SELECT * FROM user WHERE USER_ID = '$id_user'");
      $data_user = mysqli_fetch_assoc($result_user);
      $user_email = $data_user['USER_EMAIL'];
      $user_alamat = $data_user['USER_ALAMAT'];
      $user_nama = $data_user['USER_NAMA_LENGKAP'];

      $our_email = 'dickayunia1@gmail.com';

      date_default_timezone_set('Asia/Jakarta');
      ini_set('date.timezone', 'Asia/Jakarta');

      // $dotenv = new Dotenv\Dotenv(__DIR__);
      // $dotenv->load();

      $email = new \SendGrid\Mail\Mail(); 
      $email->setFrom($our_email, 'Cahaya Abadi Perkasa');
      $email->setSubject('Pesanan Anda Telah Selesai');
      $email->addTo($user_email, $user_nama);
      // $email->addContent("text/plain", "$message");
      $message = '';
      require 'update_pesanan_email.php';
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
      print_r($email_user);
      header("location:../trs_history_admin.php");
    }
  }else if($status == 1){
    if($_GET['param']==7){
      $resultbuktitf = mysqli_query($con, "SELECT * FROM pesanan WHERE ID_PESANAN ='$id_pesanan'");
      $databuktitf = mysqli_fetch_assoc($resultbuktitf);
      $namabuktitf = $databuktitf['BUKTI_TRANSFER'];
      unlink('../../pictures/bukti_transfer/'.$namabuktitf);

      $update = mysqli_query($con, "UPDATE pesanan 
      SET STATUS_PESANAN = 7,
      BUKTI_TRANSFER = NULL,
      USER_NOTIF = 0 
      WHERE ID_PESANAN = '$id_pesanan'");
      
      if($update){
        header("location:../trs_detail_pesanan_admin.php?id_pesanan=$id_pesanan");
      }

    }else if($_GET['param']==8){
      $resultbuktitf = mysqli_query($con, "SELECT * FROM pesanan WHERE ID_PESANAN ='$id_pesanan'");
      $databuktitf = mysqli_fetch_assoc($resultbuktitf);
      $namabuktitf = $databuktitf['BUKTI_TRANSFER'];
      unlink('../../pictures/bukti_transfer/'.$namabuktitf);
      
      $update = mysqli_query($con, "UPDATE pesanan 
      SET STATUS_PESANAN = 8,
      BUKTI_TRANSFER = NULL,
      USER_NOTIF = 0 
      WHERE ID_PESANAN = '$id_pesanan'");

      if($update){
        header("location:../trs_detail_pesanan_admin.php?id_pesanan=$id_pesanan");
      }
    }
  }
}

if(isset($_POST['masukkan_antrian'])){
  $antrian = $_POST['antrian'];
  $id_admin = $_SESSION['id_admin'];
  $id_pesanan = $_POST['id_pesanan'];

  $result_antrian = mysqli_query($con, "UPDATE pesanan SET
  ADM_ID = '$id_admin', ANTRIAN = '$antrian', STATUS_PESANAN = 2 WHERE ID_PESANAN = '$id_pesanan'");

  if($result_antrian){
    header("location:../trs_history_admin.php");
  }
}