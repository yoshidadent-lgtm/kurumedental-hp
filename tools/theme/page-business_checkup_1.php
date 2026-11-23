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

<section class="ck-card ck-detail">
<dl class="ck-rows">
<?php ck_row('実施場所', 'business-location'); ?>
<?php ck_row('実施時間', 'business-location-date'); ?>
<?php ck_row('実施年度', 'business-location-nendo'); ?>
<?php ck_row('実施日', 'business-location-nendo'); ?>
</dl>
<?php if(have_rows('business-location-days')): ?>
<ol class="ck-days ck-days-single">
<?php while(have_rows('business-location-days')): the_row(); ?>
<li><?php the_sub_field('business-days'); ?></li>
<?php endwhile; ?>
</ol>
<?php endif; ?>
<dl class="ck-rows">
<?php ck_row('負担金額', 'business-location-futankin'); ?>
<?php ck_row('実施要領', 'business-location-yoryo'); ?>
<?php ck_row('問合せ先', 'business-location-info'); ?>
</dl>
</section>
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

