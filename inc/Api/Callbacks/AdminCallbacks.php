<?php
/**
* @package MaxPlugin
*/
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
  public function adminDashboard()
  {
    return require_once( "$this->plugin_path/templates/admin.php" );
  }

  /* public function maxOptionsGroup( $input )
  {
    return $input;
  }

  public function maxAdminSection()
  {
    echo 'Check this beautiful section!';
  } */

  public function maxTextExample()
  {
    $value = esc_attr( get_option( 'text_example' ) );
    echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!" />';
  }

  public function maxFirstName()
  {
    $value = esc_attr( get_option( 'first_name' ) );
    echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Your First Name!" />';
  }
}