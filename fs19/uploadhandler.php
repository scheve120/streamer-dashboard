<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/**
* The upload handler
*/
class Uploader
{
  // upload function
  private function SetFileFormVariables()
  {
    $filearray = array(
      'UploadDir' => 'tempupload/',
      'file_name' => $_FILES["Savegame_zip"]["name"],
      'file_type' => $_FILES["Savegame_zip"]["type"],
      'file_size' => $_FILES["Savegame_zip"]["size"],
      'file_source' => $_FILES["Savegame_zip"]["tmp_name"]);
      return $filearray;

    }
    private function FormFilesManager ()
    {
    $my_set__file_form_variables = $this->set_file_form_variables();

      echo 'test upload class function';
      // setting cvariables
      $name = explode(".", $file_name); #Seperates the name from the file type
      $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
      // check if file is zip
      if(isset($_POST["submit"])){
        echo '</br>test of if submit werkt';
        if($_FILES["Savegame_zip"]["name"]){
          echo 'if there is file';
          foreach ($accepted_types as $type) {
            echo '</br> test of foreach draait';
            if($type === $mySetFileFormVariables['file_type']){
              echo '</br> check if else working';
              $file_check = TRUE;
              break;
            }
          }
        }
        if(!$file_check){
          echo 'stop';
          return FALSE;
        }
        return TRUE;
      }
    }
    public function upload()
    {
      $move_uploaded = $this->SetFileFormVariables ();
      echo 'last part before moving file';
      if($this->FormFilesManager()){
        move_uploaded_file($move_uploaded['file_source'],$move_uploaded['UploadDir'].$move_uploaded['file_name']);
      }
    }

}

?>
