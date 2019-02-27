<?php
if (isset($_POST["REGemail1"]) && isset($_POST["REGemail2"])) {
  $email1 = $_POST["REGemail1"];
  $email2 = $_POST["REGemail2"];
  email_check($_POST["REGemail1"],$email1,$_POST["REGemail2"]);
}


 ?>
