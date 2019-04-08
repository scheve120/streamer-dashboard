<?php

ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();

require_once './conf/conf.php';
require_once "./sql/mysql.php";

require './includes/users/users_variables.php';
require "./includes/users/users_login_handler.php";

// volgende files laden wanneer je niet bent ingelogd
if (empty($_SESSION["user_online"])) {
  include "./includes/users/users_registration.php";
  $page_content = load_template("./includes/users/template/html/login.php", $page_variables);

} else {
  // Laad deze bestanden wanneer je wel ben ingelogd
  $page_content = load_template("./scoreboard/editboard.php", $page_variables);
}

require "./themes/templates/html.php";

// volgende file WEL laden wanneer je bent ingelogd

function load_template($template_path, $variables = array()) {
  extract($variables);

  ob_start();

  include $template_path;
  $rendered_template = ob_get_contents();

  ob_end_clean();
  return $rendered_template;
}
