<?php
/**
 * Main Plugin Functions
 *
 * @package hawaiian-howdy
 * @since 1.0.0
 */

// Exit if file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'gs808hh_make_hawaiian_howdy' ) ) {
	/**
	 * Generate the text to replace the "Howdy" greeting.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Admin_Bar $wp_admin_bar The current hour to base the greeting on.
	 * @return string The time-based Hawaiian Greeting.
	*/
	function gs808hh_make_hawaiian_howdy( $wp_admin_bar ) {
	    $message = '';
	    //$current_date_time = getdate();
	    $current_date_time = current_time( 'mysql' );
		$testtime = current_time( 'mysql' );
	    $current_hour = current_time( 'H' );
	    //$current_day = $current_date_time['wday'];
		$current_day = date( 'l', current_time( 'timestamp', 0 ) );
		
		$options = get_option( 'gs808hh_options', gs808hh_options_default() );

	    $display_hawaiian_greeting = isset( $options['display_hawaiian_greeting'] ) && ! empty( $options['display_hawaiian_greeting'] );

		$display_aloha_friday = isset( $options['display_aloha_friday'] ) && ! empty( $options['display_aloha_friday'] );

	    $my_account_node = $wp_admin_bar->get_node( 'my-account' );

	    if ( $display_hawaiian_greeting && $display_aloha_friday ) {
			$message = gs808hh_get_hawaiian_message ( $current_hour );

			if ( GS808HH_FRIDAY === $current_day ) {
	            $message .= ' and ' . GS808HH_MESSAGE_ALOHA_FRIDAY;
			}
        } elseif ( $display_hawaiian_greeting ) {
			$message = gs808hh_get_hawaiian_message ( $current_hour );
		} elseif ( $display_aloha_friday ) {
			// If today is Friday
			if ( GS808HH_FRIDAY === $current_day ) {
				$message = GS808HH_MESSAGE_ALOHA_FRIDAY;
			}
		} // End if ( $display_hawaiian_greeting && $display_aloha_friday)

		/* Check if the 'my-account' node exists.  Only set message
		 * if replacement text isn't empty.
		 */
	    if ( $my_account_node && ( '' != $message ) ) {
	        $new_title = str_replace ( 'Howdy', esc_html__( $message, 'hawaiian-howdy' ), $my_account_node->title );
	        $wp_admin_bar->add_node( array(
	            'id'    => 'my-account',
	            'title' =>  $new_title,
	        ) );
	    }
	}
	add_filter( 'admin_bar_menu', 'gs808hh_make_hawaiian_howdy' );
}

if ( ! function_exists( 'gs808hh_get_hawaiian_message' ) ) {
	/**
	 * Set the time-based message to display.
	 *
	 * @since 1.0.0
	 *
	 * @param date $the_hour The current hour to base the greeting on.
	 * @return string The time-based Hawaiian Greeting.
	*/
	function gs808hh_get_hawaiian_message( $the_hour ) {
		/* Set the greeting based on time of day
		 * Midnight-10:59 am:  Aloha K&#xe4;kahiaka (Good Morning)
		 * 11:00am-12:59pm  Aloha Awakea (Good Day)
		 * 1:00pm-4:59pm  Aloha 'Auinal&#xe4; (Good Afternoon)
		 * 5:00pm-11:59pm  Aloha Ahiahi (Good Evening)
		 */
		switch ( $the_hour ) {
			case ( ( $the_hour >= 0 ) && ( $the_hour < 11 ) ):
				return GS808HH_MESSAGE_MORNING;
			case ( ( $the_hour >= 11 ) && ( $the_hour < 13 ) ):
				return GS808HH_MESSAGE_DAY;
			case ( ( $the_hour >= 13 ) && ( $the_hour < 17 ) ):
				return GS808HH_MESSAGE_AFTERNOON;
			case ( ( $the_hour >= 17 ) && ( $the_hour < 24 ) ):
				return GS808HH_MESSAGE_EVENING;
			default:
				return GS808HH_MESSAGE_DEFAULT;
		}
	}
}
