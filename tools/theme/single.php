<?php 

/**

 * Theme Single Post Section for our theme.

 *

 * @package ThemeGrill

 * @subpackage Spacious

 * @since Spacious 1.0

 */

?>



<?php get_header(); ?>

<?php do_action( 'spacious_before_body_content' ); ?>



 <div class="single_wrap">

		<div id="content" class="clearfix">

<article>
 <div class="l-inner clearfix">
<div id="main_contents_second">
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', 'single' ); ?>
<?php endwhile; ?>
</div>

<?php get_sidebar('custom'); ?>
 </div>
</article>

  </div>

 </div>

</div><!-- #content -->




	</div><!-- #primary -->



	

	<?php do_action( 'spacious_after_body_content' ); ?>



<?php get_footer(); ?>

