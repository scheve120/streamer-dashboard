<?php

/**
 * @file
 * Database connect variable.
 */

$databaseconnect = mysqli_connect($sql_credentials['server_name'], $sql_credentials['username'], $sql_credentials['password'], $sql_credentials['dbname']);
$dsn = "mysql:host=" . $sql_credentials['server_name'] . ";dbname={$sql_credentials['dbname']};charset={$sql_credentials['charset']}";

$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => FALSE,
];
try {
  $pdo = new PDO($dsn, $sql_credentials['username'], $sql_credentials['password'], $options);
}
catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
