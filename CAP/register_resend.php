<?php

  include 'includes/config.php';
  session_start();
  if(isset($_SESSION['id_user'])){
    $usr_id = $_SESSION['id_user'];

    $data = mysqli_query($con, "select * from user where USER_IDN='$usr_id'");
    while($user_data = mysqli_fetch_array($data)){
      $nama_user = $user_data['USER_NAMA_LENGKAP'];
      $email_user = $user_data['USER_EMAIL'];
      $usename_user = $user_data['USER_USERNAME'];
      $hash = $user_data['USER_HASH'];
    }

    $to      = $email_user; // Send email to our user
    $subject = 'Signup | Verification'; // Give the email a subject 
    $message = '
    
    Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
    
    ------------------------
    Your Name        : '.$nama_user.'
    Your Username : '.$usename_user.'
    ------------------------
    
    Please click this link to activate your account:
    http://localhost/GolonganD_Kelompok6/CAP/register_verify.php?execute=activate&email='.$email_user.'&hash='.$hash.'
    
    '; // Our message above including the link
                        
    $headers = 'From:dickayunia1@gmail.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email

    header("location:register_success.php?pesan=Email berhasi dikirim ulang!&status=success");
  }else if(isset($_POST['email_user'])){
    $email_user = $_POST['email_user'];

    $data = mysqli_query($con, "select USER_HASH, USER_NAMA_LENGKAP from user where USER_EMAIL = '$email_user' OR USER_USERNAME='$email_user'");
    while($user_data = mysqli_fetch_array($data)){
      $hash = $user_data['USER_HASH'];
      $nama_user = $user_data['USER_NAMA_LENGKAP'];
    }

    $to      = $email_user; // Send email to our user
    $subject = 'Reset Password'; // Give the email a subject 
    $message = '
    
    Selamat '.$nama_user.'! Akun anda dapat dipulihkan.
    Pesan ini dikirimkan untuk membantu anda mengatur ulang password anda.
    
    Mohon klik tautan dibawah ini untuk melanjutkan proses pengaturan ulang Password Anda :
    http://localhost/GolonganD_Kelompok6/CAP/reset_password.php?email='.$email_user.'&hash='.$hash.'

    Dimohon untuk tidak memberikan link diatas kepada siapapun karena bersifat privasi bagi Anda.
    
    '; // Our message above including the link
                        
    $headers = 'From:dickayunia1@gmail.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email

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