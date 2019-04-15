<?php

/**
 * @file
 * This file whil load the needing files.
 */

if (file_exists('file.php') {

}

/**
 * This function whil load the templates.
 */
function load_template($template_path, $variables = array()) {
  extract($variables);

  ob_start();

  include $template_path;
  $rendered_template = ob_get_contents();

  ob_end_clean();
  return $rendered_template;
}
