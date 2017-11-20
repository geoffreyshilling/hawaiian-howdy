<?php // Hawaiian Howdy - Settings Callbacks

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gs808hh_callback_section_greetings() {

	echo '<p>' . esc_html__( 'These settings enable you to customize the Hawaiian greeting that replaces the "Howdy" text.', 'hawaiian-howdy' ) . '</p>';
}

// callback: checkbox field
function gs808hh_callback_field_checkbox( $args ) {

	$options = get_option( 'gs808hh_options', gs808hh_options_default() );

	if ( isset( $args['id'] ) ) {
		$id = $args['id'];
	} else {
		$id = '';
	}

	if ( isset( $args['label'] ) ) {
		$label = $args['label'];
	} else {
		$label = '';
	}


	if ( isset( $options[$id] ) ) {
		$checked = checked( $options[$id], 1, false );
	} else {
		$checked = '';
	}

	echo '<input id="gs808hh_options_'. $id .'" name="gs808hh_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="gs808hh_options_'. $id .'">'. $label .'</label>';

}
