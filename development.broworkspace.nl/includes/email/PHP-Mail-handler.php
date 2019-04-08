<?php
// require_once './includes/user/registration.php';
function send_email ($user_mailing) {
  $to = $user_mailing['email'];
  $subject = "Test of email werkt";
  $from = "broworkspace.nl";
  $text = "Gefeliciteerd". $user_mailing['name']. "je ben nu lid van <a href=Browowkrspace.nl>Browowkrspace</a>";
  $text = wordwrap($text,70);
  // mail($to,$subject,$text);
}

function registration_confirmation_mail ($data) {
  $name = $data['username'];
  $username = htmlspecialchars($name);
  $to = $data['email1'];
  $subject = "Test of email werkt";
  $from = "info@broworkspace.nl";
  // Send content with html
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= "From: $from test location from the headers";
  $text = "Gefeliciteerd ". $username . " je ben nu lid van <a href='http://Browowkrspace.nl'>Browowkrspace</a>";

  $text = wordwrap($text,70);
  // send_email($send_user_data);
    mail($to, $subject, $text, $headers);
}


function password_recovery () {

}
