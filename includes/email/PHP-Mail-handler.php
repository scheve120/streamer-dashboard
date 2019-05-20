<?php

/**
 * @file
 * PHP Email script.
 */

/**
 * @file
 * Old email function Meby setting it for smtp.
 */
function send_email($user_mailing) {
  $to = $user_mailing['email'];
  $subject = "Test of email werkt";
  $from = "broworkspace.nl";
  $text = "Gefeliciteerd" . $user_mailing['name'] . "je bent nu lid van <a href=Browowkrspace.nl>Browowkrspace</a>";
  $text = wordwrap($text, 70);
}

/**
 * @file
 * Send email function.
 */
function email_sender($data) {
  global $site_domain;

  // Creating the email variables.
  $username = $data['username'];
  $username = htmlspecialchars($username);
  $to = $data['email_to'];
  $subject = $data['email_subject'];
  $from = $data['from'] . $site_domain;

  // Send content with html.
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= "From: $from test location from the headers";
  $text = $data["email_text"];

  $text = wordwrap($text, 70);

  mail($to, $subject, $text, $headers);

}
