<?php // Hawaiian Howdy - Core Functions

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gs808hh_make_hawaiian_howdy( $wp_admin_bar ) {
    $message = "";
    $current_date_time = getdate();
    $current_hour = current_time( 'H' );
    $current_day = $current_date_time[ 'wday' ];

    $MESSAGE_MORNING = 'Aloha K&#xe4;kahiaka (Good Morning)';
    $MESSAGE_DAY = 'Aloha Awakea (Good Day)';
    $MESSAGE_AFTERNOON = "Aloha 'Auinal&#xe4; (Good Afternoon)";
    $MESSAGE_EVENING = 'Aloha Ahiahi (Good Evening)';
    $MESSAGE_DEFAULT = 'Aloha';
    $MESSAGE_ALOHA_FRIDAY = 'Happy Aloha Friday';


    $options = get_option( 'gs808hh_options', gs808hh_options_default() );

    $display_hawaiian_greeting = isset( $options['display_hawaiian_greeting'] ) && ! empty( $options['display_hawaiian_greeting'] );

	$display_aloha_friday = isset( $options['display_aloha_friday'] ) && ! empty( $options['display_aloha_friday'] );

    $my_account_node = $wp_admin_bar->get_node( 'my-account' );

    if ( $display_hawaiian_greeting && $display_aloha_friday ) {
        /* Set the greeting based on time of day
         * Midnight-10:59 am:  Aloha K&#xe4;kahiaka (Good Morning)
         * 11:00am-12:59pm  Aloha Awakea (Good Day)
         * 1:00pm-4:59pm  Aloha 'Auinal&#xe4; (Good Afternoon)
         * 5:00pm-11:59pm  Aloha Ahiahi (Good Evening)
         */
        switch ( $current_hour ) {
            case ( ( $current_hour >= 0 ) && ( $current_hour < 11 ) ):
                $message .= $MESSAGE_MORNING;
                break;
            case (( $current_hour >= 11 ) && ( $current_hour < 13 ) ):
                $message .= $MESSAGE_DAY;
                break;
            case ( ( $current_hour >= 13 ) && ( $current_hour < 17 ) ):
                $message .= $MESSAGE_AFTERNOON;
                break;
            case ( ( $current_hour >= 17 ) && ( $current_hour < 24 ) ):
                $message .= $MESSAGE_EVENING;
                break;
            default:
                $message .= $MESSAGE_DEFAULT;
                break;
        }

        // If today is Friday
        if ( 5 === $current_day ) {
            $message .= ' and ' . $MESSAGE_ALOHA_FRIDAY;
        }

    } elseif ( $display_hawaiian_greeting ) {
        /* Set the greeting based on time of day
         * Midnight-10:59 am:  Aloha K&#xe4;kahiaka (Good Morning)
         * 11:00am-12:59pm  Aloha Awakea (Good Day)
         * 1:00pm-4:59pm  Aloha 'Auinal&#xe4; (Good Afternoon)
         * 5:00pm-11:59pm  Aloha Ahiahi (Good Evening)
         */
        switch ( $current_hour ) {
            case ( ( $current_hour >= 0 ) && ( $current_hour < 11 ) ):
                $message = $MESSAGE_MORNING;
                break;
            case (($current_hour >= 11 ) && ( $current_hour < 13 ) ):
                $message = $MESSAGE_DAY;
                break;
            case ( ( $current_hour >= 13 ) && ( $current_hour < 17 ) ):
                $message = $MESSAGE_AFTERNOON;
                break;
            case ( ( $current_hour >= 17 ) && ( $current_hour < 24 ) ):
                $message = $MESSAGE_EVENING;
                break;
            default:
                $message = $MESSAGE_DEFAULT;
                break;
        }
} elseif ( $display_aloha_friday ) {
	// If today is Friday
	if ( 5 === $current_day ) {
		$message = $MESSAGE_ALOHA_FRIDAY;
	}
} // End if ( $display_hawaiian_greeting && $display_aloha_friday)
	// Check if the 'my-account' node exists
    if( $my_account_node  && ('' != $message )) {
        $new_title   = str_replace ( 'Howdy', esc_html__( $message, 'hawaiian-howdy' ), $my_account_node->title );
        $wp_admin_bar->add_node( array(
            'id'    => 'my-account',
            'title' =>  $new_title,
        ) );
    }

} // hawaiianize_howdy( $wp_admin_bar )
add_filter( 'admin_bar_menu', 'gs808hh_make_hawaiian_howdy' );
