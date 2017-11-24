<?php
/*
Plugin Name:    Hawaiian Howdy
Plugin URI: 	https://geoffreyshilling.com/plugins/hawaiian-howdy
Description: 	Hawaiianizes the "Howdy" message displayed in the top right corner for users when they are logged in, based on time of day.
Version: 		1.0.0
Domain Path:    /languages
Author: 		Geoffrey Shilling
Author URI: 	https://geoffreyshilling.com
License:     	GPL2
License URI: 	https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:    hawaiian-howdy


Hawaiian Howdy is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Hawaiian Howdy is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Hawaiian Howdy. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

// Exit if file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'gs808hh_load_textdomain' ) ) {
	/**
	* Loads the plugin language files.
	*
	* @since 1.0
	*/
	function gs808hh_load_textdomain() {
		load_plugin_textdomain( 'hawaiian-howdy', false, plugin_dir_path( __FILE__ ) . 'languages/' );
	}
	add_action( 'plugins_loaded', 'gs808hh_load_textdomain' );
}



// if admin area
if ( is_admin() ) {
	// include dependencies
	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/core-functions.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
}

if ( ! function_exists( 'gs808hh_options_default' ) ) {
	/**
	 * Set default values for what messages to display.
	 *
	 * @since  1.0.0
	 *
	 * @return array The message options
	 */
	function gs808hh_options_default() {
		return array(
			'display_hawaiian_greeting'	=> true,
			'display_aloha_friday'   	=> true,
		);
	}
}
