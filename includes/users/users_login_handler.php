<?php

/**
 * @file
 * Login handler script.
 */

// If form is set start the loging function.
if (isset($_POST["login-button"])) {
  users_login();
}

/**
 * @file
 * Login function.
 */
function users_login() {
  global $pdo;
  global $site_title_url;

  $username = $_POST['username'];
  $userPassword = $_POST['password'];

  $select_user = 'SELECT * FROM user WHERE user_name = ?';
  $user_data_prepare = $pdo->prepare($select_user);
  $user_data_prepare->execute([$username]);
  $users = $user_data_prepare->fetch();

  if ($users &&  password_verify($userPassword, $users['user_password'])) {
    $_SESSION['user_online'] = TRUE;
    // Sending back to previous URL.
    $url = $_SERVER['HTTP_REFERER'];
    $_SESSION['user_status'] = 'Your logged in';
    $_SESSION['user'] = array (
      'logged_on' => TRUE,
      'id' => $users['user_ID'],
    );

    // Php redirect.
    return (TRUE);
  }
  // Returns false is there is no password or name matching.
  $_SESSION['user_online'] = FALSE;
  $_SESSION['session_test'] = 'Please login';
  // Php redirect.
  return (FALSE);
}
