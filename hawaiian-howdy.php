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
    $current_hour = current_time( 'H' );

    /* Set the greeting based on time of day
     * Midnight-10:59 am:  Aloha K&#xe4;kahiaka (Good Morning)
     * 11:00am-12:59pm  Aloha Awakea (Good Day)
     * 1:00pm-4:59pm  Aloha 'Auinal&#xe4; (Good Afternoon)
     * 5:00pm-11:59pm  Aloha Ahiahi (Good Evening)
     */
    switch ( $current_hour) {
      case ( ( $current_hour >= 0 ) && ( $current_hour < 11 ) ):
        $message .= 'Aloha K&#xe4;kahiaka (Good Morning)';
        break;
      case (($current_hour >= 11 ) && ($current_hour < 13 ) ):
        $message .= 'Aloha Awakea (Good Day)';
        break;
      case ( ( $current_hour >= 13 ) && ($current_hour < 17 ) ):
        $message .= "Aloha 'Auinal&#xe4; (Good Afternoon)";
        break;
      case ( ( $current_hour >= 17 ) && ( $current_hour < 24 ) ):
        $message .= 'Aloha Ahiahi (Good Evening)';
        break;
      default:
        $message .= 'Aloha';
        break;
    }

    $new_title   = str_replace ( 'Howdy', $message, $my_account->title );
    $wp_admin_bar->add_node( array(
        'id'    => 'my-account',
        'title' => $new_title,
    ) );
  } // End hawaiianize_howdy

} // End class WPA_Hawaiian_Howdy
$hawaiian_greetings = new WPA_Hawaiian_Howdy();
