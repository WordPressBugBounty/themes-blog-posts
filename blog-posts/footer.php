<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Glowing Blog
 */

?>

</div>

<?php

if ( is_singular( 'post' ) ) {

	$blog_posts_args = array(
		'posts_per_page' => 3,
		'post__not_in'   => array( $post->ID ),
		'orderby'        => 'date',
	);

	$blog_posts_cat_content_id = get_the_category( $post->ID );
	if ( ! empty( $blog_posts_cat_content_id ) ) {
		$blog_posts_args['cat'] = $blog_posts_cat_content_id[0]->term_id;
	}

	$blog_posts_query = new WP_Query( $blog_posts_args );

	if ( $blog_posts_query->have_posts() ) :
		$blog_posts_related_title = get_theme_mod( 'glowing_blog_related_posts_title', __( 'Related Posts', 'blog-posts' ) );

		?>
		<div class="related-posts">
			<?php if ( ! empty( $blog_posts_related_title ) ) : ?>
				<h2 class="related-title"><?php echo esc_html( $blog_posts_related_title ); ?></h2>
			<?php endif; ?>
			<div class="related-grid theme-archive-layout grid-layout grid-column-3">
				<?php
				while ( $blog_posts_query->have_posts() ) :
					$blog_posts_query->the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="post-item post-grid">
							<div class="post-item-image">
								<a href="<?php the_permalink(); ?>"><?php glowing_blog_post_thumbnail(); ?></a>
								<div class="entry-cat">
									<?php the_category( '', '', get_the_ID() ); ?>
								</div>
							</div>
							<div class="post-item-content">

								<?php
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
								?>
								<ul class="entry-meta">
									<li class="post-author"> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i><?php echo esc_html( get_the_author() ); ?></a></li>
									<li class="post-date"><i class="far fa-calendar-alt"></i><?php echo esc_html( get_the_date() ); ?></li>

									<li class="read-time">
										<i class="far fa-hourglass"></i>
										<?php
										echo glowing_blog_time_interval( get_the_content() );
										echo esc_html__( ' min', 'blog-posts' );
										?>
									</li>
									<li class="comment">
										<i class="far fa-comment"></i>
										<?php echo absint( get_comments_number( get_the_ID() ) ); ?>
									</li>
								</ul>
								<div class="post-content">
									<p><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), get_theme_mod( 'glowing_blog_related_excerpt_length', 15 ) ) ); ?></p>
								</div><!-- post-content -->
							</div>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php
	endif;
}

if ( ! is_front_page() || is_home() ) {
	?>
</div>
</div><!-- #content -->

<?php

if ( is_front_page() ) {

	require get_theme_file_path() . '/inc/frontpage-sections/posts-carousel.php';
}
}

?>

<footer id="colophon" class="site-footer">
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
	<div class="top-footer">
		<div class="theme-wrapper">
			<div class="top-footer-widgets">

				<?php for ( $blog_posts_i = 1; $blog_posts_i <= 3; $blog_posts_i++ ) { ?>
					<div class="footer-widget">
						<?php dynamic_sidebar( 'footer-' . $blog_posts_i ); ?>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
<?php endif; ?>


<?php
$glowing_blog_search = array( '[the-year]', '[site-link]' );
$blog_posts_replace             = array( date( 'Y' ), '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );
$blog_posts_copyright_default   = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'blog-posts' ), '[the-year]', '[site-link]' );
$blog_posts_copyright_text      = get_theme_mod( 'glowing_blog_copyright_text', $blog_posts_copyright_default );
$blog_posts_copyright_text      = str_replace( $glowing_blog_search, $blog_posts_replace, $blog_posts_copyright_text );
$blog_posts_footer_social_class = has_nav_menu( 'social' ) ? '' : 'no-footer-social-menu';
?>
<div class="bottom-footer">
	<div class="theme-wrapper">
		<div class="bottom-footer-info <?php echo esc_attr( $blog_posts_footer_social_class ); ?>">
			<div class="site-info">
				<span>
					<?php echo wp_kses_post( $blog_posts_copyright_text ); ?>
					<?php echo sprintf( esc_html__( 'Theme: %1$s By %2$s.', 'blog-posts' ), wp_get_theme()->get( 'Name' ), '<a href="' . wp_get_theme()->get( 'AuthorURI' ) . '">' . wp_get_theme()->get( 'Author' ) . '</a>' ); ?>
				</span>
			</div><!-- .site-info -->
			<div class="social-icons">
				<?php
				if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'menu_class'     => 'menu social-links',
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
							'theme_location' => 'social',
						)
					);
				}
				?>
			</div>
		</div>
	</div>
</div>

</footer><!-- #colophon -->

<?php if ( get_theme_mod( 'glowing_blog_enable_scroll_to_top', true ) === true ) : ?>
	<a href="#" id="scroll-to-top" class="glowing-blog-scroll-to-top"><i class="fas fa-chevron-up"></i></a>
<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
