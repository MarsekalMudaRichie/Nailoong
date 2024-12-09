<?php
/**
 * Customization of theme header
 *
 * @package Cerebro
 */

/**
 * Section
 */
$wp_customize->add_section( 'header_settings', array(
	'title'    => esc_html__( 'Header Settings', 'cerebro' ),
	'priority' => 120,
	'panel'    => 'cerebro_options_panel'
) );

/**
 * Settings
 */

// Sticky header
$wp_customize->add_setting( 'sticky_header_setting', array(
	'default'           => 'enable',
	'sanitize_callback' => 'cerebro_sanitize_sticky_header'
));

$wp_customize->add_control( 'sticky_header_setting', array(
	'label'    => esc_html__( 'Sticky header', 'cerebro' ),
	'priority' => 0,
	'section'  => 'header_settings',
	'type'     => 'radio',
	'choices'  => array(
	'enable'   => esc_html__( 'Enable - the header always appears at the top', 'cerebro' ),
	'disable'  => esc_html__( 'Disable - the header scrolls naturally with the page', 'cerebro' )
	),
) );
