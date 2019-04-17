<?php

// Print all warnings.
error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();
require dirname(__FILE__) . '/main.php';
require './conf/conf.php';
require "./sql/mysql.php";
