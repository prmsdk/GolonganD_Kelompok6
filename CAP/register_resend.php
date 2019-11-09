<?php

  include 'includes/config.php';
  session_start();
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
  Your Username : @'.$usename_user.'
  ------------------------
  
  Please click this link to activate your account:
  http://localhost/GolonganD_Kelompok6/CAP/register_verify.php?email='.$email_user.'&hash='.$hash.'
  
  '; // Our message above including the link
                      
  $headers = 'From:dickayunia1@gmail.com' . "\r\n"; // Set from headers
  mail($to, $subject, $message, $headers); // Send our email