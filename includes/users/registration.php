<?php
include 'variables.php';
// Registration form handler for setting arguments for functions


/**
* Check if string is tainted.
*/
function is_string_tainted ($string) {
  $arrFrom = array("'", '"',"{","}",",");
  $arrTo = array("Hacker 1","Hacker 2","Hacker 3","Hacker 4","Hacker 5");

  $string = str_replace($arrFrom, $arrTo, $string, $count);

  return $count > 0;
}

function is_all_user_input_tainted () {
  if (is_string_tainted($_POST['REGname'])) {
    return TRUE;
  }
  if (is_string_tainted($_POST['REGpassword1']) || is_string_tainted($_POST['REGpassword2'])) {
    return TRUE;
  }
  password_check($_POST["REGpassword1"],$_POST["REGpassword2"]);
}

// Check if email is matching
function email_check ($email1, $email2) {
  if ($email1 === $email2){
    return TRUE;
  }
  $email_tags = strip_tags($email1);
   if (strlen($email_tags) === strlen($email1)) {
     return TRUE;
  } else {
    return (FALSE);
  }
}

//Password match check
function password_check($password1, $password2) {
  if (isset($password1) && isset($password2)) {
    // $password1 = $_POST["REGpassword1"];
    // $password2 = $_POST["REGpassword2"];
  }
  if ($password1 != $password2) {
  }
  $password_tags = strip_tags($password1);
  if (strlen($password_tags) === strlen($password1)) {
    return TRUE;
  }
  return FALSE;
}

// Check if username already exist
function user_name_is_free () {
  $SelectUsersTable = "SELECT user_name FROM user";
  $DatabaseGetUserRow = mysqli_query($databaseconnect,$SelectUsersTable);

}

// Final checks when true than the it whil write to database


// Function for sending registration data to database
function register_to_database($pdo) {
  if (is_all_user_input_tainted () === TRUE) {
    echo "Kill your self filty hacker!!";
    return;
  }
  if (!email_check($_POST["REGemail1"],$_POST["REGemail2"])) {
    echo "aiaia, mail!";
    return FALSE;
  }
  else if (!password_check($_POST["REGpassword1"], $_POST["REGpassword2"])) {
    echo "aiaiaia, pass!";
    return FALSE;
  }
  $username = $_POST["REGname"];
  $email = $_POST["REGemail1"];
  $password = password_hash($_POST["REGpassword1"],PASSWORD_DEFAULT);

  // Sends registration data to database
  if (isset($_POST["registreer"])) {
    $sqlInsert = "INSERT INTO user (user_name, user_email, user_password) VALUES (?, ?, ?)";
    // echo "1";
    try {
      $pdo->prepare($sqlInsert)->execute([$username, $email, $password]);
    } catch (PDOException $e) {
      $existingError = "Catching un wanted injections violation: Code 10020";
      if (strpos($e->getMessage(), $existingkey) !== FALSE) {
        // Take some action if there is a key constraint violation, i.e. duplicate name
      } else {
        throw $e;
      }
    }
  }
}

register_to_database($pdo);
