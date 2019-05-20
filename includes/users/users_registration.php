<?php


if ($form_key === "register") {
  $users_init_registration_process_result = (object) users_init_registration_process();

  if (!$users_init_registration_process_result->succes) {
    $page_message = $users_init_registration_process_result->message;
  }
}

if (isset($_POST['send-token'])) {
  require_once './includes/users/users_recovery.php';

  users_init_password_recovery($_POST["email"]);
}

function users_init_registration_process() {
  global $site_url;
  global $site_domain;

  $username = $_POST["user_name"];
  $email = $_POST["email1"];
  // Variabele hernoemen naar $password_hashed?
  $hash_password = password_hash($_POST["password1"], PASSWORD_DEFAULT);
  $user_data = array(
    'username' => $_POST["user_name"],
    'email1' => $_POST["email1"],
    'email2' => $_POST["email2"],
    'password1' => $_POST["password1"],
    'password2' => $_POST["password2"],
    'hash_pass' => $hash_password,
    'from' => 'no-reply@',
    'email_subject' => 'Registration succesful',
    'email_to' => $_POST["email1"],
    'email_text' => 'Welcom ' . strip_tags($_POST["user_name"]) . ' to <a href="' . $site_url . '">' . $site_domain . '"</a>"',
  );

  // Check if everything is correct.
  $users_registration_check_result = (object) users_registration_check($user_data);
  if ($users_registration_check_result->succes) {
    require_once './includes/email/PHP-Mail-handler.php';
    email_sender($user_data);
    users_register_to_database($user_data);
    return array(
      'succes' => TRUE,
      'message' => 'Registration succesful!',
    );
  }
  else {
    return $users_registration_check_result;
  }
}

/**
 * @file
 * Check if form input fields are tainted.
 */
function users_is_string_tainted($string) {
  $arrFrom = array("'", '"', "{", "}", ",");
  $arrTo = array('Hacker 1', 'Hacker 2', 'Hacker 3', 'Hacker 4', 'Hacker 5');

  $string = str_replace($arrFrom, $arrTo, $string, $count);
  return $count > 0;
}

function users_is_all_user_input_tainted($username, $pass1, $pass2) {
  if (users_is_string_tainted($username)) {
    return array(
      'succes' => FALSE,
      'message' => 'Username got forbidden characters',
    );
  }

  if (users_is_string_tainted($pass1) || users_is_string_tainted($pass2)) {
    return array(
      'succes' => FALSE,
      'message' => 'Password got forbidden characters',
    );
  }

  $users_password_check_result = (object) users_password_check($pass1, $pass2);
  if (!$users_password_check_result->succes) {
    return array(
      'succes' => FALSE,
      'message' => 'Please check password',
    );
  }

  $values_to_check_for_tags = array($username, $pass1);
  foreach ($values_to_check_for_tags as $value_to_check_for_tags) {
    if (strip_tags($value_to_check_for_tags) != $value_to_check_for_tags) {
      return array(
        'succes' => FALSE,
        'message' => 'HTML tags arre forbidden in registration',
      );
    }
  }

  return array(
    'succes' => TRUE,
  );
}

/**
 * @file
 * Check if username already exist.
 */
function users_name_is_free($username) {
  global $pdo;
  // Creating the query selector.
  $select_user = "SELECT * FROM user WHERE user_name=?";

  // Setting Query string.
  $query = $pdo->prepare($select_user);
  $query->execute([$username]);
  $result = $query->fetch(PDO::FETCH_ASSOC);

  // Start Checking if username is free. If free skip.
  if ($result) {
    return array(
      'succes' => FALSE,
      'massage' => 'Username is not availible',
    );
  }

  return array(
    'succes' => TRUE,
    'massage' => 'Username is free',
  );
}

/**
 * @file
 * Check if email is matching.
 */
