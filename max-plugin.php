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

// If this file is called direactly, abort!
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, run away!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
  require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_max_plugin() {
  Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_max_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_max_plugin() {
  Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_max_plugin' );

if ( class_exists( 'Inc\\Init' ) ) {
  Inc\Init::register_services();
}