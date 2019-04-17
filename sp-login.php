<?php

if (isset($_GET['reset'])) {
  echo "test if get link works now";
  require_once "./includes/users/users_recovery.php";
  password_recovery_form();
}
// volgende files laden wanneer je niet bent ingelogd
if (empty($_SESSION["user_online"])) {
  require_once "./includes/users/users_registration.php";
  $page_content = load_template("./includes/users/template/html/login.php", $page_variables);

} else {
  // Laad deze bestanden wanneer je wel ben ingelogd
  $page_content = load_template("./scoreboard/editboard.php", $page_variables);
}
