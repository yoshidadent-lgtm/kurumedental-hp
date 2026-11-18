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
	<div class="comm_frame_title">1歳半・3歳児歯科健診</div>
	</div>
</div>


<div id="business_checkup_flame_08">
<div class="comm_frame_title_wrap">
<div class="comm_frame_title"><?php the_field('business-location-title'); ?></div>
</div>
							<font>実施場所：</font><?php the_field('business-location'); ?><br>
							<font>受付時間：</font><?php the_field('business-location-nendo'); ?><br>
							<font>診察開始：</font><?php the_field('business-location-shinsatsu'); ?><br>
							<font>定員：</font><?php the_field('business-location-teiin'); ?><br>
							<p class="access"><a href="<?php the_field('business-location-access'); ?>" target="_blank">＞＞アクセスはこちらをご覧下さい</a></p>

<div class="Flex_wrap">
  <div class="Hurf-wrap">
    <div class="area--title">【1歳6か月児健診】実施日</div>
							<div class="business_checkup_area">
								<?php if(have_rows('business-location-nittei')): ?>
								<?php while(have_rows('business-location-nittei')): the_row(); ?>
								<div class="Item">
								<div><?php the_sub_field('business-days-issai'); ?></div>
								</div>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
  </div>
  
    <div class="Hurf-wrap">
    <div class="area--title">【3歳児健診】実施日</div>
							<div class="business_checkup_area">
								<?php if(have_rows('business-location-nittei2')): ?>
								<?php while(have_rows('business-location-nittei2')): the_row(); ?>
								<div class="Item">
								<div><?php the_sub_field('business-days-sansai'); ?></div>
								</div>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
  </div>
</div>


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

