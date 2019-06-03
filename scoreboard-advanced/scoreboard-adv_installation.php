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

    $DatabaseCreateTable = "CREATE TABLE scoreboard_adv (
      scorebaord_ID INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      board_name VARCHAR(50) NOT NULL,
      row_name VARCHAR(50) NOT NULL,
    )";
  }

  public function InputFormHandler() {
    // Starting Database test function. If not fount than create the tables.
    if (isset($_POST['test-db'])) {
      $this->CheckIfTablesExist();
      echo "test is there is a table";
    }

    if (isset($_POST['test-create']) || !CheckIfTablesExist()) {
      $this->CreateDatabaseTables();
      echo "creating table";
    }
  }

  /**
   * @file
   * Check if needed tables exist.
   */
  public function CheckIfTablesExist() {
    global $pdo;

    $database_select_table = "SHOW TABLES LIKE 'user234'";
    $query = $pdo->prepare($database_select_table);
    $query->execute();
    $CheckTableExist = $query->fetch(PDO::FETCH_ASSOC);
    if ($CheckTableExist) {
      echo 'Table exist: :NAME:';
    }
    else {
      echo 'Table is not existing :CREATE: <br/>';
      $this->CreateDatabaseTables();
      return FALSE;
    }
  }

  /**
   * @file
   * If there no need tables than create tables.
   */
  public function CreateDatabaseTables() {
    echo "<br/> Test if it whil go to the next function if the tables dos not exist";
  }

}
