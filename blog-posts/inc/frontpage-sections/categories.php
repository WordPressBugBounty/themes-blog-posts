<?php
/**
 * Template part for displaying front page introduction.
 *
 * @package Blog Posts Pro
 */

// Categories Section.
$blog_posts_categories_section = get_theme_mod( 'blog_posts_categories_section_enable', false );

if ( false === $blog_posts_categories_section ) {
	return;
}

$blog_posts_section_content = array();

$blog_posts_content_ids = array();

$blog_posts_content_ids = array();
for ( $blog_posts_i = 1; $blog_posts_i <= 5; $blog_posts_i++ ) {
	$blog_posts_content_post_id = get_theme_mod( 'blog_posts_categories_category_' . $blog_posts_i );
	if ( ! empty( $blog_posts_content_post_id ) ) {
		$blog_posts_content_ids[] = $blog_posts_content_post_id;
	}
}
$blog_posts_categories_args = array(
	'taxonomy'   => 'category',
	'number'     => 5,
	'include'    => array_filter( $blog_posts_content_ids ),
	'orderby'    => 'include',
	'hide_empty' => false,
);

$blog_posts_terms = get_terms( $blog_posts_categories_args );
$blog_posts_i     = 1;
foreach ( $blog_posts_terms as $blog_posts_value ) {
	$blog_posts_data['title']         = $blog_posts_value->name;
	$blog_posts_data['count']         = $blog_posts_value->count;
	$blog_posts_data['permalink']     = get_term_link( $blog_posts_value->term_id );
	$blog_posts_data['thumbnail_url'] = get_theme_mod( 'blog_posts_categories_image_' . $blog_posts_i, '' );
	array_push( $blog_posts_section_content, $blog_posts_data );
	$blog_posts_i++;
}

$blog_posts_section_title    = get_theme_mod( 'blog_posts_categories_title', '' );
$blog_posts_section_subtitle = get_theme_mod( 'blog_posts_categories_subtitle', '' );
$blog_posts_viewall_btn      = get_theme_mod( 'blog_posts_categories_view_all_button_label', '' );
$blog_posts_viewall_btn_link = get_theme_mod( 'blog_posts_categories_view_all_button_url', '' );
?>

<div id="blog_posts_categories_section" class="frontpage categories-section">
	<div class="theme-wrapper">
		<?php if ( ! empty( $blog_posts_section_title || $blog_posts_section_subtitle ) ) : ?>
			<div class="section-head">
				<div class="section-header">
					<h3 class="section-title"><?php echo esc_html( $blog_posts_section_title ); ?></h3>
					<p class="section-subtitle"><?php echo esc_html( $blog_posts_section_subtitle ); ?></p>
				</div>
				<?php if ( ! empty( $blog_posts_viewall_btn ) ) { ?>
					<a href="<?php echo esc_url( $blog_posts_viewall_btn_link ); ?>" class="adore-view-all"><?php echo esc_html( $blog_posts_viewall_btn ); ?></a>
				<?php } ?>
			</div>
		<?php endif; ?>
		<div class="categories-wrapper">
			<?php foreach ( $blog_posts_section_content as $blog_posts_content ) : ?>
				<div class="category-single" style="background-image: url('<?php echo esc_url( $blog_posts_content['thumbnail_url'] ); ?>');">
					<a href="<?php echo esc_url( $blog_posts_content['permalink'] ); ?>">
						<span class="title">
							<?php echo esc_html( $blog_posts_content['title'] ); ?>
						</span>
						<span class="count">
							<span class="number"><?php echo absint( $blog_posts_content['count'] ); ?></span>
							<span class="view"><?php esc_html_e( 'View Posts', 'blog-posts' ); ?></span>
						</span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php
