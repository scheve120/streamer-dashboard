<?php
/**
 * @file
 * Check if needet database contant exists else build query.
 */

/**
 * @file
 * Create database tables and permission roles.
 */
class DatabaseInstallation {
  // Setting database variables.
  function __construct() {


    $database_create_table = "CREATE TABLE scoreboard_adv (
      scorebaord_ID INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      board_name VARCHAR(50) NOT NULL,
      row_naems VARCHAR(50) NOT NULL,
    )";
  }

  public function input_form_handler() {
    global $pdo;
    // Starting Database test function. If not fount than create the tables.
    if (isset($_POST['test-db'])) {
      $this->check_if_tables_exist($pdo);
    }

    if (isset($_POST['test-create'])) {
      $this->create_database_tables($pdo);
    }
  }
  /**
   * @file
   * Check if needed tables exist.
   */
  public function check_if_tables_exist($pdo) {
    $database_select_table = 'SELECT * FROM scoreboard_adv WHERE board_name= ?';
    $start_database_test = $pdo->prepare($database_select_table);
    if ($start_database_test->execute('test-board')) {
      echo "Database exist";
    }
    else {
      echo "Database not exist";
    }
  }

  /**
   * @file
   * If there no need tables than create tables.
   */
  public function create_database_tables($pdo) {
    echo "test function create_database_tables";
  }

}
