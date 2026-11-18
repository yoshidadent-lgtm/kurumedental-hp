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

<?php if(is_page('introduction') || page_is_ancestor_of('introduction')): ?>
	<section class="page_fv">
	 <h1>
	     <img src="<?php bloginfo('stylesheet_directory'); ?>/images/introduction/main_image.png" alt="歯科医師会のご案内" class="pc_image">
	     <img src="<?php bloginfo('stylesheet_directory'); ?>/images/introduction/mainimage_sp.png" alt="歯科医師会のご案内" class="sp_image">
	 </h1>
	</section>

<?php elseif(is_page('visiting_dental') || page_is_ancestor_of('visiting_dental')): ?>
	<section class="page_fv">
	<h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/fv.jpg" alt="訪問歯科診療のご案内" class="pc_image">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/mainimage_sp.jpg" alt="訪問歯科診療のご案内" class="sp_image">
	</h1>
	</section>

<?php elseif(is_page('holiday_clinic') || page_is_ancestor_of('holiday_clinic')): ?>
	<section class="page_fv">
	<h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/holiday_clinic/holiday_clinic_main_title.png" alt="休日診療のご案内" class="pc_image">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/holiday_clinic/mainimage_sp.png" alt="休日診療のご案内" class="sp_image">
	</h1>
	</section>

<?php elseif(is_page('business_checkup') || page_is_ancestor_of('business_checkup')): ?>
	<section class="page_fv">
	 <h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/main_image.png" alt="健診事業のご案内" class="pc_image">
	 <img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/mainimage_sp.png" alt="健診事業のご案内" class="sp_image">
	 </h1>
	</section>

<?php elseif(is_page('local_dentist_top') || page_is_ancestor_of('local_dentist_top')): ?>
	<section class="page_fv">
	<h1>
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/mainimage.png" alt="地域の歯医者さん" class="pc_image">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/mainimage_sp.png" alt="地域の歯医者さん" class="sp_image">
	</h1>
	</section>

<?php elseif(is_page('assistant_course') || page_is_ancestor_of('assistant_course')): ?>
	<section class="page_fv">
	<h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/assistant_course/main_image.png" alt="歯科助手講習会のご案内" class="pc_image">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/assistant_course/mainimage_sp.png" alt="歯科助手講習会のご案内" class="sp_image">
	</h1>
	</section>

<?php elseif(is_page('link') || page_is_ancestor_of('link')): ?>
	<section class="page_fv">
	<h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/link/link_main_title.jpg" alt="リンク集" class="pc_image">
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/link/mainimage_sp.jpg" alt="リンク集" class="sp_image">
</h1>
	</section>

<?php endif; ?>

		<div class="clearfix">
		<div id="main_contents_second">
			<?php while ( have_posts() ) : the_post(); ?>
			<?php remove_filter('the_content', 'wpautop'); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
		</div>

<?php if( is_page(array('66','153','166','169','71','173','171','224','228')) ) : ?>
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

