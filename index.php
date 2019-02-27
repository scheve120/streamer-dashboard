<?php
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();

// echo 'session login check >>' . $_SESSION["Islogin"];

require_once "./sql/mysql.php";
include "./includes/users/login-handler.php";
include "./includes/users/registration.php";
include "./scoreboard/editboard.php";


if (isset($_POST["logout"])){
  // session_unset();
  // session_destroy();
  // session_write_close();
//  echo "<meta http-equiv='refresh' content='2'>";
  $_SESSION["Islogin"] = FALSE;

// redirect naar index.php;

  // loginNaamEnPassword ();
}

if (!empty($_SESSION["Islogin"])){
  EditboardPanel();
}

?>
<html>
<body>
  <?php if (empty($_SESSION["Islogin"])): ?>
    <form action="?form=login" method="post"  name="Login">
      <p>Vul hier je gebruikers naam in: <input type="text"  placeholder="gebruikersnaam"  name="LoginName"></p>
      <p>password: <input type="password" placeholder="password" name="LoginPass"></p>
      <input type="submit" name="login" value="Login">
    </form>

    <form action="?form=register" method="post"  name="registreer">
      <p>Vul hier je gebruikers naam in: <input type="text"  placeholder="gebruikersnaam"  name="REGname"></p>
      <p>email: <input type="email" placeholder="email" name="REGemail1"></p>
      <p>email: <input type="email" placeholder="email" name="REGemail2"></p>
      <p>password: <input type="password" placeholder="password" name="REGpassword1"></p>
      <p>controle password: <input type="password" placeholder="nogmaals password voor controle"  name="REGpassword2"></p>
      <input type="submit" name="registreer" value="registreer">
    </form>
  <?php else: ?>
    <form action="" method="post" name="logout">
      <input type="submit" name="logout" value="logout">
    </form>
  <?php endif; ?>
  <?php // session_destroy(); ?>
</body>
</html>
