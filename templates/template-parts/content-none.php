<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cerebro
 */

?>

<section class="no-results not-found">

	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'cerebro' ); ?></h1>
			</header><!-- .page-header -->

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cerebro' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Sorry', 'cerebro' ); ?></h1>
				<p><?php printf( esc_html__( 'Nothing matched your search terms.', 'cerebro' ) . '</br>' . esc_html__( 'Please try again with some different keywords.', 'cerebro' )  ); ?></p>
			</header><!-- .page-header -->

			<?php
				get_search_form(); ?>
				<div class="search-instructions"><?php esc_html_e( 'Press Enter / Return to begin your search.', 'cerebro' ); ?></div>

		<?php else : ?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Sorry', 'cerebro' ); ?></h1>
			</header><!-- .page-header -->

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cerebro' ); ?></p>
			<?php
				get_search_form(); ?>
				<div class="search-instructions"><?php esc_html_e( 'Press Enter / Return to begin your search.', 'cerebro' ); ?></div>

		<?php endif; ?>
	</div><!-- .entry-content -->
</section><!-- .no-results -->
