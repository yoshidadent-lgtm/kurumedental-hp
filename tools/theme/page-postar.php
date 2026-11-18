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
	 <h1>
	     <img src="<?php bloginfo('stylesheet_directory'); ?>/images/introduction/main_image.png" alt="ポスター" class="pc_image">
	     <img src="<?php bloginfo('stylesheet_directory'); ?>/images/introduction/mainimage_sp.png" alt="ポスター" class="sp_image">
	 </h1>
	</section>


		<div class="clearfix">
		<div id="main_contents_second">

<h2 class="bg" style="margin-top:0;"><?php the_field('postar-event-title'); ?>（入選者発表）</h2>


		<?php if(have_rows('special-wrap')): ?>
<div class="comm_frame_title_wrap">
<div class="comm_frame_title">特別賞</div>
</div>
		<?php while(have_rows('special-wrap')): the_row(); ?>
		<h3><?php the_sub_field('sp-titlename'); ?></h3>
		<div class="po--wrap--box po-flex-wrap po-flex-wrap--center po-flex-nowrap">

			<?php if(have_rows('sp-wrap')): ?>
			<?php while(have_rows('sp-wrap')): the_row(); ?>
				 <dl class="special">
				  <dd>
				    <div class="special"><span></span><a href="<?php the_sub_field('sp-img'); ?>" data-lightbox="gallery" data-title="<?php the_sub_field('sp-grade'); ?>年 <?php the_sub_field('sp-stdudent-name'); ?>"><img src="<?php the_sub_field('sp-img'); ?>"></a></div>
				    <div><?php the_sub_field('sp-shool-name'); ?>学校<br><?php the_sub_field('sp-grade'); ?>年 <?php the_sub_field('sp-stdudent-name'); ?>
		</div>
			  </dd>
			 </dl>
			<?php endwhile; ?>
			<?php endif; ?>


	</div>
	<?php endwhile; ?>
	<?php endif; ?>

