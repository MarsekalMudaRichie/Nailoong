<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Cerebro
 */


/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
if ( ! function_exists( 'cerebro_jetpack_setup' ) ) :
function cerebro_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'post-load',
		'render'         => 'cerebro_infinite_scroll_render',
		'wrapper'        => false,
		'footer_widgets' => false,
		'footer'         => false,
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		// 'blog-display'   => 'content',
		'author-bio'     => true,
		'post-details'   => array(
			'stylesheet' => 'cerebro-style',
			'date'       => '.entry-date',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
		),
	) );
}
endif;
add_action( 'after_setup_theme', 'cerebro_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
if ( ! function_exists( 'cerebro_infinite_scroll_render' ) ) :
function cerebro_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'templates/template-parts/content', 'search' );
		else :
			get_template_part( 'templates/template-parts/content', get_post_format() );
		endif;
	}

}
endif;

/**
 * Customize the page types supported through Infinite Scroll.
 */

function cerebro_custom_is_support() {
	$supported = current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_archive() || is_search() );
	return $supported;
}
add_filter( 'infinite_scroll_archive_supported', 'cerebro_custom_is_support' );

/**
 * Sets Infinite Scroll's query object if necessary.
 *
 * @uses  add_filter
 */
function cerebro_force_batch() {
	return false;
}

/**
 * Return early if Author Bio is not available.
 */
if ( ! function_exists( 'cerebro_author_bio' ) ) :
function cerebro_author_bio() {
	if ( ! function_exists( 'jetpack_author_bio' ) ) {
		return;
	} else {
		jetpack_author_bio();
	}
}
endif;

/**
 * Author Bio Avatar Size.
 */
if ( ! function_exists( 'cerebro_author_bio_avatar_size' ) ) :
function cerebro_author_bio_avatar_size() {
	return 60;
}
endif;
add_filter( 'jetpack_author_bio_avatar_size', 'cerebro_author_bio_avatar_size' );

/**
 * Change Jetpack's Infinite Scroll text on button that loads more posts.
 */
if ( ! function_exists( 'cerebro_filter_jetpack_infinite_scroll_js_settings' ) ) :
function cerebro_filter_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More <i class="icon-plus"></i>', 'cerebro' );

	return $settings;
}
endif;
add_filter( 'infinite_scroll_js_settings', 'cerebro_filter_jetpack_infinite_scroll_js_settings' );

/** * Filter Jetpack’s Related Post thumbnail size.
 *
 * @param  $size (array) - Current width and height of thumbnail.
 * @return $size (array) - New width and height of thumbnail.
*/
if ( ! function_exists( 'cerebro_custom_jetpack_relatedposts_filter_thumbnail_size' ) ) :
function cerebro_custom_jetpack_relatedposts_filter_thumbnail_size( $size ) {
	$size = array(
		'width'  => 350,
		'height' => ''
	);
	return $size;
}
endif;
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'cerebro_custom_jetpack_relatedposts_filter_thumbnail_size' );

/**
 * Add filter to customize speed of the Slideshow
 */
if ( ! function_exists( 'cerebro_fast_slideshow' ) ) :
function cerebro_fast_slideshow( $args ) {
	$new_speed = array(
		'speed' => '2000'
	);
	return array_replace( $args, $new_speed );
}
endif;
add_filter( 'jetpack_js_slideshow_settings', 'cerebro_fast_slideshow' );

/**
 * Change compression quality in Photon
 */
if ( ! function_exists( 'cerebro_custom_photon_compression' ) ) :
function cerebro_custom_photon_compression( $args ) {
	$args['quality'] = 99;
	return $args;
}
endif;
add_filter('jetpack_photon_pre_args', 'cerebro_custom_photon_compression' );
