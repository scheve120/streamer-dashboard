<?php
// If the user have prest the logout button
if (isset($_POST["logout"])) {
  $_SESSION["user_online"] = FALSE;
}

// if form is set start the loging function
if (isset($_POST["login-button"])) {
  users_login_naam_en_password ();
}

// Login function

function users_login_naam_en_password () {
  global $pdo;
  global $site_title_url;
  
  $Username = $_POST["user_name"];
  $UserPassword = $_POST["password"];

  $select_user = "SELECT * FROM user WHERE user_name = ?";
  $user_data_prepare = $pdo->prepare($select_user);
  $user_data_prepare->execute([$Username]);
  $users = $user_data_prepare->fetch();

  if ($users &&  password_verify($UserPassword, $users['user_password'])){
    $_SESSION["user_online"] = TRUE;
    // Sending back to previous URL
    $url = $_SERVER['HTTP_REFERER'];
    $_SESSION["UserStatus"] = "Your logged in";
    // php redirect
    return (TRUE);
  }
  // Returns false is there is no password or name matching
  $_SESSION["user_online"] = FALSE;
  $_SESSION["Sessiontest"] = "Please login";
  echo "Can't login, Check username or password";
  // php redirect
  return (FALSE);
}


function users_username_alert ($user_regestration_name) {
  global $pdo;
}
