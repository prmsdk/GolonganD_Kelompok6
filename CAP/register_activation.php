<?php

session_start();

include 'includes/config.php';
include 'api_key.php';

require 'C:\xampp\sendgrid\vendor\autoload.php';

if(isset($_SESSION['id_user'])){

  $id_user = $_SESSION['id_user'];
  $query = mysqli_query ($con, "SELECT * FROM user  WHERE USER_ID = '$id_user'");
  // var_dump($query);
  $result = mysqli_fetch_assoc($query);
  $nama_user = $result['USER_NAMA_LENGKAP'];
  $email_user = $result['USER_EMAIL'];
  $username_user = $result['USER_USERNAME'];
  $hash = $result['USER_HASH'];

  $our_email = 'cahayaabadiperkasa@gmail.com';
    
  date_default_timezone_set('Asia/Jakarta');
  ini_set('date.timezone', 'Asia/Jakarta');

  // $dotenv = new Dotenv\Dotenv(__DIR__);
  // $dotenv->load();
  $subject = 'Activasi | Verifikasi';
  $pesan = 'Silahkan cocokkan data diri yang kamu daftarkan dengan data yang kami terima dibawah,<br> 
  Mohon aktivasi akun anda untuk memaksimalkan fitur dari aplikasi kami.';
  $link = 'http://localhost/GolonganD_Kelompok6/CAP/register_verify.php?email='.$email_user.'&hash='.$hash;

  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom($our_email, 'Cahaya Abadi Perkasa');
  $email->setSubject($subject);
  $email->addTo($email_user, $nama_user);
  $message = '';
  include 'register_activation_email.php';
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
      echo "berhasil";
  } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
  }
  print_r($email_user);

}