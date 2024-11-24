<?php

function blog_posts_intro_text( $default_text ) {
	$default_text .= sprintf(
		'<p class="blog-posts-demo-data">%1$s <a href="%2$s" target="_blank">%3$s</a></p>',
		esc_html__( 'Demo content files for Blog Posts Theme.', 'blog-posts' ),
		esc_url( 'https://demo.adorethemes.com/documentations/docs/blog-posts/demo-data/' ),
		esc_html__( 'Click here for Demo File download', 'blog-posts' )
	);

	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'blog_posts_intro_text' );

/**
 * OCDI after import.
 */
function blog_posts_after_import_setup() {
	// Assign menus to their locations.
	$blog_posts_primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$blog_posts_social_menu  = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary' => $blog_posts_primary_menu->term_id,
			'social'  => $blog_posts_social_menu->term_id,
		)
	);

}
add_action( 'ocdi/after_import', 'blog_posts_after_import_setup' );
