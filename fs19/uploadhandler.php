<?php

/**
 * @file
 * The upload handler.
 */

 /**
  * @file
  * File upload class..
  */
class Uploader {

  /**
   * @file
   * Managing the upload form.
   */
  private function setfileformvariables() {
    $filearray = array(
      'uploadDir' => 'tempupload/',
      'file_name' => $_FILES['savegame_zip']['name'],
      'file_type' => $_FILES['savegame_zip']['type'],
      'file_size' => $_FILES['savegame_zip']['size'],
      'file_source' => $_FILES['savegame_zip']['tmp_name'],
    );
    return $filearray;
  }

  /**
   * @file
   * Maninging the files.
   */
  private function formfilesmanager() {
    $my_set_file_form_variables = $this->set_file_form_variables();

    echo 'Test upload class function';
    // Setting cvariables.
    $name = explode(".", $file_name);
    $accepted_types = array(
      'application/zip',
      'application/x-zip-compressed',
      'multipart/x-zip',
      'application/x-compressed',
    );
    // Check if file is zip.
    if (isset($_POST['submit'])) {
      echo '</br>Test of if submit werkt';
      if ($_FILES['savegame_zip']['name']) {
        echo 'If there is file';
        foreach ($accepted_types as $type) {
          echo '</br> Test of foreach draait';
          if ($type === $my_set_file_form_variables['file_type']) {
            echo '</br> Check if else working';
            $file_check = TRUE;
            break;
          }
        }
      }
      if (!$file_check) {
        echo 'Stop';
        return FALSE;
      }
      return TRUE;
    }
  }

  /**
   * @file
   * Starts upload process.
   */
  public function upload() {
    $move_uploaded = $this->setfileformvariables();
    echo 'Last part before moving file';
    if ($this->form_files_manager()) {
      move_uploaded_file($move_uploaded['file_source'], $move_uploaded['uploadDir'] . $move_uploaded['file_name']);
    }
  }

}
