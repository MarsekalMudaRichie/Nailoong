<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Cerebro
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header clear">
				<h1 class="page-title"><?php printf( '<span>%s</span>', esc_html( get_search_query() ) ); ?></h1>
				<p class=""><?php esc_html_e( 'Displaying search results', 'cerebro' ); ?></p>
				<?php printf( '<span class="results-number">%1$s %2$s</span>', esc_html( cerebro_get_search_results() ), esc_html__( 'Results', 'cerebro' ) ); ?>
			</header><!-- .page-header -->


			<div id="post-load">

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'templates/template-parts/content', 'search' );

				endwhile;

				?>

			</div><!-- #post-load -->

			<?php
				// Archives numbered paging
				cerebro_numbers_pagination();

		else :

			get_template_part( 'templates/template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
