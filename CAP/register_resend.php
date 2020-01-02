<?php

  include 'includes/config.php';
  include 'api_key.php';
  
  require 'C:\xampp\sendgrid\vendor\autoload.php';

  session_start();
  if(isset($_SESSION['id_user'])){
    $usr_id = $_SESSION['id_user'];

    $data = mysqli_query($con, "select * from user where USER_ID='$usr_id'");
    while($user_data = mysqli_fetch_array($data)){
      $nama_user = $user_data['USER_NAMA_LENGKAP'];
      $email_user = $user_data['USER_EMAIL'];
      $usename_user = $user_data['USER_USERNAME'];
      $hash = $user_data['USER_HASH'];
    }

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

        header("location:register_success.php?pesan=Email berhasi dikirim ulang!&status=success");

  }else if(isset($_POST['email_user'])){
    
    $email_user = $_POST['email_user'];

    $our_email = 'dickayunia1@gmail.com';
    $data = mysqli_query($con, "select USER_HASH, USER_NAMA_LENGKAP from user where USER_EMAIL = '$email_user' OR USER_USERNAME='$email_user'");
    while($user_data = mysqli_fetch_array($data)){
      $hash = $user_data['USER_HASH'];
      $nama_user = $user_data['USER_NAMA_LENGKAP'];
    }
    
        date_default_timezone_set('Asia/Jakarta');
        ini_set('date.timezone', 'Asia/Jakarta');
    
        // $dotenv = new Dotenv\Dotenv(__DIR__);
        // $dotenv->load();
    
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom($our_email, 'Cahaya Abadi Perkasa');
        $email->setSubject('Reset Password');
        $email->addTo($email_user, $nama_user);
        $message = '
    
        Selamat '.$nama_user.'! Akun anda dapat dipulihkan.
        Pesan ini dikirimkan untuk membantu anda mengatur ulang password anda.
        
        Mohon klik tautan dibawah ini untuk melanjutkan proses pengaturan ulang Password Anda :
        http://localhost/GolonganD_Kelompok6/CAP/reset_password.php?email='.$email_user.'&hash='.$hash.'
    
        Dimohon untuk tidak memberikan link diatas kepada siapapun karena bersifat privasi bagi Anda.
        
        ';
        $email->addContent("text/plain", "$message");
        $email->addContent(
            "text/html", "<p>$message<p>"
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

    header("location:forgot_password.php?pesan=Email berhasi dikirim ulang!&status=success");
  }else{
    echo '
    <div class="container container-fluid-lg">
      <div class="row justify-content-center regis-success">
        <div class="col-lg-12 my-5 text-center my-auto">
          <h1>Error 404 </h1>
          <form action=""></form>
        </div>
      </div>
    </div>
    ';
  }