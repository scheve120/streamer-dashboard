<?php

function users_get_username_from_email ($email) {
  global $pdo;

  $query_string = "SELECT user_name, user_email FROM user WHERE user_email=?";
  $query = $pdo->prepare($query_string);
  $query->execute([$email]);
  $result = $query->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    // users_generate_recovery_token($recovery_email);

    return array(
      'success' => TRUE,
      'username' => $result['user_name'],
      'email' => $result['user_email']
    );
  }
  return array(
    'success' => FALSE,
  );
}

function users_init_password_recovery($user_data) {
  // echo "function is under development";
  // return;
  $users_reset_password_result = (object) users_get_username_from_email ($user_data);
  if ($users_reset_password_result->success) {
    // require './includes/email/PHP-Mail-handler.php';
    $recovery_email = array(
      #'recover_email' => $users_reset_password_result->recover_email,
      'username' => $users_reset_password_result->username,
      'email' => $user_data,
    );
    users_generate_recovery_token($recovery_email);
  }
}


function users_generate_recovery_token($select_user_email) {
  // Defining the globals
  global $pdo;
  global $site_url;

  // Setting the toking variables
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(64);

  // Create the token verify link to send to the email adres
  $verify_url = $site_url.'reset.php?'.http_build_query([
    'selector' => $selector,
    'validator' => bin2hex($token)
  ]);

  // Create date and expire time
  $expires = new DateTime('NOW');
  $expires->add(new DateInterval('PT01H'));


  $user_validation_query = array (
    'user_name' => $select_user_email['username'],
    'user_selector' => $selector,
    'user_token' => $token,
    'user_token_expire_time' => $expires->format('Y-m-d\TH:i:s'),
    'user_email' => $select_user_email['email'],
  );
echo "recovery function failt 1";
  $user_recovery_sql_string = "UPDATE user SET user_name=:user_name, user_selector=:user_selector, user_token=:user_token, user_token_expire_time=:user_token_expire_time WHERE user_email=:user_email";
  $stmt = $pdo->prepare($user_recovery_sql_string);
  $stmt->execute($user_validation_query);
  if ($stmt->execute($user_validation_query) === TRUE) {
    require './includes/email/PHP-Mail-handler.php';
    $send_recovery_email = array(
      'email_to' => $user_validation_query['user_email'],
      'email_subject' => 'Account recovery',
      'from' => 'no-reply@',
      'username' => $select_user_email['username'],
      'email_text' => 'Hallo '.$select_user_email["username"].' Please click on the link <a href=" '. $verify_url .'">link </a> to recover you account'
    );
    echo "recovery function failt 2";
   email_sender($send_recovery_email);
  } else {
    echo "recovery function failt 3";
  }

  // echo "<br/> test is pdo execution is working";
  // print_r($stmt->execute($user_validation_query));
  // echo $user_validation_query['user_email'];
  // var_dump($stmt->execute($user_validation_query));

}
