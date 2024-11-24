<?php
/**
 * Template part for displaying front page introduction.
 *
 * @package Blog Posts Pro
 */

// Posts Column Section.
$blog_posts_carousel_section = get_theme_mod( 'blog_posts_posts_carousel_section_enable', false );

if ( false === $blog_posts_carousel_section ) {
	return;
}

$blog_posts_content_ids = array();

$blog_posts_carousel_content_type = get_theme_mod( 'blog_posts_posts_carousel_content_type', 'post' );

if ( $blog_posts_carousel_content_type === 'post' ) {

	for ( $blog_posts_i = 1; $blog_posts_i <= 5; $blog_posts_i++ ) {
		$blog_posts_content_ids[] = get_theme_mod( 'blog_posts_posts_carousel_post_' . $blog_posts_i );
	}

	$blog_posts_carousel_args = array(
		'post_type'           => 'post',
		'post__in'            => array_filter( $blog_posts_content_ids ),
		'orderby'             => 'post__in',
		'posts_per_page'      => absint( 5 ),
		'ignore_sticky_posts' => true,
	);

} else {
	$blog_posts_cat_content_id = get_theme_mod( 'blog_posts_posts_carousel_category' );
	$blog_posts_carousel_args           = array(
		'cat'            => $blog_posts_cat_content_id,
		'posts_per_page' => absint( 5 ),
	);
}

$blog_posts_carousel_query = new WP_Query( $blog_posts_carousel_args );
if ( $blog_posts_carousel_query->have_posts() ) {
	$blog_posts_carousel_section_title    = get_theme_mod( 'blog_posts_posts_carousel_title', __( 'Posts Carousel', 'blog-posts' ) );
	$blog_posts_carousel_section_subtitle = get_theme_mod( 'blog_posts_posts_carousel_subtitle', '' );
	$blog_posts_carousel_viewall_btn      = get_theme_mod( 'blog_posts_posts_carousel_view_all_button_label', __( 'View All', 'blog-posts' ) );
	$blog_posts_carousel_viewall_btn_link = get_theme_mod( 'blog_posts_posts_carousel_view_all_button_url', '#' );
	if ( 'category' === $blog_posts_carousel_content_type ) {
		$blog_posts_carousel_category = get_theme_mod( 'blog_posts_posts_carousel_category' );
		$blog_posts_carousel_viewall_btn_link  = ! empty( $blog_posts_carousel_viewall_btn_link ) ? $blog_posts_carousel_viewall_btn_link : get_category_link( $blog_posts_carousel_category );
	} else {
		$blog_posts_carousel_viewall_btn_link = ! empty( $blog_posts_carousel_viewall_btn_link ) ? $blog_posts_carousel_viewall_btn_link : '#';
	}

	?>
	<div id="blog_posts_posts_carousel_section" class="frontpage post-carousel-section">
		<div class="theme-wrapper">
			<?php if ( ! empty( $blog_posts_carousel_section_title || $blog_posts_carousel_section_subtitle || $blog_posts_carousel_viewall_btn ) ) : ?>
				<div class="section-head">
					<div class="section-header">
						<h3 class="section-title"><?php echo esc_html( $blog_posts_carousel_section_title ); ?></h3>
						<p class="section-subtitle"><?php echo esc_html( $blog_posts_carousel_section_subtitle ); ?></p>
					</div>
					<a href="<?php echo esc_url( $blog_posts_carousel_viewall_btn_link ); ?>" class="adore-view-all"><?php echo esc_html( $blog_posts_carousel_viewall_btn ); ?></a>
				</div>
				<?php
			endif;
			?>

			<div class="post-carousel-wrapper adore-navigation 4-column" data-slick='{"autoplay": true }'>
				<?php
				while ( $blog_posts_carousel_query->have_posts() ) :
					$blog_posts_carousel_query->the_post();
					?>
					<div class="post-item-outer">
						<div class="post-item overlay-post" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'post-thumbnail' ) ); ?>');">
							<div class="post-overlay">
								<div class="post-item-content">
									<div class="entry-cat overlay-cat">
										<?php the_category( '', '', get_the_ID() ); ?>
									</div>
									<h2 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<ul class="entry-meta">
										<li class="post-author"> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i><?php echo esc_html( get_the_author() ); ?></a></li>
										<li class="post-date"><i class="far fa-calendar-alt"></i></span><?php echo esc_html( get_the_date() ); ?></li>
										<li class="reading-time"><i class="far fa-hourglass"></i>
											<?php
											echo glowing_blog_time_interval( get_the_content() );
											echo esc_html__( ' min', 'blog-posts' );
											?>
										</li>
									</ul>
								</div>   
							</div>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
<?php } ?>
