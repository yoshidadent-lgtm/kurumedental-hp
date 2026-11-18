<?php
/**
 * The template for displaying Archive page.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>


<?php get_header(); ?>

<?php do_action( 'spacious_after_header' ); ?>


<?php do_action( 'spacious_before_main' ); ?>
  <div id="main" class="clearfix">
     <div class="inner-wrap">
	<?php do_action( 'spacious_before_body_content' ); ?>

		<div id="content" class="clearfix">

<article>
 <div class="l-inner clearfix">

	<section class="page_fv">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/main_image.png">
	</section>

<div id="main_contents_second">
<?php if(is_tax('age_business_checkup_city','kitanomachi')): ?>
	<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;北野町</p>
<?php if(have_posts()): ?>
<?php while(have_posts()):the_post(); ?>
<?php if(get_field('business_checkup_clinic_name')): ?>
	   <div class="comm_frame clearfix">
		<div class="comm_frame_title_wrap">
		<div class="comm_frame_title">
		<?php the_field('business_checkup_clinic_name'); ?>
		</div>
		</div>
			<?php if(get_field('business_checkup_clinic_address')): ?>
			<div class="clinic-contents">
			<span class="clinic-name">住所</span>		
			<?php the_field('business_checkup_clinic_address'); ?>
			</div><?php endif; ?>

			<?php if(get_field('business_checkup_clinic_tel')): ?>
			<div class="clinic-contents">
			<span class="clinic-name">TEL</span>
			<?php the_field('business_checkup_clinic_tel'); ?></div>
			<?php endif; ?>


	</div>
<?php endif; ?>
<?php endwhile; else: ?>
 <p>現在医院を登録中です</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php else: ?>
<?php endif; ?>

<?php if(is_tax('age_business_checkup_city','nanbu')): ?>
	<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;南部保護センター</p>
<?php if(have_posts()): ?>
<?php while(have_posts()):the_post(); ?>
<?php if(get_field('business_checkup_clinic_name')): ?>
	   <div class="comm_frame clearfix">
		<div class="comm_frame_title_wrap">
		<div class="comm_frame_title">
		<?php the_field('business_checkup_clinic_name'); ?>
		</div>
		</div>
			<?php if(get_field('business_checkup_clinic_address')): ?>
			<div class="clinic-contents">
			<span class="clinic-name">住所</span>		
			<?php the_field('business_checkup_clinic_address'); ?>
			</div><?php endif; ?>

			<?php if(get_field('business_checkup_clinic_tel')): ?>
			<div class="clinic-contents">
			<span class="clinic-name">TEL</span>
			<?php the_field('business_checkup_clinic_tel'); ?></div>
			<?php endif; ?>


	</div>
<?php endif; ?>
<?php endwhile; else: ?>
 <p>現在医院を登録中です</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php else: ?>
<?php endif; ?>

<?php if(is_tax('age_business_checkup_city','kurume')): ?>
	<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;久留米市役所</p>
<?php if(have_posts()): ?>
<?php while(have_posts()):the_post(); ?>
<?php if(get_field('business_checkup_clinic_name')): ?>
	   <div class="comm_frame clearfix">
		<div class="comm_frame_title_wrap">
		<div class="comm_frame_title">
		<?php the_field('business_checkup_clinic_name'); ?>
		</div>
		</div>
			<?php if(get_field('business_checkup_clinic_address')): ?>
			<div class="clinic-contents">
			<span class="clinic-name">住所</span>		
			<?php the_field('business_checkup_clinic_address'); ?>
			</div><?php endif; ?>

			<?php if(get_field('business_checkup_clinic_tel')): ?>
			<div class="clinic-contents">
			<span class="clinic-name">TEL</span>
			<?php the_field('business_checkup_clinic_tel'); ?></div>
			<?php endif; ?>


	</div>
<?php endif; ?>
<?php endwhile; else: ?>
 <p>現在医院を登録中です</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php else: ?>
<?php endif; ?>


 </div>

<?php get_sidebar('custom'); ?>

 </div>
</article>

		<!-- #content -->
	</div><!-- #primary -->
</div>
</div>

</div>

<?php do_action( 'spacious_after_body_content' ); ?>



<?php get_footer(); ?>

