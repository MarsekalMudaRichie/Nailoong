<?php
/**
 * Customizer Content
 *
 * Here you can define content display options
 *
 * @package  Cerebro
 */

// New control type: Title.
class Cerebro_Customize_Control_Title extends WP_Customize_Control {
	public $type = 'title';

	public function render_content() {
		?>
		<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
		<?php
	}
}

/* --- Settings --- */

// Blog content display options
$wp_customize->add_setting( 'cerebro_content_blog_display_title' );

$wp_customize->add_control(
	new Cerebro_Customize_Control_Title(
		$wp_customize,
		'cerebro_content_blog_display_title',
		array(
			'section' => 'jetpack_content_options',
			'label'   => esc_html__( 'Blog Posts Content', 'cerebro' ),
			'priority'    => 1,
			'type'    => 'title',
		)
	)
);

$wp_customize->add_setting( 'cerebro_content_blog_display', array(
	'default'           => 1,
	'sanitize_callback' => 'cerebro_sanitize_checkbox',
) );

$wp_customize->add_control( 'cerebro_content_blog_display', array(
	'label'       => esc_html__( 'Display post content on blog and archive pages.', 'cerebro' ),
	'priority'    => 1,
	'section'     => 'jetpack_content_options',
	'type'        => 'checkbox'
) );


// Single Post display featured image
$wp_customize->add_setting( 'cerebro_featured_img_display_title' );

$wp_customize->add_control(
	new Cerebro_Customize_Control_Title(
		$wp_customize,
		'cerebro_featured_img_display_title',
		array(
			'section' => 'jetpack_content_options',
			'priority'    => 2,
			'label'   => esc_html__( 'Posts Featured Image', 'cerebro' ),
			'type'    => 'title',
		)
	)
);

$wp_customize->add_setting( 'cerebro_display_featured_image', array(
	'default'           => 1,
	'sanitize_callback' => 'cerebro_sanitize_checkbox',
) );

$wp_customize->add_control( 'cerebro_display_featured_image', array(
	'label'       => esc_html__( 'Display Featured Image on Single Posts.', 'cerebro' ),
	'priority'    => 2,
	'section'     => 'jetpack_content_options',
	'type'        => 'checkbox'
) );
