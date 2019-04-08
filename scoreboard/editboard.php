<?php

// include 'functions.php';

$connect = $GLOBALS['databaseconnect'];
$selectDatabasePlayerkill = "SELECT * FROM scoreboard";
$getDatabasePlayerkill = "SELECT * FROM scoreboard ORDER BY Score_ID";
$PlayerkilltableGetRow = mysqli_query($connect, $selectDatabasePlayerkill);
$GETPlayerkilltableGetRow = mysqli_query($connect, $getDatabasePlayerkill);

// verhuizen naar editboard.php
if ($_SESSION["user_online"]) {
  EditboardPanel();
}

function EditboardPanel() {
  $connect = $GLOBALS['databaseconnect'];
  $selectDatabasePlayerkill = "SELECT * FROM scoreboard";
  $getDatabasePlayerkill = "SELECT * FROM scoreboard ORDER BY Score_ID";
  $PlayerkilltableGetRow = mysqli_query($connect, $selectDatabasePlayerkill);
  $GETPlayerkilltableGetRow = mysqli_query($connect, $getDatabasePlayerkill);
  echo "<h1>";
  echo "<table border=1>";
  echo "<tr>";
  echo "<th> ID</th>";
  echo "<th> Kill name </th>";
  echo "<th> Eddit </th>";
  echo "<th> Kill + </th>";
  echo "<th> Add </th>";
  echo "<th> Add multiple </th>";
  echo "<th> Kill - </th>";
  echo "<th> Add </th>";
  echo "<th> Add multiple </th>";
  echo "<th> ratio </th>";
  echo "<th> date </th>";
  echo "<th> Update manual </th>";
  echo "<th> Update </th>";
  echo "<th> delete </th>";
  echo "</tr>";

  if($databaseconnect === FALSE) {  // <- moet nog variable voor aan genmaakt worden om verbinding naar table en database te maken
    die("Error ik kan table niet vinden" . mysqli_connect_error());
    return;
  }

  if(mysqli_num_rows($PlayerkilltableGetRow) > 0) {
      while($scorreboard = mysqli_fetch_array($GETPlayerkilltableGetRow,MYSQLI_ASSOC)) {
        $IDscoreboard = $scorreboard["Score_ID"];
        $kill_name = $scorreboard["kill_name"];
        $kill_plus = $scorreboard["kill_plus"];
        $kill_minus = $scorreboard["kill_minus"];
        $ratio = $scorreboard["ratio"];
        $Killdate = $scorreboard["date"];
        echo '<tr>';
        echo '<form action="" method=post name=scoreboard>';
        echo '<td>'. $scorreboard["Score_ID"] . '</td>';
        echo '<input type="hidden" name="getlastid" value=">'. $IDscoreboard .'">';
        echo '<td>'. $kill_name . '</td>';
        echo '<td>'. '<input type="text" name="killnameedit1" value="'.$kill_name . '"><input type="submit" name="killnameedit" value="Edit"></td>';
        echo '<td>'. $kill_plus . '</td>';
        echo '<td>'. '<input type="submit" name="addkill" value="+1">' . '</td>';
        echo '<td>'. '<input type="number" size="6" name="addkillnumber"><input type="submit" name="sendkillnumber" value="Send"></td>';
        echo '<input type="hidden" name="killplus" value="'.$kill_plus.'">';
        echo '<td>'. $kill_minus . '</td>';
        echo '<td>'. '<input type="submit" name="minuskill" value="+1">' . '</td>';
        echo '<td>'. '<input type="number" name="minuskillnumber"><input type="submit" name="sendminuskillsend" value="Send"> </td>';
        echo '<input type="hidden" name="killminus" value="'.$kill_minus.'">';
        echo '<td>'. $killdate . '</td>';
        echo '<td>'. $ratio . '</td>';
        echo '<td>'. '<input type=date name=date><input type="submit" name="datesend" value="Send"></td>';
        echo '<input type="hidden" name="Killdate" value="'.$Killdate.'">';
        echo '<td>'. '<input type="submit" name="update" value="Update"> </td>';
        echo '<td>'. '<input type="submit" name="Delete" value="Delete"> </td>';
        echo '<input type="hidden" name="custID" value="'.$IDscoreboard.'">';
        echo '<input type="hidden" name="killname" value="'.$kill_name.'">';
        echo '</form>';
        echo '</tr>';
      }
    } else {
      echo "<tr class=warning>";
      echo "<td> No data </td>";
      echo "<td> No data </td>";
      echo "<td> No data </td>";
      echo "<td> No data </td>";
      echo "</tr>";
    }
  echo "</table>";
  echo "</h1>";

  echo "</table>";
  echo "</h1>";
  echo "<form action='' method='post' name='scoreboard-killname'>";
  echo "<input type='text' name='kill_type' placeholder='Submit kill type'>";
  echo "<input type='submit' name='send_killtype' value='Send'>";
  echo "</form>";
}

