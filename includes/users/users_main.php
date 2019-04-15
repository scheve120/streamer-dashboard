<?php

/**
 * @file
 * This file whil load al need files for user registrations.
 */

require_once './conf/conf.php';
require_once './sql/mysql.php';

// Volgende files laden wanneer je niet bent ingelogd.
if (empty($_SESSION["user_online"])) {
  include "./includes/users/users_registration.php";
  $page_content = load_template("./includes/users/template/html/login.php", $page_variables);

}
else {
  // Laad deze bestanden wanneer je wel ben ingelogd.
  $page_content = load_template("./scoreboard/editboard.php", $page_variables);
}
