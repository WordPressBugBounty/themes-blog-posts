<?php

// upgrade to pro.
require get_theme_file_path() . '/inc/upgrade-to-pro/class-customize.php';

function blog_posts_customize_register( $wp_customize ) {

	class Blog_Posts_Toggle_Checkbox_Custom_control extends WP_Customize_Control {
		public $type = 'toogle_checkbox';

		public function render_content() {
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" 
					<?php
					$this->link();
					checked( $this->value() );
					?>
					>
					<label class="onoffswitch-label" for="<?php echo esc_attr( $this->id ); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post( $this->description ); ?></p>
			</div>
			<?php
		}
	}

	// Categories section.
	require get_theme_file_path() . '/inc/customizer/categories.php';

	// Posts Carousel section.
	require get_theme_file_path() . '/inc/customizer/posts-carousel.php';

	// Grid Column layout options.
	$wp_customize->add_setting(
		'blog_posts_archive_grid_column_layout',
		array(
			'default'           => 'grid-column-3',
			'sanitize_callback' => 'glowing_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'blog_posts_archive_grid_column_layout',
		array(
			'label'    => esc_html__( 'Grid Column Layout', 'blog-posts' ),
			'section'  => 'glowing_blog_archive_page_options',
			'type'     => 'select',
			'choices'  => array(
				'grid-column-2' => __( 'Column 2', 'blog-posts' ),
				'grid-column-3' => __( 'Column 3', 'blog-posts' ),
			),
			'priority' => 15,
		)
	);

	// Pagination - Pagination Style.
	$wp_customize->add_setting(
		'blog_posts_pagination_type',
		array(
			'default'           => 'numeric',
			'sanitize_callback' => 'glowing_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'blog_posts_pagination_type',
		array(
			'label'           => esc_html__( 'Pagination Style', 'blog-posts' ),
			'section'         => 'glowing_blog_pagination',
			'type'            => 'select',
			'choices'         => array(
				'default' => __( 'Default (Older/Newer)', 'blog-posts' ),
				'numeric' => __( 'Numeric', 'blog-posts' ),
			),
			'active_callback' => 'glowing_blog_pagination_enabled',
			'priority'        => 15,
		)
	);

}
add_action( 'customize_register', 'blog_posts_customize_register' );

function blog_posts_customize_preview_js() {
	wp_enqueue_script( 'blog-posts-customizer', get_stylesheet_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview', 'glowing-blog-customizer' ), true );
}
add_action( 'customize_preview_init', 'blog_posts_customize_preview_js' );

function blog_posts_custom_control_scripts() {
	wp_enqueue_style( 'blog-posts-customize-controls', get_theme_file_uri() . '/assets/css/customize-controls.min.css' );
	wp_enqueue_script( 'blog-posts-custom-controls-js', get_stylesheet_directory_uri() . '/assets/js/customize-control.min.js', array( 'glowing-blog-customize-control', 'jquery', 'jquery-ui-core' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'blog_posts_custom_control_scripts' );
