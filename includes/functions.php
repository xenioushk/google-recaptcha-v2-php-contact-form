<?php

function getRecaptchaValidationStatus($captcha = "")
{

  $validationStatus = [
    'status' => 0,
    'msg' => 'Invalid captcha! Unable to send message.'
  ];

  if (empty($captcha)) return $validationStatus;

  $ip = $_SERVER['REMOTE_ADDR'];

  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode(GRC_SECRET_KEY) . '&response=' . urlencode($captcha);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response, true);

  if (isset($responseKeys["success"]) && !empty($responseKeys["success"])) {
    $validationStatus = [
      'status' => 1,
      'msg' => 'Message sent successfully.'
    ];
  } else if (isset($responseKeys["error-codes"]) && !empty($responseKeys["error-codes"])) {

    // timeout-or-duplicate

    $validationStatus['msg'] = "Captcha {$responseKeys["error-codes"][0]}.";
  }

  return $validationStatus;
}
