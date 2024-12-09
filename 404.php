<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Cerebro
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops!', 'cerebro' ); ?></h1>
				</header><!-- .page-header -->

				<div class="entry-content">
					<p class="emphasis"><?php esc_html_e( 'That page can&rsquo;t be found.', 'cerebro' ); ?></p>
					<p><?php printf( wp_kses( __( 'There&rsquo;s nothing to be found here. <a href="%1$s">Go back home</a> and try your luck there.', 'cerebro' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( home_url() ) ); ?></p>

					<?php get_search_form(); ?>
					<div class="search-instructions"><?php esc_html_e( 'Press Enter / Return to begin your search.', 'cerebro' ); ?></div>

				</div><!-- .entry-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
