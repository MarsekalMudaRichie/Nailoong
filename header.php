<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cerebro
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php get_sidebar(); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cerebro' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">

			<div class="site-branding">
				<?php cerebro_the_custom_logo(); ?>

				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php printf( '<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><em>%1$s</em><span>%2$s</span></button>', esc_html__( 'Menu', 'cerebro' ), '&nbsp;' ); ?>

				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

			<!-- Search trigger -->
			<div id="big-search-trigger" class="big-search-trigger">
				<button>
					<span class="screen-reader-text"><?php esc_html_e( 'open search form', 'cerebro' ); ?></span>
					<i class="icon-search"></i>
				</button>
			</div>

			<!-- Sidebar trigger -->
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

				<div id="sidebar-trigger" class="sidebar-trigger">
					<button aria-expanded="false">
						<span class="screen-reader-text"><?php esc_html_e( 'open sidebar', 'cerebro' ); ?></span>
						<i class="icon-sidebar"></i>
					</button>
				</div>

			<?php endif; ?>

		</div><!-- .container -->
	</header><!-- #masthead -->

	<!-- Search form -->
	<div class="search-wrap">
		<?php get_search_form(); ?>
		<div class="search-instructions"><?php esc_html_e( 'Press Enter / Return to begin your search.', 'cerebro' ); ?></div>
		<button id="big-search-close">
			<span class="screen-reader-text"><?php esc_html_e( 'close search form', 'cerebro' ); ?></span>
		</button>
	</div>

	<div id="content" class="site-content">
