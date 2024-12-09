<?php
/**
 * Cerebro Theme Customizer
 *
 * @package Cerebro
 */

// Load Customizer specific functions
require get_template_directory() . '/inc/customizer/functions/customizer-functions.php';
require get_template_directory() . '/inc/customizer/functions/customizer-sanitization.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cerebro_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Remove default Colors section
	$wp_customize->remove_section( 'colors' );


	$my_theme = wp_get_theme();
	if ( $my_theme->exists() ) {
	    $theme_name = $my_theme;
	} else {
	    $theme_name = esc_html__( 'Cerebro', 'cerebro' );
	}

	/**
	 * PANELS AND SECTIONS
	 */

	// Colors panel
	$wp_customize->add_section( 'cerebro_colors_section', array(
		'title'       => esc_html__( 'Color Settings', 'cerebro' ),
		'description' => esc_html__( 'For customizing theme colors', 'cerebro' ),
		'priority'    => 290
	) );

	// Theme options panel
	$wp_customize->add_panel( 'cerebro_options_panel', array(
		'priority'    => 300,
		'capability'  => 'edit_theme_options',
		'title'       => esc_html__( 'Theme Settings', 'cerebro' ),
		'description' => $theme_name . esc_html__( ' Theme Settings', 'cerebro' ),
	) );

	/**
	 * Auto load all customizer settings
	 */
	cerebro_customizer_load_settings( $wp_customize );

}
add_action( 'customize_register', 'cerebro_customize_register' );

// if Kirki installed

if(class_exists( 'Kirki' )){

	// Google fonts
	require get_template_directory() . '/inc/customizer/settings/customizer-google-fonts.php';

}

add_action( 'wp_head', 'cerebro_add_loader_styles_to_header', 100 );
function cerebro_add_loader_styles_to_header() {
	?>
	<style>
		.kirki-customizer-loading-wrapper {
			background-image: none !important;
		}
	</style>
	<?php
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cerebro_customize_preview_js() {
	wp_enqueue_script( 'cerebro_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cerebro_customize_preview_js' );

/**
 * Auto load all customizer setting files
 * @return [type] [description]
 */
function cerebro_customizer_load_settings( $wp_customize ) {

	$filepath = dirname( __FILE__ ) . '/settings/';
	$files    = scandir( $filepath );

	foreach ( $files as $file ) {

		// match the file extension to .php
		if ( substr( $file,-4,4 ) == '.php' && strpos( $file, 'google-fonts' ) === false ) {
			require_once( $filepath.$file );
		}

	}

}
