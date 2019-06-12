<?php
/**
 * @file
 * The main functions for the advanced scoreboard.
 */

/**
 * @file
 * Create scoreboard.
 */
class ScoreBoardManager {
  public $boardData = array(
    'ID' => '',
    'name' => '',
    'tables' => '',
    'style' => '',
    'test' => 'test deze object array 1',
  );

  function __construct() {

  }

  public function getBoard() {
    global $pdo;
    $selectQuery = 'SELECT * FROM scoreboard_adv';
    $fetchScoreboards = $pdo->prepare($selectQuery);
    $fetchScoreboards->execute();
    if ($fetchScoreboards->fetch(PDO::FETCH_ASSOC) > 0) {
      // echo 'there is board info';
      // @TODO: Fix setting array for the database data
      foreach ($fetchScoreboards as $scoreboards) {
        return array(
          'board_id' => $scoreboards["board_ID"],
          'name' => $scoreboards['board_name'],
          'board_data' => $scoreboards['board_data'],
          'board_theme' => $scoreboards['board_theme'],
          'test' => 'test deze object array 2',
        );
      }
    }
  }

  function createBoard() {
    global $pdo;


  }

  function matchUserToBoard() {

    global $pdo;
    $board = $this->getBoard();
    $board_id = $board['board_id'];
    $userID = $_SESSION['user']['user_id'];
    $linkTables = "SELECT board_name, user_name, user.user_id FROM `scoreboard_adv` INNER JOIN user ON scoreboard_adv.user_id = user.user_id WHERE user.user_id = $userID";
    $selectBoard = "SELECT * FROM `scoreboard_adv` WHERE user_id = 2";

// SELECT * FROM `scoreboard_adv` WHERE user_id = 2
// SELECT board_name, user_name, user.user_id FROM `scoreboard_adv` INNER JOIN user ON scoreboard_adv.user_id = user.user_id WHERE user.user_id = 2

    $query = $pdo->prepare($selectBoard);
    
    if ($query->execute()) {
      echo "test";
    }
  }

}