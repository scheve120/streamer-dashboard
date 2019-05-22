<?php
require_once 'variables.php';
include 'functions.php';
// require_once "../sql/mysql.php";

$page = $_SERVER['PHP_SELF'];
$sec = "20";

// scoreboardTable();
#addkilltype();
// addkillPlayer();

echo "<br/>";
echo "<br/>";
echo "<h1>";
echo "<table border=1>";
echo "<tr>";
echo "<th> Kill name </th>";
echo "<th> Kill + </th>";
echo "<th> Kill - </th>";
echo "<th> Ratio </th>";
echo "<th> date </th>";
echo "</tr>";
if(mysqli_num_rows($GETPlayerkilltableGetRow) > 0){
    while($scorreboard = mysqli_fetch_array($GETPlayerkilltableGetRow,MYSQLI_ASSOC)){
      $IDscoreboard = $scorreboard["Score_ID"];
      $kill_name = $scorreboard["kill_name"];
      $kill_plus = $scorreboard["kill_plus"];
      $kill_minus = $scorreboard["kill_minus"];
      $ratio = $scorreboard["ratio"];
      $Killdate = $scorreboard["date"];
      echo "<tr style= background-color: red;'>";
      echo "<td>". $kill_name . "</td>";
      echo "<td>". $kill_plus . "</td>";
      echo "<td>". $kill_minus . "</td>";
      echo "<td>". "NON" . "</td>";
      echo "<td>". $killdate . "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr class=warning>";
    echo "<td> No data </td>";
    echo "<td> No data </td>";
    echo "<td> No data </td>";
    echo "<td> No data </td>";
    echo "</tr>";
  }

 ?>
<html>

<head>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'"></meta>
<link rel="stylesheet" type="text/css" href="scoreboard.css">
</head>
</body>

</html>
