<?php

function users_reset_password ($data) {
  echo "if final function to send email works";
  // $init_password_recovery_result = (object) init_password_recovery($data);

  if ($init_password_recovery_result->succes) {
    require './includes/email/PHP-Mail-handler.php';
    email_sender($init_password_recovery_result->recover_email);
  }

}

function init_password_recovery($data) {
  // echo "function is under development";
  // return;
  global $pdo;

  $users_email = "SELECT user_email FROM user WHERE user_email=?";
  $query = $pdo->prepare($users_email);
  $query->execute([$data['email']]);
  $result = $query->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    echo "test if recovery works part 2";
    users_reset_password ($data);
    return array(
      'succes' => TRUE,
      'recover_email' => $result,
      'message' => 'Password recovery email has been send!'
    );
  }

}
