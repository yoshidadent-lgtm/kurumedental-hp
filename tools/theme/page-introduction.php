<?php ?>



<?php get_header(); ?>

<?php do_action( 'spacious_after_header' ); ?>


<?php do_action( 'spacious_before_main' ); ?>
  <div id="main" class="clearfix">
     <div class="inner-wrap">
	<?php do_action( 'spacious_before_body_content' ); ?>

<div id="content" class="clearfix">

<?php if( !post_password_required( $post->ID ) ) :  ?>
<article>
 <div class="l-inner">

	<section class="page_fv">
	 <h1>
	     <img src="<?php bloginfo('stylesheet_directory'); ?>/images/introduction/main_image.png" alt="歯科医師会のご案内" class="pc_image">
	     <img src="<?php bloginfo('stylesheet_directory'); ?>/images/introduction/mainimage_sp.png" alt="歯科医師会のご案内" class="sp_image">
	 </h1>
	</section>


		<div class="clearfix">
		<div id="main_contents_second">
    <div id="itroduction_main_contents">
    <div id="itroduction_left_contents">
      <div class="subtitle_top">
        <div class="comm_frame_title_wrap">
          <div class="comm_frame_title">会長のご挨拶</div>
        </div>
      </div>
      <div id="introduction_image">
        <img src="<?php the_field('chairman_image'); ?>"><br>
        久留米歯科医師会<br>
        会長　  <?php the_field('chairman'); ?>
      </div>
      <div id="introduction_text">
      <?php the_field('message'); ?>
				</div>
    </div>

		</div>
    </div>
<?php if( is_page(array('66','153','166','169','71','173','171','224','228')) ) : ?>
<?php get_sidebar('custom'); ?>

<?php elseif( is_page(array('279','240')) ) : ?>
<?php get_sidebar( $name ); ?>

<?php else: ?>
<?php get_sidebar( $name ); ?>
<?php endif; ?>

		</div>

 </div>
</article>

<?php else:  ?>
<article>
  <div class="l-inner">
	<?php echo get_the_password_form(); ?>
  </div>
</article>
<?php endif;  ?>
		<!-- #content -->
	</div><!-- #primary -->
</div>
</div>

</div>

<?php do_action( 'spacious_after_body_content' ); ?>



<?php get_footer(); ?>

