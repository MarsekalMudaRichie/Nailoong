<?php
/**
 * Change colors regarding user choices in customizer
 *
 * @package Cerebro
 */
if ( ! function_exists( 'cerebro_change_colors' ) ) :
function cerebro_change_colors() {

/**
 * GENERAL THEME COLORS
 */

$body_bg_color              = get_theme_mod( 'cerebro_body_bg_color', '#fff' );
$main_color                 = get_theme_mod( 'cerebro_main_color', '#000' );
$heading_color              = get_theme_mod( 'cerebro_heading_color', '#000' );
$meta_link_color            = get_theme_mod( 'cerebro_meta_link_color', '#000' );

$change_colors_style = '

	/*Body BG*/

	body,
	html body:not(.custom-background),
	body:not(.custom-background) .site-content,
	body:not(.custom-background) .header-scrolled .site-header,
	body:not(.custom-background) .contact-filter,
	body:not(.custom-background) .search-wrap,
	body:not(.custom-background) .select2-dropdown,
	body:not(.custom-background) .select2-results {
		background-color: '.esc_attr( $body_bg_color ).';
	}

	/*General font color*/

	body,
	input,
	select,
	textarea,
	.entry-content,
	#big-search-trigger,
	body .tb-close-icon,
	body .jp-carousel-titleanddesc-title,
	.entry-footer,
	.post-navigation a,
	.posts-navigation a,
	.text .single-soc-share-link a,
	.listing .cat-links a,
	body #jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context,
	.logged-in-as,
	.logged-in-as a,
	.comment-notes,
	.category-filter a,
	.jp-relatedposts-post p,
	.text .single-soc-share-link a,
	.wp-block-separator.is-style-dots:before,
	.woocommerce-product-search input[type="submit"],
	.woocommerce-product-search button[type="submit"],
	.woocommerce .products a.add_to_cart_button,
	.woocommerce .products a.add_to_cart_button:hover,
	.woocommerce .products a.ajax_add_to_cart,
	.woocommerce .products a.ajax_add_to_cart:hover,
	.woocommerce ul.products li.product .price,
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	.woocommerce nav.woocommerce-pagination ul li a:focus,
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.popup-filter,
	.woocommerce .woocommerce-breadcrumb a,
	.summary .product_meta > span *,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
	#reviews .woocommerce-review__author,
	.woocommerce form .form-row .required,
	.select2-container--default .select2-selection--single .select2-selection__rendered,
	.woocommerce-cart table.cart td.actions .coupon .button,
	.woocommerce table.cart td.actions button.button,
	.woocommerce table.cart td.actions input.button,
	.product-modal .view-details a,
	.product-modal-wrapp .entry-summary p.out-of-stock,
	.woocommerce .checkout_coupon button[type="submit"],
	.woocommerce .wishlist_table td.product-add-to-cart a,
	.price ins,
	.product-price ins,
	.widget ins,
	.contact-form label span,
	form.contact-form label span:after,
	.paging-navigation .current {
		color: '.esc_attr( $main_color ).';
	}

	select {
		background-image:
			linear-gradient(45deg, transparent 51%, '.esc_attr( $main_color ).' 50%),
			linear-gradient(135deg, '.esc_attr( $main_color ).' 51%, transparent 50%);
	}

	select:focus {
		background-image:
			linear-gradient(45deg, '.esc_attr( $main_color ).' 51%, transparent 50%),
			linear-gradient(135deg, transparent 50%, '.esc_attr( $main_color ).' 51%);
	}


	.search-wrap input[type="search"]::-webkit-input-placeholder,
	.no-results input[type="search"]::-webkit-input-placeholder,
	.error-404 input[type="search"]::-webkit-input-placeholder {
		color: '.esc_attr( $main_color ).';
	}

	.search-wrap input[type="search"]:-moz-placeholder,
	.no-results input[type="search"]:-moz-placeholder,
	.error-404 input[type="search"]:-moz-placeholder {
		color: '.esc_attr( $main_color ).';
	}

	.search-wrap input[type="search"]::-moz-placeholder,
	.no-results input[type="search"]::-moz-placeholder,
	.error-404 input[type="search"]::-moz-placeholder {
		color: '.esc_attr( $main_color ).';
	}

	.search-wrap input[type="search"]:-ms-input-placeholder,
	.search-wrap input[type="search"]:-ms-input-placeholder:focus,
	.no-results input[type="search"]:-ms-input-placeholder,
	.no-results input[type="search"]:-ms-input-placeholder:focus,
	.error-404 input[type="search"]:-ms-input-placeholder,
	.error-404 input[type="search"]:-ms-input-placeholder:focus {
		color: '.esc_attr( $main_color ).';
	}

	.select2-container--default .select2-results__option[aria-selected=true],
	.select2-container--default .select2-results__option[data-selected=true] {
		color: '.cerebro_hex2rgba( $main_color, 0.2 ).';
	}

	.wp-block-image figcaption,
	.wp-block-embed figcaption {
		color: '.cerebro_hex2rgba( $main_color, 0.6 ).';
	}

	.paging-navigation a,
	.paging-navigation .dots,
	.widget .post-date,
	.back-to-top {
		color: '.cerebro_hex2rgba( $main_color, 0.1 ).';
	}

	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea,
	select,
	.search-wrap input[type="search"],
	.no-results input[type="search"],
	.error-404 input[type="search"],
	.select2-container .select2-choice,
	.select2-container .select2-selection--single,
	.select2-drop-active,
	.select2-dropdown,
	.select2-drop.select2-drop-above.select2-drop-active,
	.select2-dropdown-open.select2-drop-above .select2-choice,
	.select2-dropdown-open.select2-drop-above .select2-selection--single,
	.select2-dropdown-open.select2-drop-above .select2-choices,
	.select2-container--default .select2-search--dropdown .select2-search__field,
	.cart-collaterals,
	#order_review,
	#add_payment_method table.cart td.actions .coupon .input-text,
	.woocommerce-cart table.cart td.actions .coupon .input-text,
	.woocommerce-checkout table.cart td.actions .coupon .input-text,
	.woocommerce-cart table.cart td.actions .coupon .button,
	.search-results:not(.archive) .listing article,
	#add_payment_method #payment ul.payment_methods li,
	.woocommerce-cart #payment ul.payment_methods li,
	.woocommerce-checkout #payment ul.payment_methods li,
	.widget_calendar tbody a:after,
	.woocommerce table.wishlist_table thead th,
	.woocommerce table.wishlist_table tbody td,
	blockquote.pull-left,
	q.pull-left,
	blockquote.pull-right,
	q.pull-right {
		border-color: '.esc_attr( $main_color ).';
	}

	#big-search-close:before,
	#big-search-close:after,
	hr,
	.wp-block-separator,
	.select2-container--default .select2-results__option--highlighted[aria-selected],
	.select2-container--default .select2-results__option--highlighted[data-selected] {
		background-color: '.esc_attr( $main_color ).';
	}

	.listing .cat-links a:before,
	#infinite-handle button i,
	#infinite-handle button i:before,
	#infinite-handle button i:after {
		background-color: '.esc_attr( $main_color ).';
	}

	/*Heading color*/

	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	h1 a,
	h2 a,
	h3 a,
	h4 a,
	h5 a,
	h6 a,
	.entry-content h1,
	.entry-content h2,
	.entry-content h3,
	.entry-content h4,
	.entry-content h5,
	.entry-content h6,
	.entry-content h1 a,
	.entry-content h2 a,
	.entry-content h3 a,
	.entry-content h4 a,
	.entry-content h5 a,
	.entry-content h6 a,
	blockquote,
	.emphasis,
	.big-search-trigger button,
	.sidebar-trigger button,
	.search-form input[type="submit"],
	body #infinite-handle span {
		color: '.esc_attr( $heading_color ).';
	}

	.menu-toggle span,
	.menu-toggle span:before,
	.menu-toggle span:after {
	    background-color: '.esc_attr( $heading_color ).';
	}

	/*Link and Meta colors*/

	.big-search-trigger button,
	.sidebar-trigger button {
		color: '.esc_attr( $meta_link_color ).';
	}

	.menu-toggle span,
	.menu-toggle span:before,
	.menu-toggle span:after {
	    background-color: '.esc_attr( $meta_link_color ).';
	}

	.sharedaddy .sd-social-text .sd-content ul li a.sd-button {
		color: '.esc_attr( $meta_link_color ).' !important;
	}

	.nav-menu a:before,
	.entry-content a:before,
	.entry-footer a:before,
	.entry-meta a:before,
	.author-box a:before,
	body #infinite-handle span:before,
	.comments-area .nav-links a:before,
	.comment-author a:before,
	.comment-content a:before,
	.comment-reply-link:before,
	.comment-form a:before,
	.paging-navigation a:before,
	.category-filter a:before,
	.sd-social-text ul li a:after {
		background-color: '.esc_attr( $meta_link_color ).';
	}

	/*Responsive*/

	@media only screen and (min-width: 1025px){

		.back-to-top:hover,
		.paging-navigation a:hover {
			color: '.esc_attr( $main_color ).';
		}

		.site-info a:hover {
			color: '.cerebro_hex2rgba( $main_color, 0.6 ).';
		}

	}

	';

	return $change_colors_style;

}
endif;

?>
