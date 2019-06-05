<?php
require_once '../conf/conf.php';
require_once '../sql/mysql.php';
include dirname(__FILE__) . '/template/installation.tpl.php';
require dirname(__FILE__) . '/scoreboard-adv_installation.php';
require dirname(__FILE__) . '/scoreboard-adv_functions.php';

$test_databse = new DatabaseInstallation();
$test_databse->InputFormHandler();

$scoreboard = new BuildUpScoreboard();
$scoreboard->getBoards();

echo $scoreboard->boardData['test'];

echo $scoreboard->getBoards()['test'];