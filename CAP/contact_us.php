<?php

include 'includes/config.php';
include 'api_key.php';

require 'C:\xampp\sendgrid\vendor\autoload.php';

if(isset($_POST['kontak_kirim'])){
$nama_user = $_POST['kontak_nama'];
$email_user = $_POST['kontak_email'];
$hp_user = $_POST['kontak_telepon'];
$subject = $_POST['kontak_subject'];
$message = $_POST['kontak_pesan'];

$our_email = 'dickayunia1@gmail.com';

date_default_timezone_set('Asia/Jakarta');
ini_set('date.timezone', 'Asia/Jakarta');

// $dotenv = new Dotenv\Dotenv(__DIR__);
// $dotenv->load();

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom($email_user, $nama_user);
$email->setSubject($subject);
$email->addTo($our_email, "Primasdika Yunia Putra");
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

header("location:index.php?pesan=email_kirim");
}