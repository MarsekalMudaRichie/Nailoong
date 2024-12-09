<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cerebro
 */

$display_featured_img = get_theme_mod('cerebro_display_featured_image', 1);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );

			if ( 'post' === get_post_type() ) : ?>

				<div class="entry-meta">
					<?php cerebro_posted_on(); ?>
				</div><!-- .entry-meta -->

			<?php
		endif; ?>

	</header><!-- .entry-header -->

	<?php
	if($display_featured_img)
		cerebro_featured_media();
	?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cerebro' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cerebro' ),
				'after'  => '</div>',
			) );
		?>
		<footer class="entry-footer">
		<?php
			cerebro_entry_footer();
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			if ( class_exists( 'Jetpack_Likes' ) ) {
				$custom_likes = new Jetpack_Likes;
				echo $custom_likes->post_likes( '' );
			}
			cerebro_author_bio();
		?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-content -->

</article><!-- #post-## -->
