<?php
/**
 * Blog Posts functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blog Posts
 */

add_theme_support( 'title-tag' );

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'register_block_style' );

add_theme_support( 'register_block_pattern' );

add_theme_support( 'responsive-embeds' );

add_theme_support( 'wp-block-styles' );

add_theme_support( "post-thumbnails" );

add_theme_support( 'align-wide' );

add_theme_support(
	'html5',
	array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	)
);

add_theme_support(
	'custom-logo',
	array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	)
);

if ( ! function_exists( 'blog_posts_setup' ) ) :
	function blog_posts_setup() {
		/*
		* Make child theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
		load_child_theme_textdomain( 'blog-posts', get_stylesheet_directory() . '/languages' );
	}

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'blog_posts_custom_background_args',
			array(
				'default-color' => 'f4f3ee',
				'default-image' => '',
			)
		)
	);

endif;
add_action( 'after_setup_theme', 'blog_posts_setup' );

if ( ! function_exists( 'blog_posts_enqueue_styles' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function blog_posts_enqueue_styles() {
		$parenthandle = 'glowing-blog-style';
		$theme        = wp_get_theme();

		wp_enqueue_style(
			$parenthandle,
			get_template_directory_uri() . '/style.css',
			array(
				'glowing-blog-fonts',
				'glowing-blog-slick-style',
				'glowing-blog-fontawesome-style',
				'glowing-blog-blocks-style',
			),
			$theme->parent()->get( 'Version' )
		);

		wp_enqueue_style(
			'blog-posts-style',
			get_stylesheet_uri(),
			array( $parenthandle ),
			$theme->get( 'Version' )
		);

		wp_enqueue_script( 'blog-posts-custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', array( 'jquery', 'glowing-blog-custom-script' ), $theme->get( 'Version' ), true );

	}

endif;

add_action( 'wp_enqueue_scripts', 'blog_posts_enqueue_styles' );

require get_theme_file_path() . '/inc/customizer/customizer.php';

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blog_posts_body_classes( $classes ) {

	// added class for floating header.
	$classes[] = 'floating-header';

	return $classes;
}
add_filter( 'body_class', 'blog_posts_body_classes' );

// Register Sidebar
function blog_posts_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'blog-posts' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'blog-posts' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'blog_posts_widgets_init' );

/**
 * Pagination for archive.
 */
function blog_posts_render_posts_pagination() {
	$is_pagination_enabled = get_theme_mod( 'glowing_blog_pagination_enable', true );
	if ( $is_pagination_enabled ) {
		$pagination_type = get_theme_mod( 'blog_posts_pagination_type', 'numeric' );
		if ( 'default' === $pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'blog_posts_posts_pagination', 'blog_posts_render_posts_pagination', 10 );

function blog_posts_load_custom_wp_admin_style() {
	?>
	<style type="text/css">

		.ocdi p.demo-data-download-link {
			display: none !important;
		}

	</style>

	<?php
}
add_action( 'admin_enqueue_scripts', 'blog_posts_load_custom_wp_admin_style' );

// Style for demo data download link
function blog_posts_admin_panel_demo_data_download_link() {
	?>
	<style type="text/css">
		p.blog-posts-demo-data {
			font-size: 16px;
			font-weight: 700;
			display: inline-block;
			border: 0.5px solid #dfdfdf;
			padding: 8px;
			background: #ffff;
		}
	</style>
	<?php
}
add_action( 'admin_enqueue_scripts', 'blog_posts_admin_panel_demo_data_download_link' );

// One Click Demo Import after import setup.
if ( class_exists( 'OCDI_Plugin' ) ) {
	require get_theme_file_path() . '/inc/demo-import.php';
}
