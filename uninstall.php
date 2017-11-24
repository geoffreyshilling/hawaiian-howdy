<?php
/**
 * Create plugin uninstall
 *
 * @package hawaiian-howdy
 * @since 1.0.0
 */

// Exit if file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if uninstall constant is not defined.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete the plugin options.
delete_option( 'gs808hh_options' );
