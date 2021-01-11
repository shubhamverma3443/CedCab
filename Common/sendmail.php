<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;

require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';

$mail = new PHPMailer(true);

$alert = '';


$email = $_POST['email'];
$otp =generateOTP();
$_SESSION['otp']=$otp;
function generateOTP()
{
  $generator = "1357902468";
  $result = "";
  for ($i = 1; $i <= 6; $i++) {
    $result .= substr($generator, (rand() % (strlen($generator))), 1);
  }
  return $result;
}

try {
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'alianhunter999@gmail.com'; // Gmail address which you want to use as SMTP server
  $mail->Password = 'Alian999@'; // Gmail address Password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = '587';

  $mail->setFrom('alianhunter999@gmail.com'); // Gmail address which you used as SMTP server
  $mail->addAddress($email); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

  $mail->isHTML(true);
  $mail->Subject = 'OTP';
  $mail->Body = $otp;

  if ($mail->send()) {
    echo "OTP Send";
  } else {
    echo "Try Again";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}
