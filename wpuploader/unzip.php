<?php
  include 'uploadhandler.php';
  $uploadobject = new uploader();
  $uploadobject->upload();

?>

  <form action="" method="get" enctype="multipart/form-data">
    <input type="file" name="file" id="file">
    <input type="submit" name="submit" value="Send file">
  </form>

<form action="" method="post">
  <button name="unzip">  unzip the site </button>
</form>
