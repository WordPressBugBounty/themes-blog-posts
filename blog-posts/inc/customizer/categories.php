<?php
/**
 * Adore Themes Customizer
 *
 * @package Blog Posts
 *
 * Categories Section
 */

$wp_customize->add_section(
	'blog_posts_categories_section',
	array(
		'title' => esc_html__( 'Categories Section', 'blog-posts' ),
		'panel' => 'glowing_blog_frontpage_panel',
	)
);

// Categories Section section enable settings.
$wp_customize->add_setting(
	'blog_posts_categories_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'glowing_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Posts_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_posts_categories_section_enable',
		array(
			'label'    => esc_html__( 'Enable Categories Section', 'blog-posts' ),
			'type'     => 'checkbox',
			'settings' => 'blog_posts_categories_section_enable',
			'section'  => 'blog_posts_categories_section',
		)
	)
);

// Categories Section title settings.
$wp_customize->add_setting(
	'blog_posts_categories_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_posts_categories_title',
	array(
		'label'           => esc_html__( 'Section Title', 'blog-posts' ),
		'section'         => 'blog_posts_categories_section',
		'active_callback' => 'blog_posts_if_categories_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blog_posts_categories_title',
		array(
			'selector'            => '.categories-section h3.section-title',
			'settings'            => 'blog_posts_categories_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'blog_posts_categories_title_text_partial',
		)
	);
}

// Categories Section subtitle settings.
$wp_customize->add_setting(
	'blog_posts_categories_subtitle',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_posts_categories_subtitle',
	array(
		'label'           => esc_html__( 'Section Subtitle', 'blog-posts' ),
		'section'         => 'blog_posts_categories_section',
		'active_callback' => 'blog_posts_if_categories_enabled',
	)
);

// View All button label setting.
$wp_customize->add_setting(
	'blog_posts_categories_view_all_button_label',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_posts_categories_view_all_button_label',
	array(
		'label'           => esc_html__( 'View All Button Label', 'blog-posts' ),
		'section'         => 'blog_posts_categories_section',
		'settings'        => 'blog_posts_categories_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'blog_posts_if_categories_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blog_posts_categories_view_all_button_label',
		array(
			'selector'            => '.categories-section .adore-view-all',
			'settings'            => 'blog_posts_categories_view_all_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'blog_posts_categories_view_all_button_label_text_partial',
		)
	);
}

// View All button URL setting.
$wp_customize->add_setting(
	'blog_posts_categories_view_all_button_url',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'blog_posts_categories_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button Link', 'blog-posts' ),
		'section'         => 'blog_posts_categories_section',
		'settings'        => 'blog_posts_categories_view_all_button_url',
		'type'            => 'url',
		'active_callback' => 'blog_posts_if_categories_enabled',
	)
);

for ( $blog_posts_i = 1; $blog_posts_i <= 5; $blog_posts_i++ ) {

	// categories category setting.
	$wp_customize->add_setting(
		'blog_posts_categories_category_' . $blog_posts_i,
		array(
			'sanitize_callback' => 'glowing_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'blog_posts_categories_category_' . $blog_posts_i,
		array(
			'label'           => sprintf( esc_html__( 'Category %d', 'blog-posts' ), $blog_posts_i ),
			'section'         => 'blog_posts_categories_section',
			'settings'        => 'blog_posts_categories_category_' . $blog_posts_i,
			'type'            => 'select',
			'choices'         => glowing_blog_get_post_cat_choices(),
			'active_callback' => 'blog_posts_if_categories_enabled',
		)
	);

	// categories bg image.
	$wp_customize->add_setting(
		'blog_posts_categories_image_' . $blog_posts_i,
		array(
			'default'           => '',
			'sanitize_callback' => 'glowing_blog_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'blog_posts_categories_image_' . $blog_posts_i,
			array(
				'label'           => sprintf( esc_html__( 'Category Image %d', 'blog-posts' ), $blog_posts_i ),
				'section'         => 'blog_posts_categories_section',
				'settings'        => 'blog_posts_categories_image_' . $blog_posts_i,
				'active_callback' => 'blog_posts_if_categories_enabled',
			)
		)
	);

}

/*========================Active Callback==============================*/
function blog_posts_if_categories_enabled( $control ) {
	return $control->manager->get_setting( 'blog_posts_categories_section_enable' )->value();
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'blog_posts_categories_title_text_partial' ) ) :
	// Title.
	function blog_posts_categories_title_text_partial() {
		return esc_html( get_theme_mod( 'blog_posts_categories_title' ) );
	}
endif;
if ( ! function_exists( 'blog_posts_categories_view_all_button_label_text_partial' ) ) :
	// Title.
	function blog_posts_categories_view_all_button_label_text_partial() {
		return esc_html( get_theme_mod( 'blog_posts_categories_view_all_button_label' ) );
	}
endif;
