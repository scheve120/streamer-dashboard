<?php
// var_dump ($_FILES);
// Includes for the script
  include 'uploadhandler.php';
  $uploadobject = new uploader();
  // $uploadobject->FormFilesManager();
  $uploadobject->upload();

?>
<html>
<head>
  <title> Farming simulator xml parser</title>
</head>
<body>
  <form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="Savegame_zip" id="Savegame_zip">
    <input type="submit" name="submit" value="Send file">
  </form>
</body>
</html>
