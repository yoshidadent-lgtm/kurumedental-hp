<?php 
/**
 * Theme Page Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>



<?php get_header(); ?>

<?php do_action( 'spacious_after_header' ); ?>


<?php do_action( 'spacious_before_main' ); ?>
  <div id="main" class="clearfix">
     <div class="inner-wrap">
	<?php do_action( 'spacious_before_body_content' ); ?>

		<div id="content" class="clearfix">

<article>
 <div class="l-inner">

	<section class="page_fv">
	 <h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/main_image.png" alt="健診事業のご案内" class="pc_image">
	 <img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/mainimage_sp.png" alt="健診事業のご案内" class="sp_image">
	 </h1>
	</section>

		<div class="clearfix">
		<div id="main_contents_second">

<div id="itroduction_left_contents">
<div class="subtitle_top">
	<div class="comm_frame_title_wrap">
	<div class="comm_frame_title">1歳児歯科健診</div>
	</div>

</div>

<div id="business_checkup_flame_07">
							<font color="#D41D7D">実施場所：</font><?php the_field('business-location'); ?><br>
							<font color="#D41D7D">実施時間：</font><?php the_field('business-location-date'); ?><br>
							<font color="#D41D7D">実施年度：</font><?php the_field('business-location-nendo'); ?><br>
							<font color="#D41D7D">実施日：</font><?php the_field('business-location-nendo'); ?><br>
							<div class="business_checkup_wrap">
								<?php if(have_rows('business-location-days')): ?>
								<?php while(have_rows('business-location-days')): the_row(); ?>
								<div class="Item">
								<?php the_sub_field('business-days'); ?>
								</div>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
							<font color="#D41D7D">負担金額：</font><?php the_field('business-location-futankin'); ?><br>
							<font color="#D41D7D">実施要領：</font><?php the_field('business-location-yoryo'); ?><br>
							<font color="#D41D7D">問合せ先：</font><?php the_field('business-location-info'); ?><br>

</div>
</div>

		</div>

<?php if( is_page(array('66','153','166','169','71','173','171')) ) : ?>
<?php get_sidebar('custom'); ?>
<?php else: ?>
<?php get_sidebar( $name ); ?>
<?php endif; ?>

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

