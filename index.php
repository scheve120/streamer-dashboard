<?php

ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();
// Print all warnings.
error_reporting(E_ALL);
ini_set('display_errors', '1');

require dirname(__FILE__) . '/main.php';