function users_email_check($email1, $email2) {

  if (empty($email1) || empty($email2)) {
    return array(
      'succes' => FALSE,
      'message' => 'Please fill in email',
    );
  }

  elseif ($email1 != $email2) {
    return array(
      'succes' => FALSE,
      'massage' => 'Email is not matching',
    );
  }

  elseif (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
    return array(
      'succes' => FALSE,
      'message' => 'Please fil in correct email',
    );
  }

  return array(
    'succes' => TRUE,
  );
}

/**
 * @file
 * Check if email exist.
 */
function users_email_is_free($email) {
  global $pdo;
  $users_email = "SELECT user_email FROM user WHERE user_email=?";
  $query = $pdo->prepare($users_email);
  $query->execute([$email]);
  $result = $query->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    return array(
      'succes' => FALSE,
      'message' => 'Email already exists',
    );
  }
  return array(
    'succes' => TRUE,
    'message' => 'Email is free',
  );
}

/**
 * @file
 * Password match check.
 */
function users_password_check($password1, $password2) {
  $password_tags = strip_tags($password1);
  if (empty($password1) || empty($password2)) {
    return array(
      'succes' => FALSE,
      'message' => 'Please enter a password',
    );
  }

  elseif ($password1 != $password2) {
    return array(
      'succes' => FALSE,
      'message' => 'Passwords do not match',
    );
  }

  elseif (strlen($password_tags) != strlen($password1)) {
    return array(
      'succes' => FALSE,
      'message' => 'Please enter a password without forbidden characters',
    );
  }

  return array(
    'succes' => TRUE,
  );
}

// Final checks when true than the it whil write to database
function users_registration_check($user_data) {

  // Setting result strings and sending function arguments.
  // Creating check array for unwatned characters.
  $users_is_all_user_input_tainted_result = (object) users_is_all_user_input_tainted($user_data['username'], $user_data['password1'], $user_data['password2']);
  // Checking the email.
  $users_email_check_result = (object) users_email_check($user_data['email1'], $user_data['email2']);
  // Checking if username is free.
  $users_email_is_free_result = (object) users_email_is_free($user_data['email1']);
  // Password check.
  $users_password_check_result = (object) users_password_check($user_data['password1'], $user_data['password2']);
  // Check if username is free!
  $users_name_is_free_result = (object) users_name_is_free($user_data['username']);

  // Check if there are no forbidden or attemps for hacking!
  if (!$users_is_all_user_input_tainted_result->succes) {
    return array(
      'succes' => FALSE,
      'message' => $users_is_all_user_input_tainted_result->message,
    );
  }

  // Check if both email fields are matching.
  elseif (!$users_email_check_result->succes) {
    return array(
      'succes' => FALSE,
      'message' => $users_email_check_result->message,
    );
  }

  // Check if users email is free.
  elseif (!$users_email_is_free_result->succes) {
    return array(
      'succes' => FALSE,
      'message' => $users_email_is_free_result->message,
    );
  }

  // Check if password is matching.
  if (!$users_password_check_result->succes) {
    return array(
      'succes' => FALSE,
      'message' => $users_password_check_result->message,
    );
  }

  // Check if the username is free.
  elseif (!$users_name_is_free_result->succes) {
    return array(
      'succes' => FALSE,
      'message' => $users_name_is_free_result->message,
    );
  }

  return array(
    'succes' => TRUE,
    'message' => 'Input fields oke',
  );
}

/**
 * @file
 * Function for sending registration data to database.
 */
function users_register_to_database($send_data) {
  global $pdo;
  $sqlInsert = "INSERT INTO user (user_name, user_email, user_password) VALUES (?, ?, ?)";
  try {
    $pdo->prepare($sqlInsert)->execute( [$send_data['username'], $send_data['email1'], $send_data['hash_pass']]);
    return array(
      'succes' => TRUE,
      'message' => 'Your registration is succesful! please check your Email',
    );
  }
  catch (PDOException $e) {
    $existingError = 'Catching un wanted injections violation: Code 10020';
    if (strpos($e->getMessage(), $existingkey) !== FALSE) {
      // Take some action if there is a key constraint violation.
    }
    else {
      throw $e;
    }
  }
}
