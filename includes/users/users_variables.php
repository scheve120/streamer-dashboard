<?php

/**
 * @file
 * Setting registration variables.
 */

if (isset($_POST["REGemail1"]) && isset($_POST["REGemail2"])) {

  email_check($_POST["REGemail1"], $email1, $_POST["REGemail2"]);
}

// Create login and registration variables.
if (isset($_POST["login-button"])) {
  $form_key = 'login';
  $name = $_POST["user_name"];
  $password = $_POST["password"];

  $page_variables = array(
    'form_key' => $form_key,
    'name' => $name,
    'password' => $password,
  );
}
elseif (isset($_POST["register-button"])) {
  $form_key = 'register';
  $name = $_POST["user_name"];
  $email1 = $_POST["email1"];
  $email2 = $_POST["email2"];
  $password1 = $_POST["password1"];
  $page_variables = array(
    'form_key' => $form_key,
    'name' => $name,
    'email1' => $email1,
    'email2' => $email2,
    'password1' => $password1,
  );
}
else {
  $form_key = FALSE;
  $page_variables = array(
    'form_key' => '',
    'name' => '',
    'email1' => '',
    'email2' => '',
    'password1' => '',
  );
}
