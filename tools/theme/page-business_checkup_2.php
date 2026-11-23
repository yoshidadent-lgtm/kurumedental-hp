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


<section class="ck-card ck-detail">
<h3 class="ck-title"><span><?php the_field('business-location-title'); ?></span></h3>
<dl class="ck-rows">
<?php ck_row('実施場所', 'business-location'); ?>
<?php ck_row('受付時間', 'business-location-nendo'); ?>
<?php ck_row('診察開始', 'business-location-shinsatsu'); ?>
<?php ck_row('定員', 'business-location-teiin'); ?>
</dl>
<?php if (ck_val('business-location-access') !== ''): ?>
<div class="ck-btns"><a class="ck-btn" href="<?php the_field('business-location-access'); ?>" target="_blank" rel="noopener noreferrer">アクセス（地図）を見る</a></div>
<?php endif; ?>
<div class="ck-sched">
<div class="ck-sched-col">
<h4>【1歳6か月児健診】実施日</h4>
<ol class="ck-days">
<?php if(have_rows('business-location-nittei')): while(have_rows('business-location-nittei')): the_row(); ?>
<li><?php the_sub_field('business-days-issai'); ?></li>
<?php endwhile; endif; ?>
</ol>
</div>
<div class="ck-sched-col">
<h4>【3歳児健診】実施日</h4>
<ol class="ck-days">
<?php if(have_rows('business-location-nittei2')): while(have_rows('business-location-nittei2')): the_row(); ?>
<li><?php the_sub_field('business-days-sansai'); ?></li>
<?php endwhile; endif; ?>
</ol>
</div>
</div>
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

