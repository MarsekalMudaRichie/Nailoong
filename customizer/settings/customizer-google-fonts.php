<?php
/**
 * Customize Google Fonts
 *
 * @package Cerebro
 */

// Kirki config

Kirki::add_config( 'cerebro', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'option',
	'option_name' => 'cerebro',
) );

/* --- Section --- */

// Font section
Kirki::add_section( 'google_fonts_section', array(
	'title'       => esc_html__( 'Font Settings', 'cerebro' ),
	'description' => esc_html__( 'Choose fonts for your content', 'cerebro' ),
	'priority'    => 200
) );

/* --- Settings --- */
Kirki::add_field( 'cerebro', array(
	'type'        => 'typography',
	'settings'    => 'font_paragraph_settings',
	'label'       => esc_attr__( 'Paragraphs', 'cerebro' ),
	'section'     => 'google_fonts_section',
	'default'     => array(
		'font-family'    => '"Inter", Times, serif',
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'body, input, textarea, keygen, select, button, body .sd-social-icon .sd-content ul li a.sd-button, body .sd-social-text .sd-content ul li a.sd-button, body .sd-content ul li a.sd-button, body .sd-content ul li .option a.share-ustom, body .sd-content ul li.preview-item div.option.option-smart-off a, body .sd-content ul li.advanced a.share-more, body .sd-social-icon-text .sd-content ul li a.sd-button, body .sd-social-official .sd-content > ul > li > a.sd-button, body #sharing_email .sharing_send, body .sd-social-official .sd-content > ul > li .digg_button > a, body .jp-carousel-wrap, .jp-carousel-wrap .jp-carousel-light #carousel-reblog-box input#carousel-reblog-submit, .jp-carousel-wrap #jp-carousel-comment-form-button-submit, .jp-carousel-wrap textarea#jp-carousel-comment-form-comment-field, .jp-carousel-titleanddesc-title, body div#jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context, body div#jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-date',
		),
	),
) );

Kirki::add_field( 'cerebro', array(
	'type'        => 'typography',
	'settings'    => 'font_heading_settings',
	'label'       => esc_attr__( 'Headings', 'cerebro' ),
	'section'     => 'google_fonts_section',
	'default'     => array(
		'font-family'    => '"Inter", Times, serif',
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
	),
	'priority'    => 20,
	'output'      => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, blockquote, blockquote p, q, q p, button, input[type="button"], input[type="reset"], input[type="submit"], .emphasis, .site-title a, .site-header .main-navigation a, .dropcap:before, .post-navigation .nav-previous a, .posts-navigation .nav-previous a, .post-navigation .nav-next a, .posts-navigation .nav-next a, .widget.widget_recent_entries li > a, .widget table caption, .widget th, .widget tfoot td a, .widget_recent_comments .comment-author-link, .widget_recent_comments .comment-author-link a, .widget_recent_comments .recentcomments, .widget_recent_comments .recentcomments a, .comments-area .comment-list .comment-author b > a, body.search .search-post-type, body.error404 .page-content > p, .error-404 .search-instructions, .error-404 input[type="search"], .search-no-results input[type="search"], body.search.search-no-results section.no-results .page-content > p, body #jp-relatedposts .jp-relatedposts-items-visual .jp-relatedposts-post h4.jp-relatedposts-post-title, body #jp-relatedposts h3.jp-relatedposts-headline, .comments-area .comment-list .comment-author b, .comments-area .no-comments, .search-wrap input[type="search"], .no-results input[type="search"], .error-404 input[type="search"], body div#jp-relatedposts h3.jp-relatedposts-headline em, body div#jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a, #infinite-handle span button, #infinite-handle span button:focus, #infinite-handle span button:hover, body #TB_caption, .format-video #TB_ajaxWindowTitle',
		),
	),
) );
