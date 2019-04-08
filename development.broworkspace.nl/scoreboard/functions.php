<?php
require_once 'variables.php';


print "<h1>". $addplayerkill. "</h1>";

// PHP Database function variables
//$connect = $GLOBALS['dbconnection']; #Global variable for connecting to database
function add_kill_type() {

  $connect = $GLOBALS['databaseconnect'];
  #$PlayerkilltableGetRow = mysqli_query($connect,$SQLsubmitNamme);
  if ($GLOBALS['databaseconnect'] === FALSE) {  // <- moet nog variable voor aan genmaakt worden om verbinding naar table en database te maken
    die ("Error ik kan table niet vinden" . mysqli_connect_error());
    return;
  }
  if (isset($_POST["kill_type"])) {
    $killType = $_POST["kill_type"];
    $SQLsubmitNamme = "INSERT INTO scoreboard (kill_name) VALUES ('$killType')";
    if (mysqli_query($connect,$SQLsubmitNamme)) {
      $lastkillID = mysqli_insert_id($connect);
      echo "Setting last killname ID". $lastkillID;
    }
    echo "<meta http-equiv='refresh' content='5'>";
    echo "Kill log voor: ". $_POST["kill_type"] . " Is toegevoegd";
    return $killType;
  }


}
//var_dump($connect);
function addkillPlayer() {
  #database variables
  $addplayerkill = $_POST["playerkillPlus"]; #Player kill +
  $connect = $GLOBALS['databaseconnect'];
  $selectDatabasePlayerkill = "SELECT Score_ID, kill_name, kill_plus FROM scoreboard";
  $addKillTooDatabase = "UPDATE scoreboard SET kill_plus=1 WHERE Score_ID=1";
  $PlayerkilltableGetRow = mysqli_query($connect, $selectDatabasePlayerkill);
#  var_dump(mysqli_num_rows($PlayerkilltableGetRow));
    if (isset( $_POST["playerkillPlus"])) {
      echo "I am Running Part 1";
      if (mysqli_num_rows($PlayerkilltableGetRow) === 0) {
        mysqli_query($connect,$addKillTooDatabase);
        var_dump(mysqli_query($connect,$addKillTooDatabase));
        echo "Run part 2";
      } elseif (mysqli_num_rows($PlayerkilltableGetRow) > 0) {
        mysqli_query($connect,$addKillTooDatabase);
        echo "Run part 3 whil adding";
        while ($plauyerkill = mysqli_fetch_row($PlayerkilltableGetRow)) {
          echo "<br/><h1> test of fetch row werkt</h1>";
          echo $plauyerkill[0];
          $playerkillupdate = $plauyerkill[0];
        }
        if ($playerkillupdate === $playerkillupdate) {
          $updatekill = "UPDATE scoreboard SET player_kill='$plauyerkill[0]' WHERE player_kill='+1'";
          mysqli_query($connect, $updatekill);
        }
      }
    }
}

function scoreboardTable() {
  $connect = $GLOBALS['databaseconnect'];
  $selectDatabasePlayerkill = "SELECT * FROM scoreboard";
  $getDatabasePlayerkill = "SELECT * FROM scoreboard ORDER BY Score_ID";
  $PlayerkilltableGetRow = mysqli_query($connect, $selectDatabasePlayerkill);
  $GETPlayerkilltableGetRow = mysqli_query($connect, $getDatabasePlayerkill);
  #$PlayerkilltableGetRow = mysqli_query($connect,$SQLsubmitNamme);
  if ($GLOBALS['databaseconnect'] === FALSE) {  // <- moet nog variable voor aan genmaakt worden om verbinding naar table en database te maken
    die ("Error ik kan table niet vinden" . mysqli_connect_error());
    return;
  }
  if (mysqli_num_rows($PlayerkilltableGetRow) === 0) {
    echo "There no kill boards";
  } elseif (mysqli_num_rows($PlayerkilltableGetRow) > 0) {
      while ($scorreboard = mysqli_fetch_array($GETPlayerkilltableGetRow,MYSQLI_ASSOC)) {
        #echo "ID: ", $scorreboard["ID"]," Kill name: " ,$scorreboard["kill_name"]," Kills +",$scorreboard["kill_plus"],"<br/>";
      }
  }
}
