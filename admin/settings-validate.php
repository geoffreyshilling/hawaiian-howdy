<?php
/**
 * Validate settings input
 *
 * @package hawaiian-howdy
 * @since 1.0.0
 */

// Exit if file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'gs808hh_validate_options' ) ) {
	/**
	 * Validate settings options.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $input An array of options to validate.
	 * @return array An array of validated options.
	 */
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
