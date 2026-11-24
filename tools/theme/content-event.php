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

	   <section class="ev-card">
		<h3 class="ev-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	   <div class="ev-body<?php if(has_post_thumbnail()): ?> has-thumb<?php endif; ?>">
<?php
  if(has_post_thumbnail()):
?>
	   <div class="ev-thumb">
		<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail('large'); ?></a>
	   </div>
<?php endif; ?>
	   <div class="ev-text"><p><?php echo mb_substr(get_the_excerpt(), 0,250); ?></p>
		<p><a href="<?php the_permalink(); ?>" class="ev-btn">詳細を見る</a></p>
		</div>
	   </div>
	</section>

	<?php
	do_action( 'spacious_after_post_content' );
   ?>
