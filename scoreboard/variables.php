<?php
// require_once "../sql/mysql.php";

// Database gegevens!!
$connect = $GLOBALS['databaseconnect'];
$selectDatabasePlayerkill = "SELECT * FROM scoreboard";
$getDatabasePlayerkill = "SELECT * FROM scoreboard ORDER BY Score_ID";
$PlayerkilltableGetRow = mysqli_query($databaseconnect, $selectDatabasePlayerkill);
$GETPlayerkilltableGetRow = mysqli_query($databaseconnect, $getDatabasePlayerkill);
//-----------------------------------------------------

 ?>