if(isset($_POST['Delete'])) {
  $deleteKill = "DELETE FROM scoreboard WHERE Score_ID='".$_POST['custID']."'";
  mysqli_query($connect,$deleteKill);
  echo "<meta http-equiv='refresh' content='1'>";
  print "ID: ". $_POST['custID']. " ";
  print $_POST["killname"];
  echo " Is verwijdert";
}
if(isset($_POST['addkill'])) {
  $killPluseen = $_POST['killplus'] + 1;
  $killPluseenaddDatabase = "UPDATE scoreboard SET kill_plus='".$killPluseen."' WHERE Score_ID='".$_POST['custID']."'";
  mysqli_query($connect,$killPluseenaddDatabase);
  echo "<meta http-equiv='refresh' content='1'>";
  echo $killPluseen;
  echo "ik update de kill";
}

if(isset($_POST['sendkillnumber'])) {
  $killplussnumber = $_POST['killplus'] + $_POST['addkillnumber'];
  $killPlusNumberaddDatabase = "UPDATE scoreboard SET kill_plus='".$killplussnumber."' WHERE Score_ID='".$_POST['custID']."'";
  mysqli_query($connect,$killPlusNumberaddDatabase);
  echo "<meta http-equiv='refresh' content='1'>";
  echo '<br/>'. $killplussnumber;
  echo "  test of de handmatig nummer invoer werkt";
}

if(isset($_POST['minuskill'])) {
  $killminus = $_POST['killminus'] +1;
  $killMinuseenaddDatabase = "UPDATE scoreboard SET kill_minus='".$killminus."' WHERE Score_ID='".$_POST['custID']."'";
  mysqli_query($connect,$killMinuseenaddDatabase);
  echo "<meta http-equiv='refresh' content='1'>";
  echo '<br/>'. $killminus;
  echo "  Test of kill dood wordt toegevoegd";
}

if(isset($_POST['sendminuskillsend'])) {
  $killminusnumber = $_POST['killminus'] + $_POST['minuskillnumber'];
  $killMinusNumberaddDatabase = "UPDATE scoreboard SET kill_minus='".$killminusnumber."' WHERE Score_ID='".$_POST['custID']."'";
  mysqli_query($connect,$killMinusNumberaddDatabase);
  echo "<meta http-equiv='refresh' content='1'>";
  echo '<br/>'. $killminusnumber;
  echo "  test of de handmatig nummer invoer werkt";
}

if(isset($_POST['killnameedit'])) {
  $NameEdit = $_POST['killnameedit1'];
  $killNameEditDatabase = "UPDATE scoreboard SET kill_name='".$NameEdit."' WHERE Score_ID='".$_POST['custID']."'";
  mysqli_query($connect,$killNameEditDatabase);
  echo "<meta http-equiv='refresh' content='1'>";
  echo '<br/>'. $killNameEditDatabase;
  echo "  Naam is gewijzigd";
}
