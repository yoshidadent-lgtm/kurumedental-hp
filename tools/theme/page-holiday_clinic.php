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
	<h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/holiday_clinic/holiday_clinic_main_title.png" alt="休日診療のご案内" class="pc_image">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/holiday_clinic/mainimage_sp.png" alt="休日診療のご案内" class="sp_image">
	</h1>
	</section>

		<div class="clearfix">
		<div id="main_contents_second">

<div id="itroduction_left_contents">
<div class="subtitle_top">
	<div class="comm_frame_title_wrap">
	<div class="comm_frame_title">当番医院のご案内</div>
	</div>
</div>
<div class="holiday_clinic_text">
日曜祝日の休日診療の当番医をご案内します。<br>
お問い合わせは<font color="#FF0000">午前10時から午後5時迄</font>の間にお願いします。
</div>
<table class="holiday_clinic_table">
<tbody>
<tr>
<td class="holiday_clinic_table_header" width="100">月日</td>
<td class="holiday_clinic_table_header" width="150">医院名</td>
<td class="holiday_clinic_table_header" width="330" colspan="2">所在地</td>
<td class="holiday_clinic_table_header" width="110">電話</td>
</tr>
<?php
	$myposts = get_posts( array(
		'posts_per_page' => '-1',
		'post_type' => 'local_dentist_top',
			'meta_key' => 'holiday_days',
			'orderby' => 'meta_value',
			'order' => 'ASC',
		'meta_query' =>  array(
			array(
			'key' => 'holiday-clinic',
			'value' => 'show',
			)
		)
	));
	foreach($myposts as $post):
		setup_postdata($post);
?>
<tr>
<td class="holiday_clinic_table_text_date"><?php the_field('holiday_days'); ?></td>
<td class="holiday_clinic_table_text"><?php the_field('clinic_name'); ?></td>
<td class="holiday_clinic_table_address" colspan="2"><div class="Flex_box Flex_align_center"><?php the_field('clinic_address'); ?><a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" class="map" target="_blank">MAP</a></div></td>
<td class="holiday_clinic_table_text"><?php the_field('clinic_tel'); ?></td>
</tr>
<?php endforeach; wp_reset_postdata(); ?>
</tbody>
</table>
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

