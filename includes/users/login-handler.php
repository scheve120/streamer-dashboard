<?php
// Login function
function loginNaamEnPassword () {
  if(isset($_POST["LoginName"])&& isset($_POST["LoginPass"])) {
    $password1 = password_hash ($password , PASSWORD_DEFAULT); // Hashing the password
    $Username = $_POST["LoginName"];
    $UserPassword = $_POST["LoginPass"];
  }

  $DBSelecter = "SELECT * FROM user";
  $userdbselecter = mysqli_query($GLOBALS["databaseconnect"],$DBSelecter);

  if(mysqli_num_rows($userdbselecter) > 0) {
    while($users = mysqli_fetch_array($userdbselecter,MYSQLI_ASSOC)) {
      $DBuserName = $users["user_name"];
      $DBuserPassword = $users["user_password"];
      // start checking if username and password is correct and matching to database
      if($DBuserName === $Username && password_verify($UserPassword,$DBuserPassword)){
        $_SESSION["Islogin"] = TRUE;
        // Sending back to previous URL
        $url = $_SERVER['HTTP_REFERER'];
        $_SESSION["Sessiontest"] = "Your logged in";
        echo '<meta http-equiv="refresh" content="2;URL='.$url.'">';
        return (TRUE);
      }
    }

    // Returns false is there is no password or name matching
    $_SESSION["Islogin"] = FALSE;
    $_SESSION["Sessiontest"] = "Please login";
    return (FALSE);
  }
}

// if form is set start the loging function
if(isset($_GET["form"]) && $_GET["form"] == 'login') {
  loginNaamEnPassword ();
}
