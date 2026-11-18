


<?php get_header(); ?>

  <div id="main" class="clearfix">
     <div class="inner-wrap">
	<?php do_action( 'spacious_before_body_content' ); ?>

		<div id="content" class="clearfix">

<article>
 <div class="l-inner checkup">

	<section class="page_fv">
<h1>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/visiting_dental/fv.jpg" alt="健診事業のご案内" class="pc_image">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/visiting_dental/mainimage_sp.jpg" alt="健診事業のご案内" class="sp_image">
                        </h1>
	</section>

		<div class="clearfix">
		<div id="holiday_clinic_main_contents">
					<div id="itroduction_left_contents">
					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/image_01.jpg">
					</div>
					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/tel_info1.jpg">
					</div>
					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/image_02.jpg">
					</div>
					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/image_03.jpg">
					</div>
					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/image_04.jpg">
					</div>
					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/image_05.jpg">
¥					</div>

					<div class="visiting_box">	
					  <div class="visiting_sub_title">
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/gyoumu_taitle.jpg">
					  </div>
					  <?php the_field('job'); ?>
					</div>

					<div class="visiting_box">	
					  <div class="visiting_sub_title">
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/taisho_title.jpg">
					  </div><?php the_field('target'); ?>
					</div>

					<div class="visiting_box">	
					  <div class="visiting_sub_title">
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/taishotiiki_title.jpg">
					  </div>
					<?php the_field('place'); ?>
					</div>

					<div class="visiting_box">	
					  <div class="visiting_sub_title">
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/hiyo_title.jpg">
					  </div><?php the_field('price'); ?>
					</div>

					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/tel_info1.jpg">
					</div>

 <?php the_field('free-area'); ?>
					</div>					
				</div>

<?php if( is_page(array('66','153','166','169','71','173','171')) ) : ?>
<?php get_sidebar('custom'); ?>
<?php else: ?>
<?php get_sidebar(); ?>  <!-- $name -->
<?php endif; ?>

		</div>
	</div>
</article>
		 </div>	<!-- #content -->
	</div><!-- #primary -->
</div>


<?php do_action( 'spacious_after_body_content' ); ?>



<?php get_footer(); ?>

