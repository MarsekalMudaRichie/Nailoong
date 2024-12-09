<?php
/**
 * Template Name: Blog Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cerebro
 */

get_header(); ?>

	<div id="primary" class="content-area listing">
		<main id="main" class="site-main" role="main">

			<div class="page-content">
				<?php the_content(); ?>
			</div>

			<?php
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				}
				elseif ( get_query_var( 'page' ) ) {
					$paged = get_query_var( 'page' );
				}
				else {
					$paged = 1;
				}

				$args = array(
					'posts_per_page' => get_option( 'posts_per_page' ),
					'paged'			 => $paged
				);

				$wp_query = new WP_Query( $args );

				if ( $wp_query->have_posts() ) : ?>

					<div id="post-load" class="grid-wrapper">

						<?php

							while ( $wp_query->have_posts() ) : $wp_query->the_post();

								get_template_part( 'templates/template-parts/content', get_post_format() );

							endwhile;

						?>

					</div><!-- .grid-wrapper -->

				<?php

					// Archives numbered paging
					cerebro_numbers_pagination();

					wp_reset_postdata();

				else :

					get_template_part( 'templates/template-parts/content', 'none' );

				endif;

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
