<?php
$version = phpversion();

if (isset($_POST['email'])){
  $mail_from = $_POST['email-from'];
  $mail_to = $_POST['email-to'];

  $name = 'test mail mandala';
  $username = htmlspecialchars($name);
  $to = $mail_to;
  $subject = 'test mail';
  $from = $mail_from;


  // Send content with html.
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= "From: $from test location from the headers";
  $text = 'deze email is om te testen of de php email functie werkt';

  $text = wordwrap($text, 70);

  mail($to, $subject, $text, $headers);
  echo "Vergeet niet je spam folder van je email te controleren";
}
else {
  echo "email is not send";
}
?>
<div class="php-version">
  <?php echo $version; ?>
<div>

<div class="email tester">
  <form action="" method="post"  name="Login">
    <input type="email" name="mail-from" placeholder="Van welk adres">
    <input type="email" name="email-to" placeholder="Naar welk email adres">

    <input type="submit" name="email" value="send test mail">
  </form>
</div>
