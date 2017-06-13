<?php
/*
Plugin Name: Hawaiian Howdy
Plugin URI: 	https://geoffreyshilling.com/plugins/hawaiian-howdy/
Description: 	Hawaiianizes the "Howdy" message displayed in the top right corner for users when they are logged in, based on time of day.
Version: 		1.1.2
Author: 		Geoffrey Shilling
Author URI: 	https://geoffreyshilling.com/
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

if ( ! defined( 'HAWAIIAN_HOWDY_FILE' ) ) {
	define( 'HAWAIIAN_HOWDY_FILE', __FILE__ );
}

// Load Hawaiian Howdy options page.
require_once( dirname( HAWAIIAN_HOWDY_FILE ) . '/options.php' );

if( is_admin() )
    $my_settings_page = new MySettingsPage();

class WPA_Hawaiian_Howdy {
  function __construct() {
	   add_filter( 'admin_bar_menu', array( $this, 'hawaiianize_howdy' ), 25 );

          add_action('admin_menu', 'wporg_options_page');
          add_action('admin_menu', 'wpdocs_my_plugin_menu');
          add_action('admin_menu', 'add_custom_link_into_appearnace_menu');
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

    /* Add Happy Aloha Friday greeting if it is Friday.  This will be appended
     * at the end of the message.  $current_day will be 0-6, with Sunday being
     * 0.
     */
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


  function wporg_options_page_html()
  {
      // check user capabilities
      if (!current_user_can('manage_options')) {
          return;
      }
      ?>
      <div class="wrap">
          <h1><?= esc_html(get_admin_page_title()); ?></h1>
          <form action="options.php" method="post">
              <?php
              // output security fields for the registered setting "wporg_options"
              settings_fields('wporg_options');
              // output setting sections and their fields
              // (sections are registered for "wporg", each field is registered to a specific section)
              do_settings_sections('wporg');
              // output save settings button
              submit_button('Save Settings');
              ?>
          </form>
      </div>
      <?php
  }



} // End class WPA_Hawaiian_Howdy


$hawaiian_greetings = new WPA_Hawaiian_Howdy();
