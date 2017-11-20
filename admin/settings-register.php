<?php // Hawaiian Howdy - Settings Register

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// register plugin settings
function gs808hh_register_settings() {

	/*

	register_setting(
		string   $option_group,
		string   $option_name,
		callable $sanitize_callback
	);

	*/

	register_setting(
		'gs808hh_options',
		'gs808hh_options',
		'gs808hh_validate_options'
	);

	/*

	add_settings_section(
		string   $id,
		string   $title,
		callable $callback,
		string   $page
	);

	*/

	add_settings_section(
		'gs808hh_section_greetings',
		esc_html__( 'Hawaiian Greetings', 'hawaiian-howdy' ),
		'gs808hh_callback_section_greetings',
		'hawaiian-howdy'
	);

	/*

add_settings_field(
	string   $id,
	string   $title,
	callable $callback,
	string   $page,
	string   $section = 'default',
	array    $args = []
);

*/

	add_settings_field(
		'display_hawaiian_greeting',
		esc_html__( 'Display Hawaiian Greeting', 'hawaiian-howdy' ),
		'gs808hh_callback_field_checkbox',
		'hawaiian-howdy',
		'gs808hh_section_greetings',
		[ 'id' => 'display_hawaiian_greeting', 'label' => esc_html__( 'Display custom greetings based on time of day', 'hawaiian-howdy' ) ]
	);

	add_settings_field(
		'display_aloha_friday',
		esc_html__( 'Display Aloha Friday', 'hawaiian-howdy' ),
		'gs808hh_callback_field_checkbox',
		'hawaiian-howdy',
		'gs808hh_section_greetings',
		[ 'id' => 'display_aloha_friday', 'label' => esc_html__( 'Display Aloha Friday on Fridays', 'hawaiian-howdy' ) ]
	);



}
add_action( 'admin_init', 'gs808hh_register_settings' );
