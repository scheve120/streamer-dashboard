<?php

/**
 * @file
 * This whil load the user login registration and logout functions.
 *
 * This streaming dashboard is created by Scheve120 / David van den Berg.
 * There are no rights to re use this code without given permissions.
 * For more information check  @link http://scheve120.nl.
 */

require_once 'users_variables.php';
require_once 'users_login_handler.php';
require_once 'users_registration.php';

if (isset($_GET['account-recovery']) || isset($_POST['recover-password'])) {
  require 'users_recovery.php';
  $get_user_data = TRUE;
  $init_recovery_result = (object) init_recovery($_GET['selector'], $_GET['validator']);
  if ($init_recovery_result->recovery) {
    echo $init_recovery_result->message;
  }
  else {
    $init_recovery_result->message;
  }
}

if (isset($_POST['reset-password'])) {
  require 'users_recovery.php';
  init_recovery($_GET['selector'], $_GET['validator']);
}
