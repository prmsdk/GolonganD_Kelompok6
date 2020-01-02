<?php

  // MEMVALIDASI DATA MASUKAN
  session_start();

  include 'includes/config.php';
  include 'api_key.php';
  
  require 'C:\xampp\sendgrid\vendor\autoload.php';

    $nama_user = $_POST['nama_user'];
    $email_user = $_POST['email_user'];
    $no_hp_user = $_POST['no_hp_user'];
    $username_user = '@'.$_POST['username_user'];
    $password_user = $_POST['password_user'];
    $repassword_user = $_POST['repassword_user'];
    $hash = md5( rand(0,1000) );
    
    $data = mysqli_query($con, "select USER_ID from user ORDER BY USER_ID DESC LIMIT 1");
    while($user_data = mysqli_fetch_array($data))
    {
        $usr_id = $user_data['USER_ID'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_user = autonumber($usr_id, 3, 6);
    }else{
      $id_user = 'USR000001';
    }
    
    // VALIDASI RE-TYPE PASSWORD

    if($password_user == $repassword_user){
      $password_user = md5($repassword_user);

      $result = mysqli_query($con, "INSERT INTO user(USER_ID, USER_NAMA_LENGKAP, USER_EMAIL, USER_NO_HP, USER_USERNAME, USER_PASSWORD, USER_HASH) VALUES('$id_user','$nama_user','$email_user','$no_hp_user','$usename_user','$password_user','$hash')");
      
      $_SESSION['id_user'] = $id_user;

      if($result){
        $our_email = 'dickayunia1@gmail.com';
    
        date_default_timezone_set('Asia/Jakarta');
        ini_set('date.timezone', 'Asia/Jakarta');
    
        // $dotenv = new Dotenv\Dotenv(__DIR__);
        // $dotenv->load();
        $subject = 'Pendaftaran | Verifikasi';
        $pesan = 'Terimakasih telah mendaftar dan bergabung dengan kami!<br>
        Silahkan cocokkan data diri yang kamu daftarkan dengan data yang kami terima dibawah,<br> 
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
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
        print_r($email_user);
    
        header("location:register_success.php?pesan=Anda berhasil mendaftar!&status=success");
      }

    }else{
      header("location:register_user.php?pesan=Validasi Password anda!&status=danger");
    }


    // QUERY INSERT PENDAFTARAN

    

