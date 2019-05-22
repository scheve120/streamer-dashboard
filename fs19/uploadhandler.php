<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/**
* The upload handler
*/
class Uploader
{
  // upload function
  private function set_file_form_variables()
  {
    $filearray = array(
      'UploadDir' => 'tempupload/',
      'file_name' => $_FILES['savegame_zip']['name'],
      'file_type' => $_FILES['savegame_zip']['type'],
      'file_size' => $_FILES['savegame_zip']['size'],
      'file_source' => $_FILES['savegame_zip']['tmp_name']);
      return $filearray;

    }
    private function FormFilesManager ()
    {
    $my_set_file_form_variables = $this->set_file_form_variables();

      echo 'Test upload class function';
      // setting cvariables
      $name = explode(".", $file_name); #Seperates the name from the file type
      $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
      // check if file is zip
      if(isset($_POST['submit'])){
        echo '</br>Test of if submit werkt';
        if($_FILES['savegame_zip']['name']){
          echo 'If there is file';
          foreach ($accepted_types as $type) {
            echo '</br> Test of foreach draait';
            if($type === $my_set_file_form_variables['file_type']){
              echo '</br> Check if else working';
              $file_check = TRUE;
              break;
            }
          }
        }
        if(!$file_check){
          echo 'Stop';
          return FALSE;
        }
        return TRUE;
      }
    }
    public function upload()
    {
      $move_uploaded = $this->set_file_form_variables();
      echo 'Last part before moving file';
      if($this->FormFilesManager()){
        move_uploaded_file($move_uploaded['file_source'],$move_uploaded['UploadDir'].$move_uploaded['file_name']);
      }
    }

}

?>
