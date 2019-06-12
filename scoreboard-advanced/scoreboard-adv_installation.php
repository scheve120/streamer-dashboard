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

  private $dbCreateTableQuery = 'CREATE TABLE `scoreboard_adv` (
      `board_ID` int(200) NOT NULL,
      `board_name` varchar(50) NOT NULL,
      `board_data` varchar(250) NOT NULL,
      `board_theme` varchar(250) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci';

  // Setting database variables.
  function __construct() {

  }

  public function InputFormHandler() {
    // Starting Database test function. If not fount than create the tables.
    if (isset($_POST['test-db'])) {
      $this->CheckIfTablesExist();
      return array(
        'table-exist' => TRUE,
      );
    }

    if (isset($_POST['test-create'])) {
      $this->CreateDatabaseTables();
      return array(
        'table-exist' => FALSE,
      );
    }
  }

  /**
   * @file
   * Check if needed tables exist.
   */
  public function CheckIfTablesExist() {
    global $pdo;

    $database_select_table = "SHOW TABLES LIKE 'scoreboard_adv'";
    $query = $pdo->prepare($database_select_table);
    $query->execute();
    $CheckTableExist = $query->fetch(PDO::FETCH_ASSOC);
    if ($CheckTableExist) {
      return array(
        'table-exist' => TRUE,
      );
    }
    else {
      $this->CreateDatabaseTables();
      return array(
        'table-exist' => FALSE,
      );
    }
  }

  /**
   * @file
   * If there no need tables than create tables.
   */
  public function CreateDatabaseTables() {
    global $pdo;

    // $InstallTable = $pdo->prepare($this->dbCreateTableQuery);
    $result = $pdo->exec($this->dbCreateTableQuery);
    try {
      $result;
    } catch (PDOException $e){
      echo $e;
      throw $e;
    }
  }

}