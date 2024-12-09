<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cerebro
 */

$display_blog_content = get_theme_mod('cerebro_content_blog_display', 1);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( !is_single() ) :
		 cerebro_featured_media(); ?>

	 <div class="content-wrapper">

	<?php endif; ?>

		<header class="entry-header">

			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			}
			else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="h-no-opacity h-hover-underline">', '</a></h2>' );
			}

			if ( is_single() && 'post' === get_post_type() ) {
			?>

				<div class="entry-meta">
					<?php cerebro_posted_on(); ?>
				</div><!-- .entry-meta -->

			<?php
			} ?>

		</header><!-- .entry-header -->

		<?php if ( is_single() ) {
			 cerebro_featured_media();
		} ?>

		<div class="entry-content">
			<?php


				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cerebro' ),
					'after'  => '</div>',
				) );

				if($display_blog_content)
					the_excerpt();
			?>
			<?php if ( !is_single() && 'post' === get_post_type() ) {
				?>

				<div class="entry-meta">
				<?php cerebro_posted_on();
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
					if ( class_exists( 'Jetpack_Likes' ) ) {
						$custom_likes = new Jetpack_Likes;
						echo $custom_likes->post_likes( '' );
					}
				?>
				</div><!-- .entry-meta -->

			<?php
			} ?>
		</div><!-- .entry-content -->


		<?php if ( !is_single() ) { ?>

	 </div><!-- .content-wrapper -->

	 <?php } ?>

	<?php if ( is_single() ) { ?>
		<footer class="entry-footer">
			<?php cerebro_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php } ?>
</article><!-- #post-## -->
