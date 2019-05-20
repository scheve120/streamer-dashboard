<?php

/**
 * @file
 * This script whil handle the user registration function.
 */

 /**
  * Start the function for password recovery.
  */
function users_init_password_recovery($user_data) {
  $users_reset_password_result = (object) users_get_username_from_email($user_data);
  if ($users_reset_password_result->success) {
    $recovery_email = array(
      'username' => $users_reset_password_result->username,
      'email' => $user_data,
    );
    users_generate_recovery_token($recovery_email);
  }
}

/**
 * Checking if the email exist in the database.
 */
function users_get_username_from_email($email) {
  global $pdo;

  $query_string = "SELECT user_name, user_email FROM user WHERE user_email=?";
  $query = $pdo->prepare($query_string);
  $query->execute([$email]);
  $result = $query->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    return array(
      'success' => TRUE,
      'username' => $result['user_name'],
      'email' => $result['user_email'],
    );
  }
  return array(
    'success' => FALSE,
  );
}

/**
 * Generates the has and user token key.
 */
function users_generate_recovery_token($select_user_email) {
  // Defining the globals.
  global $pdo;
  global $site_url;

  // Setting the toking variables.
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(64);

  // Create the token verify link to send to the email adres.
  $verify_url = $site_url . '?' . http_build_query([
    'account-recovery' => '',
    'selector' => $selector,
    'validator' => bin2hex($token),
  ]);

  // Create date and expire time.
  $expires = new DateTime('NOW');
  $expires->add(new DateInterval('PT01H'));

  $user_validation_query = array(
    'user_selector' => $selector,
    'user_token' => hash('sha256', $token),
    'user_token_expire_time' => $expires->format('Y-m-d\TH:i:s'),
    'user_email' => $select_user_email['email'],
  );

  // Start updating the database and setting the Tokens.
  $user_recovery_sql_string = "UPDATE user SET user_selector=:user_selector, user_token=:user_token, user_token_expire_time=:user_token_expire_time WHERE user_email=:user_email";
  $stmt = $pdo->prepare($user_recovery_sql_string);
  $stmt->execute($user_validation_query);
  if ($stmt->execute($user_validation_query) === TRUE) {
    require './includes/email/PHP-Mail-handler.php';
    $send_recovery_email = array(
      'email_to' => $user_validation_query['user_email'],
      'email_subject' => 'Account recovery',
      'from' => 'no-reply@',
      'username' => $select_user_email['username'],
      'email_text' => 'Hallo ' . $select_user_email['username'] . ' Please click on the <a href=" ' . $verify_url . '">link </a> to recover you account',
    );
    // Send the recovery link to the user.
    email_sender($send_recovery_email);
  }
  else {
  }
}

/**
 * Start the password recovery.
 */
function init_recovery($selector, $validator) {
  global $pdo;

  // Creating the variables and database query variables.
  $select_user_from_token = "SELECT * FROM user WHERE user_selector = ?";
  $update_user_password = "UPDATE user SET user_password= :password, user_selector=NULL, user_token=NULL, user_token_expire_time=NOW(), user_token_time=NOW() WHERE user_selector=:selector";
  $get_user_details = $pdo->prepare($select_user_from_token);
  $get_user_details->execute([$selector]);
  $start_token_check = $get_user_details->fetch();

  // Check if the form reset password has ben set.
  if (isset($_POST['recover-password'])) {
    $hash_password = password_hash($_POST["password1"], PASSWORD_DEFAULT);
    // If token is verify than update the database.
    if ($start_token_check['user_selector'] === $selector && $_POST["password1"] === $_POST["password2"]) {
      $update_password = array(
        'password' => $hash_password,
        'selector' => $selector,
      );
      // Start the updating process and return answer arrays.
      $account_recovery_update = $pdo->prepare($update_user_password);
      $account_recovery_update->execute($update_password);
      return array(
        'recovery' => TRUE,
        'username' => $start_token_check['user_name'],
        'message' => 'recovery token valid',
      );
    }
    else {
      return array(
        'recovery' => FALSE,
        'username' => 'No username found',
        'message' => 'recovery token not valid',
      );
    }
    return array(
      'username' => $start_token_check['user_name'],
    );
  }
  else {
    return array(
      'recovery' => '',
      'username' => '',
      'message' => 'This usertoken is already uset or is expired. Please try again.',
    );
  }
}
