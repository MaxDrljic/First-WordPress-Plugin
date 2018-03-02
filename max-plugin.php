<?php
/**
  * @package MaxPlugin
  */
/*
Plugin Name: Max Plugin
Plugin URI: http://max.com
Description: This is my first attempt to write custom plugin.
Version: 1.0.0
Author: Max Drljić
Author URI: http://max.com
License: GPLv2 or later
Text Domain: max-plugin
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

Copyright 2005-2015 Automattic, Inc.
*/

defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, run away!' );

if ( !class_exists( 'MaxPlugin' ) ) {

  class MaxPlugin
  {

    public $plugin;

    function __construct() {
      $this->plugin = plugin_basename( __FILE__ );
    }

    function register() {
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

      add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
      
      add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
    }

    public function settings_link( $links ) {
      $settings_link = '<a href="admin.php?page=max_plugin">Settings</a>';
      array_push( $links, $settings_link );
      return $links;
    }

    public function add_admin_pages() {
      add_menu_page( 'Max Plugin', 'Max', 'manage_options', 'max_plugin', array( $this, 'admin_index' ), 'dashicons-store', 110 );
    }

    public function admin_index() {
      require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
    }

    protected function create_post_type() {
      add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    function custom_post_type() {
      register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
    }

    function enqueue() {
      // enqueue all our scripts
      wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
      wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
    }

    function activate() {
      require_once plugin_dir_path( __FILE__ ) . 'inc/max-plugin-activate.php';
      MaxPluginActivate::activate();
    }
  }

    $maxPlugin = new MaxPlugin();
    $maxPlugin->register();


  // activation
  register_activation_hook( __FILE__, array( $maxPlugin, 'activate' ) );

  // deactivation
  require_once plugin_dir_path( __FILE__ ) . 'inc/max-plugin-deactivate.php';
  register_deactivation_hook( __FILE__, array( 'MaxPluginDeactivate', 'deactivate' ) );

}
