<?php
/*
Plugin Name: Hawaiian Howdy
Plugin URI: 	https://wpadventure.com/plugins/hawaiian-howdy
Description: 	Hawaiianizes the "Howdy" message displayed in the top right corner for users when they are logged in, based on time of day.
Version: 		1.0.0
Author: 		Geoffrey Shilling
Author URI: 	https://wpadventure.com
License:     	GPL2
License URI: 	https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: hawaiian-howdy

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


class WPA_Hawaiian_Howdy {
  function __construct() {
	   add_filter( 'admin_bar_menu', array( $this, 'hawaiianize_howdy' ), 25 );
  }

  //References  https://codex.wordpress.org/Function_Reference/get_node
  //https://wordpress.stackexchange.com/questions/227957/i-changed-howdy-in-the-admin-bar-in-the-dashboard-but-when-im-viewing-the-si
  function hawaiianize_howdy( $wp_admin_bar ) {
    $my_account = $wp_admin_bar->get_node( 'my-account' );
    $message = "";
    $current_date_time = getdate();
    $current_hour = current_time( 'H' );
    $current_day = $current_date_time[ 'wday' ];
    $MESSAGE_MORNING = 'Aloha K&#xe4;kahiaka (Good Morning)';
    $MESSAGE_DAY = 'Aloha Awakea (Good Day)';
    $MESSAGE_AFTERNOON = "Aloha 'Auinal&#xe4; (Good Afternoon)";
    $MESSAGE_EVENING = 'Aloha Ahiahi (Good Evening)';

    $MESSAGE_DEFAULT = 'Aloha';

    /* Set the greeting based on time of day
     * Midnight-10:59 am:  Aloha K&#xe4;kahiaka (Good Morning)
     * 11:00am-12:59pm  Aloha Awakea (Good Day)
     * 1:00pm-4:59pm  Aloha 'Auinal&#xe4; (Good Afternoon)
     * 5:00pm-11:59pm  Aloha Ahiahi (Good Evening)
     */
    switch ( $current_hour) {
      case ( ( $current_hour >= 0 ) && ( $current_hour < 11 ) ):
        $message .= $MESSAGE_MORNING;
        break;
      case (($current_hour >= 11 ) && ($current_hour < 13 ) ):
        $message .= $MESSAGE_DAY;
        break;
      case ( ( $current_hour >= 13 ) && ($current_hour < 17 ) ):
        $message .= $MESSAGE_AFTERNOON;
        break;
      case ( ( $current_hour >= 17 ) && ( $current_hour < 24 ) ):
        $message .= $MESSAGE_EVENING;
        break;
      default:
        $message .= $MESSAGE_DEFAULT;
        break;
    }

    switch ( $current_day) {
      case ( 6 ):
        $message .= ' and Happy Aloha Friday';
    }

    $new_title   = str_replace ( 'Howdy', $message, $my_account->title );
    $wp_admin_bar->add_node( array(
        'id'    => 'my-account',
        'title' => $new_title,
    ) );
  } // End hawaiianize_howdy

} // End class WPA_Hawaiian_Howdy
$hawaiian_greetings = new WPA_Hawaiian_Howdy();
