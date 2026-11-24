<?php
/**
 * The template for displaying Archive page.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

<?php do_action( 'spacious_after_header' ); ?>


<?php do_action( 'spacious_before_main' ); ?>
  <div id="main" class="clearfix">
     <div class="inner-wrap">
	<?php do_action( 'spacious_before_body_content' ); ?>

		<div id="content" class="clearfix">

<article>
 <div class="l-inner">

	<section class="page_fv">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/event/mainimage.png" alt="イベント情報">
	</section>

<div id="main_contents_second">
<h2 class="ac-h">イベント<small>Event Info</small></h2>

			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

			<?php else : ?>

				<p>現在記事がありません</p>

			<?php endif; ?>
</div>

<?php get_sidebar('custom'); ?>

		</div>

 </div>
</article>

		<!-- #content -->
	</div><!-- #primary -->
</div>
</div>

</div>

<?php do_action( 'spacious_after_body_content' ); ?>



<?php get_footer(); ?>
