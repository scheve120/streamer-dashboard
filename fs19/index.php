<?php
  include 'uploadhandler.php';
  $uploadobject = new Uploader();
  $uploadobject->upload();

?>

  <form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="savegame_zip" id="savegame_zip">
    <input type="submit" name="submit" value="Send file">
  </form>
