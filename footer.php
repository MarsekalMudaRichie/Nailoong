<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cerebro
 */

$footer_copyright = get_theme_mod( 'cerebro_footer_copyright', '' );

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="site-info">

				<?php if ( '' == $footer_copyright ) { ?>

					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cerebro' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'cerebro' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'cerebro' ), wp_get_theme()->get( 'Name' ), '<a href="https://themeskingdom.com/" rel="nofollow">Themes Kingdom</a>' );

				}
				else {

					printf( $footer_copyright );

				} ?>

			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->

	<a href="#" id="scrollUp" class="back-to-top">
		<i class="icon-top"></i>
	</a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
