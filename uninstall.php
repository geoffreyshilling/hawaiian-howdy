<?php // Hawaiian Howdy - Uninstall

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// delete the plugin options
delete_option( 'gs808hh_options' );
