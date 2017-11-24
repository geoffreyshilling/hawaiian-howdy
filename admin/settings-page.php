<?php
/**
 * Create the settings page
 *
 * @package hawaiian-howdy
 * @since 1.0.0
 */

// Exit if file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'gs808hh_display_settings_page' ) ) {
	/**
	 * Create the settings page.
	 *
	 * @since 1.0.0
	 */
	function gs808hh_display_settings_page() {
		// check if user is allowed access
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		?>
		<div class="wrap">
			<h1><?php esc_html_e( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php

				// output security fields
				settings_fields( 'gs808hh_options' );

				// output setting sections
				do_settings_sections( 'hawaiian-howdy' );

				// submit button
				submit_button();

				wp_nonce_field( 'gs808hh_form_action', 'gs808hh_form_action', false );

				?>
			</form>
		</div>
		<?php
	}
}
