<?php
/**
  * @package MaxPlugin
  */
  
namespace Inc\Base;  

class Activate
{
  public static function activate() {
    flush_rewrite_rules();

    if ( get_option( 'max_plugin' ) ) {
      return;
    }

    $default = array();

    update_option( 'max_plugin', $default );
  }
}  