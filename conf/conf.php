<?php

if (file_exists(__DIR__ . '/conf.local.php')) {
  require_once 'conf.local.php';
}

// Global site variables

$site_domain = 'development.broworkspace.nl';
$site_url = "http://$site_domain/";
