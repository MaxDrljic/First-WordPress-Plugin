<?php
/**
* @package MaxPlugin
*/
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
  public function checkboxSanitize( $input )
  {
    /* SOLUTION 1. with filter_var() : */
    // return filter_var($input, FILTER_SANITIZE_NUMBER_INT);

    /* SOLUTION 2. with Boolean checking : */
    return ( isset($input) ? true : false );
  }

  public function adminSectionManager()
  {
    echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the list.';
  }

  public function checkboxField( $args )
  {
    $name = $args['label_for'];
    $classes = $args['class'];
    $checkbox = get_option( $name );
    echo '<div class="' . $classes .'"><input type="checkbox" id="' . $name . '" name="' . $name . '" value="1" class="" ' . ($checkbox ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
  }
}