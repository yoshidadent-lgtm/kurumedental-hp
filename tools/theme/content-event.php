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

	   <div class="Flex_wrap Flex_nowrap mb_none">

<?php
  if(has_post_thumbnail()):
?>
	   <div class="Thumb">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
	   </div>
<?php endif; ?>

	   <div><p><?php echo mb_substr(get_the_excerpt(), 0,250); ?></p>
		<p><a href="<?php the_permalink(); ?>" class="comm_detail_btn">詳細を見る</a></p>
		</div>
	   </div>

	</div>




	<?php
	do_action( 'spacious_after_post_content' );
   ?>
