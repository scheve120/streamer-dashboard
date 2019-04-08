<?php

ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();


require_once './conf/conf.php';
require_once "./sql/mysql.php";

require './includes/users/variables.php';
require "./includes/users/login-handler.php";


// volgende files NIET laden wanneer je bent ingelogd
if (empty($_SESSION["user_online"])) {
  include "./includes/users/registration.php";

// ob start
// ob_start();
  $page_content = load_template("./includes/users/template/login.php", $page_variables);

} else {

// ob start

  $page_content = load_template("./scoreboard/editboard.php", $page_variables);
}

require "./themes/templates/html.php";

echo "commit";

// volgende file WEL laden wanneer je bent ingelogd
// $page_content = 456;
//

function load_template($template_path, $variables = array()) {
  extract($variables);
  // $form_key

  ob_start();

  include $template_path;
  $rendered_template = ob_get_contents();

  ob_end_clean();
  return $rendered_template;
}
