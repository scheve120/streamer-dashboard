<?php
include dirname(__FILE__) . '/template/installation.tpl.php';
require 'scoreboard-adv_installation.php';
  $test_databse = new DatabaseInstallation();
  $test_databse->input_form_handler();
