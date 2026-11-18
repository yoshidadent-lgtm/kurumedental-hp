<?php
/**
 * The template for displaying 404 pages (Page Not Found).
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

	<?php do_action( 'spacious_before_body_content' ); ?>

	<section>
 <div class="single_wrap">
		<div id="content" class="clearfix">
			<section class="error-404 not-found">
				<div class="page-content">

					<?php if ( ! dynamic_sidebar( 'spacious_error_404_page_sidebar' ) ) : ?>
						<header class="page-header">
							<h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'spacious' ); ?></h2>
						</header>
						<p><?php _e( 'It looks like nothing was found at this location. Try the search below.', 'spacious' ); ?></p>
					<?php endif; ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div><!-- #content -->
	</div><!-- #primary -->
</section>

	<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>