<div class="postar">
<!---小学生--->
	<!---金賞--->
		<?php if(have_rows('go-wrap')): ?>
	<h3 class="primary-sh">小学生</h3>
	<div class="comm_frame_title_wrap"><div class="comm_frame_title comm_medal_go_title medal_title"><span class="po-medal"></span>1年生 <?php the_field('prize-name-go'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('go-wrap')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	</!---金賞--->

	<!---銀賞--->
		<?php if(have_rows('shi-wrap')): ?>
		<div class="comm_frame_title_wrap comm_frame_title_wrap-shi"><div class="comm_frame_title comm_medal_shi_title medal_title"><span class="po-medal po-medal-shi"></span>1年生 <?php the_field('prize-name-sh'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('shi-wrap')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	<!---銀賞--->


	<!---金賞--->
		<?php if(have_rows('go-wrap02')): ?>
		<div class="comm_frame_title_wrap"><div class="comm_frame_title comm_medal_go_title medal_title"><span class="po-medal"></span>2年生 <?php the_field('prize-name-go'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('go-wrap02')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	</!---金賞--->

	<!---銀賞--->
		<?php if(have_rows('shi-wrap02')): ?>
		<div class="comm_frame_title_wrap comm_frame_title_wrap-shi"><div class="comm_frame_title comm_medal_shi_title medal_title"><span class="po-medal po-medal-shi"></span>2年生 <?php the_field('prize-name-sh'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('shi-wrap02')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	<!---銀賞--->

	<!---金賞--->
		<?php if(have_rows('go-wrap03')): ?>
	<div class="comm_frame_title_wrap"><div class="comm_frame_title comm_medal_go_title medal_title"><span class="po-medal"></span>3年生 <?php the_field('prize-name-go'); ?></div></div>

		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('go-wrap03')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
		<?php endwhile; ?>
			 </div>
	<?php endif; ?>

	</!---金賞--->

	<!---銀賞--->
		<?php if(have_rows('shi-wrap03')): ?>
	<div class="comm_frame_title_wrap comm_frame_title_wrap-shi"><div class="comm_frame_title comm_medal_shi_title medal_title"><span class="po-medal po-medal-shi"></span>3年生 <?php the_field('prize-name-sh'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('shi-wrap03')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	<!---銀賞--->
	
	<!---金賞--->
		<?php if(have_rows('go-wrap04')): ?>
	<div class="comm_frame_title_wrap"><div class="comm_frame_title comm_medal_go_title medal_title"><span class="po-medal"></span>4年生 <?php the_field('prize-name-go'); ?></div></div>

		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('go-wrap04')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
		<?php endwhile; ?>
			 </div>
	<?php endif; ?>

	</!---金賞--->

	<!---銀賞--->
		<?php if(have_rows('shi-wrap04')): ?>
	<div class="comm_frame_title_wrap comm_frame_title_wrap-shi"><div class="comm_frame_title comm_medal_shi_title medal_title"><span class="po-medal po-medal-shi"></span>4年生 <?php the_field('prize-name-sh'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('shi-wrap04')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	<!---銀賞--->


	<!---金賞--->
		<?php if(have_rows('go-wrap05')): ?>
	<div class="comm_frame_title_wrap"><div class="comm_frame_title comm_medal_go_title medal_title"><span class="po-medal"></span>5年生 <?php the_field('prize-name-go'); ?></div></div>

		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('go-wrap05')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
		<?php endwhile; ?>
			 </div>
	<?php endif; ?>

	</!---金賞--->

	<!---銀賞--->
		<?php if(have_rows('shi-wrap05')): ?>
	<div class="comm_frame_title_wrap comm_frame_title_wrap-shi"><div class="comm_frame_title comm_medal_shi_title medal_title"><span class="po-medal po-medal-shi"></span>5年生 <?php the_field('prize-name-sh'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('shi-wrap05')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	<!---銀賞--->


	<!---金賞--->
		<?php if(have_rows('go-wrap06')): ?>
	<div class="comm_frame_title_wrap"><div class="comm_frame_title comm_medal_go_title medal_title"><span class="po-medal"></span>6年生 <?php the_field('prize-name-go'); ?></div></div>

		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('go-wrap06')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
		<?php endwhile; ?>
			 </div>
	<?php endif; ?>

	</!---金賞--->

	<!---銀賞--->
		<?php if(have_rows('shi-wrap06')): ?>
	<div class="comm_frame_title_wrap comm_frame_title_wrap-shi"><div class="comm_frame_title comm_medal_shi_title medal_title"><span class="po-medal po-medal-shi"></span>6年生 <?php the_field('prize-name-sh'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('shi-wrap06')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br>
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	<!---銀賞--->


	<!---金賞--->
		<?php if(have_rows('go-wrap07')): ?>
<h3 class="middle-sh">中高生</h3>
	<div class="comm_frame_title_wrap"><div class="comm_frame_title comm_medal_go_title medal_title"><span class="po-medal"></span>中高生 <?php the_field('prize-name-go'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('go-wrap07')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br><?php the_sub_field('go-child-grade'); ?>　
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
		<?php endwhile; ?>
			 </div>
	<?php endif; ?>

	</!---金賞--->

	<!---銀賞--->
		<?php if(have_rows('shi-wrap07')): ?>
			<div class="comm_frame_title_wrap comm_frame_title_wrap-shi"><div class="comm_frame_title comm_medal_shi_title medal_title"><span class="po-medal po-medal-shi"></span>中高生 <?php the_field('prize-name-sh'); ?></div></div>
		<div class="po-flex-wrap po--wrap--box">
			<?php while(have_rows('shi-wrap07')): the_row(); ?>
			 <dl>
			  <dd>
			    <div><span></span><a href="<?php the_sub_field('go-child-img'); ?>" data-lightbox="gallery03" data-title="<?php the_sub_field('go-child-name'); ?>"><img src="<?php the_sub_field('go-child-img'); ?>"></a></div>
			    <div>
			    <?php the_sub_field('go-child-school'); ?>学校<br><?php the_sub_field('go-child-grade'); ?>　
			    <?php the_sub_field('go-child-name'); ?>
			  </dd>
			 </dl>
	<?php endwhile; ?>
			 </div>
	<?php endif; ?>
	<!---銀賞--->




		</div>
</div>
<?php get_sidebar('custom'); ?>


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

