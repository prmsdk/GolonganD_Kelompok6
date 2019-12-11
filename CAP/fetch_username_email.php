<?php

include 'includes/config.php';

if(isset($_POST['uname'])){
  $username = $_POST['uname'];
  $result = mysqli_query($con, "SELECT COUNT(*) AS USER_USERNAME FROM user WHERE USER_USERNAME = '@$username'");

  $row = mysqli_fetch_assoc($result);
  $count = $row['USER_USERNAME'];

  echo $count;
}

if(isset($_POST['email_user'])){
  $email = $_POST['email_user'];
  $result = mysqli_query($con, "SELECT COUNT(*) AS USER_EMAIL FROM user WHERE USER_EMAIL = '$email'");

  $row = mysqli_fetch_assoc($result);
  $count = $row['USER_EMAIL'];

  echo $count;
}