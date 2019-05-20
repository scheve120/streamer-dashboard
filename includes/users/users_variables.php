<?php

/**
 * @file
 * Setting registration variables.
 */

if (isset($_POST['registration_email1']) && isset($_POST['registration_email2'])) {

  email_check($_POST['registration_email1'], $email1, $_POST['registration_email2']);
}

// Create login and registration variables.
if (isset($_POST['login-button'])) {
  $form_key = 'login';
  $username = $_POST["username"];
  $password = $_POST["password"];

  $page_variables = array(
    'form_key' => $form_key,
    'username' => $username,
    'password' => $password,
  );
}
elseif (isset($_POST["register-button"])) {
  $form_key = 'register';
  $username = $_POST['username'];
  $email1 = $_POST['email1'];
  $email2 = $_POST['email2'];
  $password1 = $_POST['password1'];
  $page_variables = array(
    'form_key' => $form_key,
    'username' => $username,
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
