<?php

function users_reset_password ($data) {
  global $pdo;

  $users_email = "SELECT user_name, user_email FROM user WHERE user_email=?";
  $query = $pdo->prepare($users_email);
  $query->execute([$data['email']]);
  $result = $query->fetch(PDO::FETCH_ASSOC);

  echo "<br/> Test 2 Users reset password";

  if ($result) {
    return array(
      'succes' => TRUE,
      'recover_email' => $result,
      'username' => $result["user_name"],
      'email_to' => $result["user_email"],
      'email_text' => 'Password recovery email has been send!'
    );
  }

}

function init_password_recovery($data) {
  // echo "function is under development";
  // return;
  $users_reset_password_result = (object) users_reset_password ($data);
  echo "<br/> test 1 init password recovery function";
  if ($users_reset_password_result->succes) {
    require './includes/email/PHP-Mail-handler.php';
    $recovery_email = array(
      'recover_email' => $users_reset_password_result->recover_email,
      'username' => $users_reset_password_result->username,
      'email_to' => $users_reset_password_result->email_to,
      'email_text' => $users_reset_password_result->email_text
    );
    email_sender($recovery_email);
  }


}
