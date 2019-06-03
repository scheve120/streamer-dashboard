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
      row_name VARCHAR(50) NOT NULL,
    )";
  }

  public function input_form_handler() {
    // Starting Database test function. If not fount than create the tables.
    if (isset($_POST['test-db'])) {
      $this->check_if_tables_exist();
      echo "test is there is a table";
    }

    if (isset($_POST['test-create'])) {
      $this->create_database_tables();`
      echo "creating table";
    }
  }

  /**
   * @file
   * Check if needed tables exist.
   */
  public function check_if_tables_exist() {
    global $pdo;

    $database_select_table = "SHOW TABLES LIKE 'user'";
    $query = $pdo->prepare($database_select_table);
    $query->execute();
    $check_table_exist = $query->fetch(PDO::FETCH_ASSOC);
    if ($check_table_exist) {
      ;
    }
    else {
      return FALSE;
    }
  }

  /**
   * @file
   * If there no need tables than create tables.
   */
  public function create_database_tables() {
    echo "test function create_database_tables";
  }

}
