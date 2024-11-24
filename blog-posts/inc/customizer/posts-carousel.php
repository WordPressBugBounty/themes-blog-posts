<?php
/**
 * Adore Themes Customizer
 *
 * @package Blog Posts
 *
 * Posts Carousel Section
 */

$wp_customize->add_section(
	'blog_posts_posts_carousel_section',
	array(
		'title' => esc_html__( 'Posts Carousel Section', 'blog-posts' ),
		'panel' => 'glowing_blog_frontpage_panel',
	)
);

// Posts Carousel enable setting.
$wp_customize->add_setting(
	'blog_posts_posts_carousel_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'glowing_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Posts_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_posts_posts_carousel_section_enable',
		array(
			'label'    => esc_html__( 'Enable Posts Carousel Section', 'blog-posts' ),
			'type'     => 'checkbox',
			'settings' => 'blog_posts_posts_carousel_section_enable',
			'section'  => 'blog_posts_posts_carousel_section',
		)
	)
);

// Posts Carousel title settings.
$wp_customize->add_setting(
	'blog_posts_posts_carousel_title',
	array(
		'default'           => __( 'Posts Carousel', 'blog-posts' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_posts_posts_carousel_title',
	array(
		'label'           => esc_html__( 'Section Title', 'blog-posts' ),
		'section'         => 'blog_posts_posts_carousel_section',
		'active_callback' => 'blog_posts_if_posts_carousel_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blog_posts_posts_carousel_title',
		array(
			'selector'            => '.post-carousel-section h3.section-title',
			'settings'            => 'blog_posts_posts_carousel_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'blog_posts_posts_carousel_title_text_partial',
		)
	);
}

// Posts Carousel subtitle settings.
$wp_customize->add_setting(
	'blog_posts_posts_carousel_subtitle',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_posts_posts_carousel_subtitle',
	array(
		'label'           => esc_html__( 'Section Subtitle', 'blog-posts' ),
		'section'         => 'blog_posts_posts_carousel_section',
		'active_callback' => 'blog_posts_if_posts_carousel_enabled',
	)
);

// View All button label setting.
$wp_customize->add_setting(
	'blog_posts_posts_carousel_view_all_button_label',
	array(
		'default'           => __( 'View All', 'blog-posts' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_posts_posts_carousel_view_all_button_label',
	array(
		'label'           => esc_html__( 'View All Button Label', 'blog-posts' ),
		'section'         => 'blog_posts_posts_carousel_section',
		'settings'        => 'blog_posts_posts_carousel_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'blog_posts_if_posts_carousel_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blog_posts_posts_carousel_view_all_button_label',
		array(
			'selector'            => '.post-carousel-section .adore-view-all',
			'settings'            => 'blog_posts_posts_carousel_view_all_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'blog_posts_posts_carousel_view_all_button_label_text_partial',
		)
	);
}

// View All button URL setting.
$wp_customize->add_setting(
	'blog_posts_posts_carousel_view_all_button_url',
	array(
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'blog_posts_posts_carousel_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button Link', 'blog-posts' ),
		'section'         => 'blog_posts_posts_carousel_section',
		'settings'        => 'blog_posts_posts_carousel_view_all_button_url',
		'type'            => 'url',
		'active_callback' => 'blog_posts_if_posts_carousel_enabled',
	)
);

// posts carousel content type settings.
$wp_customize->add_setting(
	'blog_posts_posts_carousel_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'glowing_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'blog_posts_posts_carousel_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'blog-posts' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'blog-posts' ),
		'section'         => 'blog_posts_posts_carousel_section',
		'type'            => 'select',
		'active_callback' => 'blog_posts_if_posts_carousel_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'blog-posts' ),
			'category' => esc_html__( 'Category', 'blog-posts' ),
		),
	)
);


for ( $blog_posts_i = 1; $blog_posts_i <= 5; $blog_posts_i++ ) {
	// posts carousel post setting.
	$wp_customize->add_setting(
		'blog_posts_posts_carousel_post_' . $blog_posts_i,
		array(
			'sanitize_callback' => 'glowing_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'blog_posts_posts_carousel_post_' . $blog_posts_i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'blog-posts' ), $blog_posts_i ),
			'section'         => 'blog_posts_posts_carousel_section',
			'type'            => 'select',
			'choices'         => glowing_blog_get_post_choices(),
			'active_callback' => 'blog_posts_posts_carousel_section_content_type_post_enabled',
		)
	);

}

// posts carousel category setting.
$wp_customize->add_setting(
	'blog_posts_posts_carousel_category',
	array(
		'sanitize_callback' => 'glowing_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'blog_posts_posts_carousel_category',
	array(
		'label'           => esc_html__( 'Category', 'blog-posts' ),
		'section'         => 'blog_posts_posts_carousel_section',
		'type'            => 'select',
		'choices'         => glowing_blog_get_post_cat_choices(),
		'active_callback' => 'blog_posts_posts_carousel_section_content_type_category_enabled',
	)
);

/*========================Active Callback==============================*/
function blog_posts_if_posts_carousel_enabled( $control ) {
	return $control->manager->get_setting( 'blog_posts_posts_carousel_section_enable' )->value();
}
function blog_posts_posts_carousel_section_content_type_post_enabled( $control ) {
	$blog_posts_carousel_content_type = $control->manager->get_setting( 'blog_posts_posts_carousel_content_type' )->value();
	return blog_posts_if_posts_carousel_enabled( $control ) && ( 'post' === $blog_posts_carousel_content_type );
}
function blog_posts_posts_carousel_section_content_type_category_enabled( $control ) {
	$blog_posts_carousel_content_type = $control->manager->get_setting( 'blog_posts_posts_carousel_content_type' )->value();
	return blog_posts_if_posts_carousel_enabled( $control ) && ( 'category' === $blog_posts_carousel_content_type );
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'blog_posts_posts_carousel_title_text_partial' ) ) :
	// Title.
	function blog_posts_posts_carousel_title_text_partial() {
		return esc_html( get_theme_mod( 'blog_posts_posts_carousel_title' ) );
	}
endif;
if ( ! function_exists( 'blog_posts_posts_carousel_view_all_button_label_text_partial' ) ) :
	// Title.
	function blog_posts_posts_carousel_view_all_button_label_text_partial() {
		return esc_html( get_theme_mod( 'blog_posts_posts_carousel_view_all_button_label' ) );
	}
endif;
