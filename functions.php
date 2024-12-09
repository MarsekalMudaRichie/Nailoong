<?php
/**
 * Cerebro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cerebro
 */

if ( ! function_exists( 'cerebro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cerebro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cerebro, use a find and replace
	 * to change 'cerebro' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cerebro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add support for custom logo
	add_theme_support( 'custom-logo', array(
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Image sizes
	add_image_size( 'cerebro-archive-image', 1200, 99999, false );
	add_image_size( 'cerebro-search-image', 150, 99999, false );
	add_image_size( 'cerebro-single-featured-image', 1200, 999999, false );

	/**
	 * Increase image quality compression
	 */
	add_filter( 'jpeg_quality', function() {
		return 100;
	} );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'cerebro' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'video',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cerebro_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add editor style
	add_editor_style( array( 'assets/css/editor-style.css', cerebro_fonts_url() ) );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Make Gutenberg embeds responsive.
	add_theme_support( 'responsive-embeds' );

	// Adds support for editor font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'small', 'cerebro' ),
			'shortName' => __( 'S', 'cerebro' ),
			'size'      => 15,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'regular', 'cerebro' ),
			'shortName' => __( 'M', 'cerebro' ),
			'size'      => 18,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'large', 'cerebro' ),
			'shortName' => __( 'L', 'cerebro' ),
			'size'      => 24,
			'slug'      => 'large'
		),
		array(
			'name'      => __( 'huge', 'cerebro' ),
			'shortName' => __( 'XL', 'cerebro' ),
			'size'      => 30,
			'slug'      => 'huge'
		)
	) );

}
endif;
add_action( 'after_setup_theme', 'cerebro_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'cerebro_content_width' ) ) :
function cerebro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cerebro_content_width', 1920 );
}
endif;
add_action( 'after_setup_theme', 'cerebro_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cerebro_widgets_init() {

	// Define sidebars
	$sidebars = array(
		'sidebar-1' => esc_html__( 'Sidebar', 'cerebro' )
	);

	// Loop through each widget area and register
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => $sidebar_name,
			'id'            => $sidebar_id,
			'description'   => sprintf ( esc_html__( 'Widget area for %s', 'cerebro' ), $sidebar_name ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

}
add_action( 'widgets_init', 'cerebro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cerebro_scripts() {
	wp_enqueue_style( 'cerebro-google-fonts', cerebro_fonts_url(), array(), null );
	wp_enqueue_style( 'thickbox' );

	wp_enqueue_style( 'cerebro-style', get_stylesheet_uri() );

	// Woocommerce styling
	if ( cerebro_is_woocommerce_activated() ) {
		wp_enqueue_style( 'cerebro-woocommerce-style', get_template_directory_uri() . '/woo-style.css' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'cerebro-woocommerce-rtl-style', get_template_directory_uri() . '/woo-rtl.css' );
		}
	}

	// Change Colors Style

	$change_colors_style = wp_strip_all_tags( cerebro_change_colors() );

	if ( cerebro_is_woocommerce_activated() ) {
		wp_add_inline_style( 'cerebro-woocommerce-style', $change_colors_style );
	}
	else {
		wp_add_inline_style( 'cerebro-style', $change_colors_style );
	}

	// Change Colors Style

	$change_colors_style = wp_strip_all_tags( cerebro_change_colors() );
	wp_add_inline_style( 'cerebro-style', $change_colors_style );

	// Scripts

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Main JS file.
	wp_enqueue_script( 'cerebro-call-scripts', get_template_directory_uri() . '/assets/js/common.js', array( 'jquery', 'masonry', 'thickbox' ), false, true );

}
add_action( 'wp_enqueue_scripts', 'cerebro_scripts' );

/**
 * Enqueue admin scripts
 */
function cerebro_add_admin_scripts() {
	// Admin styles
	wp_enqueue_style( 'cerebro-admin-css', get_template_directory_uri() . '/inc/admin/admin.css' );
	wp_enqueue_style( 'wp-color-picker' );

	// Admin scripts
	wp_enqueue_media();
	wp_enqueue_script( 'my-upload' );
	wp_enqueue_script( 'jquery-ui' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'cerebro-admin-js', get_template_directory_uri() . '/inc/admin/admin.js' );


	$js_vars = array(
		'url'                     => get_template_directory_uri(),
		'admin_url'               => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce'                   => wp_create_nonce( 'ajax-nonce' ),
		'default_text'            => esc_html__( 'Theme default', 'cerebro' )
	);
	wp_localize_script( 'cerebro-admin-scripts', 'js_vars', $js_vars );

}
add_action( 'admin_enqueue_scripts', 'cerebro_add_admin_scripts' );

/**
 * Gutenberg scripts and styles
 *
 */
if ( ! function_exists( 'cerebro_gutenberg_scripts' ) ) :
function cerebro_gutenberg_scripts() {
	wp_enqueue_style( 'cerebro-google-fonts', cerebro_fonts_url(), array(), null );
	wp_enqueue_style( 'cerebro-gutenberg', get_stylesheet_directory_uri() . '/assets/css/gutenberg.css' );
}
endif;
add_action( 'enqueue_block_editor_assets', 'cerebro_gutenberg_scripts' );

/**
 * Adds Google Fonts
 *
 * @package Cerebro
 */
if ( ! function_exists( 'cerebro_fonts_url' ) ) :
function cerebro_fonts_url() {

	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Inter, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$inter = esc_html_x( 'on', 'Inter font: on or off', 'cerebro' );


	if ( 'off' !== $inter ) {
		$font_families = array();

		if ( 'off' !== $inter ) {
			$font_families[] = 'Inter:wght@300;400;500;700';
		}

		$query_args = array(
			'family' => implode( '%7C', $font_families )
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
	}

	return $fonts_url;
}
endif;


/**
 * Change theme color support
 */
require get_template_directory() . '/inc/change-colors.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Plugin activation script
 */
require get_template_directory() . '/inc/plugin-activation.php';

require_once get_parent_theme_file_path( '/inc/merlin/vendor/autoload.php' );
require_once get_parent_theme_file_path( '/inc/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/inc/merlin-config.php' );

// Set up import files for Merlin
function merlin_local_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo',
			'import_file_url'            => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/cerebro/content.xml',
			'import_widget_file_url'     => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/cerebro/widgets.wie',
			'import_customizer_file_url' => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/cerebro/customizer.dat',
			'import_preview_image_url'     => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/cerebro/screenshot.png',
			'import_notice'                => __( 'Thank you!', 'cerebro' ),
			'preview_url'                  => 'http://themeskingdom.com/',
		),
	);
}
add_filter( 'merlin_import_files', 'merlin_local_import_files' );

/**
 * Filter the home page title from your demo content.
 * If your demo's home page title is "Home", you don't need this.
 */
function prefix_merlin_content_home_page_title( $output ) {
	return 'Guides';
}
add_filter( 'merlin_content_home_page_title', 'prefix_merlin_content_home_page_title' );
