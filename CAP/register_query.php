<?php

  // MEMVALIDASI DATA MASUKAN
  session_start();

  include 'includes/config.php';

    $nama_user = $_POST['nama_user'];
    $email_user = $_POST['email_user'];
    $no_hp_user = $_POST['no_hp_user'];
    $usename_user = '@'.$_POST['username_user'];
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

      header("location:register_success.php?pesan=Anda berhasil mendaftar!&status=success");

      $to      = $email_user; // Send email to our user
      $subject = 'Pendaftaran | Verifikasi'; // Give the email a subject 
      $message = '
      
      Terimakasih telah mendaftar dan bergabung dengan kami!
      Silahkan cocokkan data diri yang kamu daftarkan dengan data yang kami terima dibawah, 
      Mohon aktivasi akun anda untuk memaksimalkan fitur dari aplikasi kami.
      
      ------------------------
      Your Name        : '.$nama_user.'
      Your Username : '.$usename_user.'
      ------------------------
      
      Dimohon klik link dibawah untuk mengaktifkan akunmu:
      http://localhost/GolonganD_Kelompok6/CAP/register_verify.php?email='.$email_user.'&hash='.$hash.'
      
      '; // Our message above including the link
                          
      $headers = 'From:dickayunia1@gmail.com' . "\r\n"; // Set from headers
      mail($to, $subject, $message, $headers); // Send our email


    }else{
      header("location:register_user.php?pesan=Validasi Password anda!&status=danger");
    }


    // QUERY INSERT PENDAFTARAN

    

