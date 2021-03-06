<?php
/**
 * Settings admin menu
 *
 * @package hawaiian-howdy
 * @since 1.0.0
 */

// Exit if file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'gs808hh_add_sublevel_menu' ) ) {
	/**
	 * Add sub-level administrative menu.
	 *
	 * @since  1.0.0
	 *
	 */
	function gs808hh_add_sublevel_menu() {
		/*
		add_submenu_page(
			string   $parent_slug,
			string   $page_title,
			string   $menu_title,
			string   $capability,
			string   $menu_slug,
			callable $function = ''
		);
		*/
		add_submenu_page(
			'options-general.php',
			esc_html__( 'Hawaiian Howdy Settings', 'hawaiian-howdy' ),
			esc_html__( 'Hawaiian Howdy', 'hawaiian-howdy' ),
			'manage_options',
			'hawaiian-howdy',
			'gs808hh_display_settings_page'
		);
	}
	add_action( 'admin_menu', 'gs808hh_add_sublevel_menu' );
}
