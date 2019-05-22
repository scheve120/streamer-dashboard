<?php

if (file_exists(__DIR__ . '/conf.local.php')) {
  require_once 'conf.local.php';
}

// Global site variables

$site_name = 'development.broworkspace'
$site_tld = '.nl';
$site_url = "http://$site_name$site_tld/";
