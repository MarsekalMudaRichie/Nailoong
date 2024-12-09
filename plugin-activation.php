<?php
/**
 * TGM PLUGIN ACTIVATION
 *
 * Activates plugins needed by theme
 *
 * @package  Cerebro
 */

// Activate TGM Class
require_once get_template_directory() . '/inc/apis/class-tgm-plugin-activation.php';

if ( ! function_exists( 'cerebro_register_plugins' ) ) {
	function cerebro_register_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__( 'Jetpack', 'cerebro' ), // The plugin name
				'slug'               => 'jetpack', // The plugin slug (typically the folder name)
                'required'           => true, // If false, the plugin is only 'recommended' instead of required
			),
			array(
				'name'               => esc_html__( 'MailChimp List Subscribe Form', 'cerebro' ), // The plugin name
				'slug'               => 'mailchimp', // The plugin slug (typically the folder name)
				'required'           => false, // If false, the plugin is only 'recommended' instead of required
			),
			array(
				'name'               => esc_html__( 'Kirki', 'cerebro' ), // The plugin name
				'slug'               => 'kirki', // The plugin slug (typically the folder name)
				'required'           => true, // If false, the plugin is only 'recommended' instead of required
			),
		);

		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.

		);
		tgmpa( $plugins, $config );
	} // function
	add_action( 'tgmpa_register', 'cerebro_register_plugins' );
} // if
