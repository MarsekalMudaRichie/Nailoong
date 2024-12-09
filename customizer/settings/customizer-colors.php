<?php
/**
 * Customizer Custom Colors
 *
 * Here you can define your own CSS rules
 *
 * @package  Cerebro
 */

/**
 *
 * Settings
 *
 */

/* GENERAL COLORS */

// Body BG color
$wp_customize->add_setting( 'cerebro_body_bg_color', array(
	'default'           => '#fff',
	'sanitize_callback' => 'cerebro_sanitize_color'
));

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'cerebro_body_bg_color',
		array(
			'label'    => esc_html__( 'Background Color', 'cerebro' ),
			'section'  => 'cerebro_colors_section',
			'priority' => 0
		) )
);

// General font color
$wp_customize->add_setting( 'cerebro_main_color', array(
	'default'           => '#000',
	'sanitize_callback' => 'cerebro_sanitize_color'
));

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'cerebro_main_color',
		array(
			'label'    => esc_html__( 'Paragraph Color', 'cerebro' ),
			'section'  => 'cerebro_colors_section',
			'priority' => 1
		) )
);

// Headings color
$wp_customize->add_setting( 'cerebro_heading_color', array(
	'default'           => '#000',
	'sanitize_callback' => 'cerebro_sanitize_color'
));

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'cerebro_heading_color',
		array(
			'label'    => esc_html__( 'Headings Color', 'cerebro' ),
			'section'  => 'cerebro_colors_section',
			'priority' => 1
		) )
);

// Meta Link color
$wp_customize->add_setting( 'cerebro_meta_link_color', array(
	'default'           => '#000',
	'sanitize_callback' => 'cerebro_sanitize_color'
));

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'cerebro_meta_link_color',
		array(
			'label'    => esc_html__( 'Link and Meta Data Color', 'cerebro' ),
			'section'  => 'cerebro_colors_section',
			'priority' => 6
		) )
);
