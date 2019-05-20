<?php

/**
 * @file
 * This file whil load the needing files.
 */

 // If the user have prest the logout button.
if (isset($_POST["logout"])) {
  unset($_SESSION["user_online"]);
}

require './conf/conf.php';
require "./sql/mysql.php";
// Volgende files laden wanneer je niet bent ingelogd.
if (isset($_GET['password-reset'])) {
  require_once './includes/users/users_main.php';
  $page_content = load_template("./includes/users/template/html/login.php", $page_variables);
}
elseif (empty($_SESSION["user_online"])) {
  require_once './includes/users/users_main.php';
  $page_content = load_template("./includes/users/template/html/login.php", $page_variables);

}
else {
  // Laad deze bestanden wanneer je wel ben ingelogd.
  $page_content = load_template("./scoreboard/editboard.php", $page_variables);
}

require "./themes/templates/html.php";
$time = date_default_timezone_set('Europe/Amsterdam');
echo date(DATE_RFC2822);

/**
 * Volgende file WEL laden wanneer je bent ingelogd.
 */
function load_template($template_path, $variables = array()) {
  extract($variables);

  ob_start();

  include $template_path;
  $rendered_template = ob_get_contents();

  ob_end_clean();
  return $rendered_template;
}
