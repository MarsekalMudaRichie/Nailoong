<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cerebro
 */

if ( ! function_exists( 'cerebro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */

function cerebro_posted_on() {

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( ' ' );

	if ( $categories_list && cerebro_categorized_blog() ) {
		printf( '<span class="cat-links"><strong>%1$s</strong> %2$s</span>', esc_html( 'Category', 'cerebro' ) , $categories_list ); // WPCS: XSS OK.
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf( '<span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark">%3$s</a>',
		esc_html( 'Posted on:', 'cerebro' ),
		esc_url( get_permalink() ),
		$time_string
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'cerebro' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'cerebro_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */

function cerebro_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );

		if ( $categories_list && cerebro_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'cerebro' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ' ' );

		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cerebro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'cerebro' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'cerebro' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'cerebro_categorized_blog' ) ) :
function cerebro_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cerebro_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cerebro_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cerebro_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cerebro_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flush out the transients used in cerebro_categorized_blog.
 */
if ( ! function_exists( 'cerebro_category_transient_flusher' ) ) :
function cerebro_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cerebro_categories' );
}
endif;
add_action( 'edit_category', 'cerebro_category_transient_flusher' );
add_action( 'save_post',     'cerebro_category_transient_flusher' );

/**
 * Displays post featured image
 *
 * @since  Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_featured_image' ) ) :
function cerebro_featured_image() {

	global $post;

	if ( has_post_thumbnail() ) :

		if ( is_single() ) { ?>

			<figure class="featured-image">
				<?php the_post_thumbnail( 'cerebro-single-featured-image' ); ?>
			</figure>

		<?php } else { ?>

			<?php

				// Set image sizes depending on content display
				$thumb_size = 'cerebro-archive-image';

				if ( is_search() || is_tag() ) {
					$thumb_size = 'cerebro-search-image';
				}

			?>

			<figure class="featured-image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size,
				 array('class' => 'skip-lazy') ); ?></a>
			</figure>

		<?php }

	else :

		return;

	endif;

}
endif;

/**
 * Displays post featured media
 *
 * @since  Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_featured_media' ) ) :
function cerebro_featured_media() {

	// If is gallery post format
	if ( 'gallery' == get_post_format() ) :

		global $post;

		if ( 'gallery' == get_post_format() && get_post_galleries( $post ) && ! post_password_required() ) { ?>

			<div class="entry-gallery">
				<?php

					if ( get_post_gallery() ) :
						echo get_post_gallery();
					endif;

				?>
			</div><!-- .entry-gallery -->

		<?php }

	endif;

	// If is video post format
	if ( 'video' == get_post_format() ) {

		if ( cerebro_get_embeded_media() && cerebro_is_blog_display_excerpt() ) {
			echo cerebro_get_embeded_media();
		}
		else {
			cerebro_featured_image();
		}

	}

	if ( 'gallery' != get_post_format() && 'video' != get_post_format() ) {
		cerebro_featured_image();
	}

}
endif;

/**
 * Cerebro custom paging function
 *
 * Creates and displays custom page numbering pagination in bottom of archives
 *
 * @since Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_numbers_pagination' ) ) :
function cerebro_numbers_pagination() {

	global $wp_query, $wp_rewrite;

	if ( $wp_query->max_num_pages > 1 ) :

		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
			'base'      => @add_query_arg( 'paged', '%#%' ),
			'format'    => '',
			'total'     => $wp_query->max_num_pages,
			'current'   => $current,
			'end_size'  => 1,
			'type'      => 'list',
			'prev_next' => true,
			'prev_text' => esc_html__( 'Prev', 'cerebro' ),
			'next_text' => esc_html__( 'Next', 'cerebro' )
		);

		if ( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if ( ! empty( $wp_query->query_vars['s'] ) ) {
			$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
		}

		// Display pagination
		printf( '<nav class="navigation paging-navigation"><h1 class="screen-reader-text">%1$s</h1>%2$s</nav>',
			esc_html__( 'Page navigation', 'cerebro' ),
			paginate_links( $pagination )
		);

	endif;

}
endif;

/**
 * Custom logo display
 *
 * @since Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_the_custom_logo' ) ) :
function cerebro_the_custom_logo() {

	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}
endif;

/**
 * Remove Jetpack social buttons
 *
 * @since Cerebro 1.0
 */
if ( ! function_exists( 'cerebro_remove_sharing_buttons' ) ) :
function cerebro_remove_sharing_buttons() {

	remove_filter( 'the_content', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}

}
add_action( 'loop_start', 'cerebro_remove_sharing_buttons' );
endif;
