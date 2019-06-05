<?php
/**
 * @file
 * The main functions for the advanced scoreboard.
 */

/**
 * @file
 * Create scoreboard.
 */
class BuildUpScoreboard {
  public $boardData = array(
    'ID' => '',
    'name' => '',
    'tables' => '',
    'style' => '',
    'test' => 'test deze object array 1',
  );

  function __construct() {
    
  }

  public function getBoards() {
    global $pdo;
    $selectQuery = 'SELECT * FROM scoreboard_adv';
    $fetchScoreboards = $pdo->prepare($selectQuery);
    $fetchScoreboards->execute();
    print_r($fetchScoreboards->fetch(PDO::FETCH_ASSOC));
    if ($fetchScoreboards->fetch(PDO::FETCH_ASSOC) > 0) {
      // echo 'there is board info';
      foreach ($fetchScoreboards as $scoreboards) {
        return array(
          'name_ID' => $scoreboards["board_ID"],
          'name' => $scoreboards['board_name'],
          'tables' => $scoreboards['board_data'],
          'style' => $scoreboards['board_theme'],
          'test' => 'test deze object array2',
        );
      }
    }
  }

}