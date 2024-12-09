<?php
/**
 * Customizer Footer
 *
 * Here you can define layout settings
 *
 * @package  Cerebro
 */

/* --- Section --- */

// Layout Section
$wp_customize->add_section( 'footer_section', array(
    'title'    => esc_html__( 'Footer Settings', 'cerebro' ),
    'priority' => 120,
    'panel'    => 'cerebro_options_panel'
) );

/* --- Settings --- */

// Footer Copyright text
$wp_customize->add_setting( 'cerebro_footer_copyright', array(
	'default'           => '',
    'sanitize_callback' => 'cerebro_sanitize_text',
) );

$wp_customize->add_control( 'cerebro_footer_copyright', array(
    'label'       => esc_html__( 'Footer Copyright Text', 'cerebro' ),
    'description' => esc_html__( 'Add text to footer copyright area. HTML elements can be used for formating.', 'cerebro' ),
    'section'     => 'footer_section',
    'priority'    => 0,
    'settings'    => 'cerebro_footer_copyright',
    'type'        => 'textarea'
) );
