<?php

/**
 * @file
 * Login handler script.
 */

// If the user have prest the logout button.
if (isset($_POST["logout"])) {
  $_SESSION["user_online"] = FALSE;
}

// If form is set start the loging function.
if (isset($_POST["login-button"])) {
  users_login_naam_en_password();
}

/**
 * @file
 * Login function.
 */
function users_login_naam_en_password() {
  global $pdo;
  global $site_title_url;

  $username = $_POST["user_name"];
  $userPassword = $_POST["password"];

  $select_user = "SELECT * FROM user WHERE user_name = ?";
  $user_data_prepare = $pdo->prepare($select_user);
  $user_data_prepare->execute([$username]);
  $users = $user_data_prepare->fetch();

  if ($users &&  password_verify($userPassword, $users['user_password'])) {
    $_SESSION["user_online"] = TRUE;
    // Sending back to previous URL.
    $url = $_SERVER['HTTP_REFERER'];
    $_SESSION["UserStatus"] = "Your logged in";
    // Php redirect.
    return (TRUE);
  }
  // Returns false is there is no password or name matching.
  $_SESSION["user_online"] = FALSE;
  $_SESSION["Sessiontest"] = "Please login";
  // Php redirect.
  return (FALSE);
}

function users_username_alert ($user_regestration_name) {
  global $pdo;
}
