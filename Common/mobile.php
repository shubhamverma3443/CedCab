<?php
session_start();
$mobile = $_POST['mobile'];
$motp = generateOTP();
$_SESSION['motp'] = $motp;
function generateOTP()
{
  $generator = "1357902468";
  $result = "";
  for ($i = 1; $i <= 6; $i++) {
    $result .= substr($generator, (rand() % (strlen($generator))), 1);
  }
  return $result;
}
if ($mobile != '' && $motp != '') {
  $fields = array(
    "sender_id" => "FSTSMS",
    "message" => "$motp",
    "language" => "english",
    "route" => "p",
    "numbers" => "$mobile",
    "flash" => "0"
  );

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($fields),
    CURLOPT_HTTPHEADER => array(
      "authorization: cTA9QsnGyRXIdLCJZPaiw47okNjV53UDpheYM6tlFxuO8rf1KzgTJZklO7jnwo4hcfMDSG0Vbxa8zIB9",
      "accept: */*",
      "cache-control: no-cache",
      "content-type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo "OTP Send";
  }
}
