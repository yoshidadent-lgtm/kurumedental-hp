<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

	<?php do_action( 'spacious_before_post_content' ); ?>

	   <div class="comm_frame clearfix">
		<div class="comm_frame_title_wrap">
		<div class="comm_frame_title">
		<?php the_title(); ?>
		</div>
		</div>
			<span class="day_date"><?php the_time('Y年m月d日');?></span>
	   <p><?php the_content(); ?></p>
	</div>




	<?php
	do_action( 'spacious_after_post_content' );
   ?>
