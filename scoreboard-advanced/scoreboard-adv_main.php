<?php
include_once './conf/conf.php';
include_once './sql/mysql.php';

require dirname(__FILE__) . '/scoreboard-adv_installation.php';
require dirname(__FILE__) . '/scoreboard-adv_functions.php';

$test_databse = new DatabaseInstallation();
$test_databse->InputFormHandler();

$scoreboard = new ScoreBoardManager();
$scoreboard->getBoard();

echo $scoreboard->boardData['test'];

echo $scoreboard->getBoard()['test'];

if 