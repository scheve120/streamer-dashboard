<?php
// Database login variables

$servername = "localhost:3306";
$username = "projectdb";
$password = "0v?Hfg20";
$dbname = "project_build";
$charset = 'utf8mb4';



// Database connect variable
$databaseconnect = mysqli_connect($servername, $username, $password, $dbname);
$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
