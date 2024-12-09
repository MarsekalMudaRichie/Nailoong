<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cerebro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cerebro_body_classes( $classes ) {

	$sticky_header            = get_theme_mod( 'sticky_header_setting', 'enable' );

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = esc_attr( 'group-blog' );
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = esc_attr( 'hfeed' );
	}

	// Sticky header
	if ( 'enable' == $sticky_header ) {
		$classes[] = esc_attr( 'sticky-header' );
	}

	// Adds a class of tk-theme-frontend when viewing frontend.
	if ( !is_admin() ) {
		$classes[] = 'tk-theme-frontend';
	}

	return $classes;
}
add_filter( 'body_class', 'cerebro_body_classes' );

/**
 * Check for embed content in post and extract
 *
 * @since Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_get_embeded_media' ) ) :
function cerebro_get_embeded_media() {
	$content    = get_the_content();
	$embeds     = get_media_embedded_in_content( $content );
	$media_urls = wp_extract_urls( $content );

	if ( !empty( $embeds ) ) {

		// Check what is the first embed containg video tag, youtube or vimeo
		foreach( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) || strpos( $embed, 'hulu' ) || strpos( $embed, 'animoto' ) || strpos( $embed, 'dailymotion' ) || strpos( $embed, 'educreations' ) || strpos( $embed, 'sproutvideo' ) || strpos( $embed, 'ted.com' )|| strpos( $embed, 'vine.co' ) || strpos( $embed, 'wistia' ) || strpos( $embed, 'kck.st' ) ) {

				$id   = 'cerebro' . rand();
				$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

				if ( has_post_thumbnail() ) {

					$media_urls_content = '<div id="' . $id . '" style="display:none;">' . $embed . '</div>';
					$media_urls_content .= '<figure class="featured-image"><a class="thickbox" title="' . get_the_title() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></figure>';

					return $media_urls_content;

				} else {

					$embed = '<figure class="entry-video">'. $embed .'</figure>';

					return $embed;

				}

			}
		}

	} else {

		if ( $media_urls ) {

			foreach ($media_urls as $url) {

				if ( strpos( $url, 'vimeo' ) || strpos( $url, 'youtube' ) || strpos( $url, 'cnnmoney-video' ) || strpos( $url, 'dailymotion' ) || strpos( $url, 'ted' ) || strpos( $url, 'hulu' ) || strpos( $url, 'vine' ) || strpos( $url, 'kck.st' ) ) {

					$id   = 'cerebro' . rand();
					$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

					if ( has_post_thumbnail() ) {

						$media_urls_content = '<div id="' . $id . '" style="display:none;">' . wp_oembed_get( $url ) . '</div>';
						$media_urls_content .= '<figure class="featured-image"><a class="thickbox" title="' . get_the_title() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></figure>';

						return $media_urls_content;

					} else {

						return wp_oembed_get( $media_urls[0] );

					}

				}

			}

		}

		else {
			// No video embedded found
			return $content;
		}
	}
}
endif;

/**
 * Remove parenthesses with dots from excerpt
 *
 * @since Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_excerpt_more' ) ) :
function cerebro_excerpt_more( $more ) {
	return;
}
endif;
add_filter( 'excerpt_more', 'cerebro_excerpt_more' );

/**
 * Add read more text to excerpt
 *
 * @since Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_add_read_more_excerpt' ) ) :
function cerebro_add_read_more_excerpt( $excerpt ) {
	$read_more_txt = sprintf(
		/* translators: %s: Name of current post. */
		wp_kses( __( 'Read more %s', 'cerebro' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	);

	$read_more_link = '';

	if ( !is_single() ){
		$read_more_link = '<a class="read-more-link" title="' . get_the_title() . '" href=" ' . esc_url( get_permalink() ) . ' ">' . $read_more_txt . '</a>';
	}

	return $excerpt . $read_more_link;
}
endif;
// add_filter( 'the_excerpt', 'cerebro_add_read_more_excerpt' );

/**
 * Removes parenthesses from category and archives widget
 *
 * @since Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_categories_postcount_filter' ) ) :
function cerebro_categories_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
endif;
add_filter( 'wp_list_categories','cerebro_categories_postcount_filter' );

if ( ! function_exists( 'cerebro_archives_postcount_filter' ) ) :
function cerebro_archives_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
endif;
add_filter( 'get_archives_link', 'cerebro_archives_postcount_filter' );

/**
 * Filter content for Gallery and Video post format
 *
 * @since  Cerebro 1.0
 */
if ( ! function_exists( 'get_first_gallery' ) ) :
function get_first_gallery( $content ) {
	if ( 'gallery' == get_post_format() ) {
		preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
		if ( ! empty( $matches ) ) {
			foreach ( $matches as $shortcode ) {
				if ( 'gallery' === $shortcode[2] ) {
					$pos = strpos( $content, $shortcode[0] );
					if( false !== $pos ) {
						return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
					}
				}
			}
		}

		return $content;
	}
}
endif;

if ( ! function_exists( 'remove_first_gallery_from_post_content' ) ) :
function remove_first_gallery_from_post_content($content) {

	if ( 'gallery' == get_post_format() ) {
		$content = get_first_gallery($content);
	}

	return $content;

}
endif;
add_filter('the_content', 'remove_first_gallery_from_post_content');

if ( ! function_exists( 'remove_first_video_from_post_content' ) ) :
function remove_first_video_from_post_content($content) {
	if ( 'video' == get_post_format() ) {
		$content = preg_replace("/<iframe[^>]+>/i", "", $content, 1);
	}

	return $content;

}
endif;
add_filter('the_content', 'remove_first_video_from_post_content');

/**
 * Get number of search results
 *
 * @since  Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_get_search_results' ) ) :
function cerebro_get_search_results() {

	global $wp_query;

	if ( is_search() ) {
		return $wp_query->found_posts;
	} else {
		return;
	}

}
endif;
/**
 * Check if jetpeck display option is excerpt
 *
 * @since  Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_is_blog_display_excerpt' ) ) :
function cerebro_is_blog_display_excerpt(){
	$blog_display = get_option( 'jetpack_content_blog_display', true );

	if( $blog_display == 'excerpt' ){
		return true;
	} else {
		return false;
	}
}
endif;

/**
 * Convert hexdec color string to rgb(a) string
 *
 * @since  Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_hex2rgba' ) ) :
function cerebro_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if ( empty( $color ) ) {
		return $default;
	}

	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map( 'hexdec', $hex );

	//Check if opacity is set(rgba or rgb)
	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ",",$rgb ) . ')';
	}

	// Return rgb(a) color string
	return $output;
}
endif;

/**
 * Check if WooCommerce is activated
 *
 * @since cerebro 1.3
 */
if ( ! function_exists( 'cerebro_is_woocommerce_activated' ) ) {
	function cerebro_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}
