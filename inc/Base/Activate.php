<?php
/**
  * @package MaxPlugin
  */
  
namespace Inc\Base;  

class Activate
{
  public static function activate() {
    flush_rewrite_rules();

    $default = array();

    if ( ! get_option( 'max_plugin' ) ) {
      update_option( 'max_plugin', $default );
    }

    if ( ! get_option( 'max_plugin_cpt' ) ) {
      update_option( 'max_plugin_cpt', $default );
    }
  }
}  