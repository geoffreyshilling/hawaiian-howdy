<?php // Hawaiian Howdy - Settings Validate

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// validate plugin settings
// Create a function called "gs808hh_validate_options" if it doesn't already exist
if ( ! function_exists( 'gs808hh_validate_options' ) ) {
	function gs808hh_validate_options( $input ) {

		
		// display custom time-based greetings
		if ( ! isset( $input['display_hawaiian_greeting'] ) ) {
			$input['display_hawaiian_greeting'] = null;
		}

		// display aloha friday
		if ( ! isset( $input['display_aloha_friday'] ) ) {
			$input['display_aloha_friday'] = null;
		}

		return $input;
	}
}
