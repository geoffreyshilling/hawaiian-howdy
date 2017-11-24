<?php
/**
 * Callbacks for the settings pages
 *
 * @package hawaiian-howdy
 * @since 1.0.0
 */

// Exit if file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'gs808hh_callback_section_greetings' ) ) {
	/**
	 * Create the greetings section on the settings page.
	 *
	 * @since 1.0.0
	 */
	function gs808hh_callback_section_greetings() {
		echo '<p>';
		esc_html_e( 'These settings enable you to customize the Hawaiian greeting that replaces the "Howdy" text.', 'hawaiian-howdy' );
		echo '</p>';
	}
}

if ( ! function_exists( 'gs808hh_callback_field_checkbox' ) ) {
	/**
	 * Create the greetings section on the settings page.
	 *
	 * @since 1.0.0
	 */
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

		?>
		<input id="gs808hh_options_<?php echo $id ?>" name="gs808hh_options[<?php echo $id ?>]" type="checkbox" value="1"  <?php echo $checked ?>'>
		<label for="gs808hh_options_<?php echo $id ?>"><?php echo $label ?></label>
		<?php
	}
}
