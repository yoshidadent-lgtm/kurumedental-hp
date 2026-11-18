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

    <?php $args = array(
        'numberposts' => 1,
        'post_type' => 'finance'
    );
    $posts = get_posts( $args );
    if( $posts ) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
<div id="link_contents_second">
<table border="0" cellspacing="0" cellpadding="0">
    <tbody><tr>    
    <th class="th_01" style="width:40% !important;text-align:left;">・定款</th>
        <td><a href="<?php the_field('teikan'); ?>" target="_blank"><?php the_field('teikan_text'); ?></a></td>
      </tr>
    <tr>    
    <th class="th_01" style="text-align:left;">・事業報告</th>
        <td><a href="<?php the_field('int-jigyohoukoku'); ?>" target="_blank"><?php the_field('int-jigyohoukoku_text'); ?></a></td>
      </tr>
    <tr>    
    <th class="th_01" style="text-align:left;">・貸借対照表</th>
        <td><a href="<?php the_field('int-taisyaku'); ?>" target="_blank"><?php the_field('int-taisyaku_text'); ?></a></td>
      </tr>
    <tr>    
    <th class="th_01" style="text-align:left;">・正味財産増減計算書内訳書</th>
        <td><a href="<?php the_field('int-zaisanzogen'); ?>" target="_blank"><?php the_field('int-zaisanzogen_text'); ?></a></td>
      </tr>
    <tr>    
    <th class="th_01" style="text-align:left;">・財務諸表に対する注記</th>
        <td><a href="<?php the_field('int-zaimushohyo'); ?>" target="_blank"><?php the_field('int-zaimushohyo_text'); ?></a></td>
      </tr>
    <tr>    
    <th class="th_01" style="text-align:left;">・財務諸表に対する付属明細書</th>
        <td><a href="<?php the_field('int-zaimushohyofuzoku'); ?>" target="_blank"><?php the_field('int-zaimushohyofuzoku_text'); ?></a></td>
      </tr>
    <tr>    
    <th class="th_01" style="text-align:left;">・財産目録</th>
        <td><a href="<?php the_field('int-zaisanmokuroku'); ?>" target="_blank"><?php the_field('int-zaisanmokuroku_text'); ?></a></td>
      </tr>
  </tbody></table>
</div>
  		<?php endforeach; ?>
    <?php endif;
    wp_reset_postdata(); ?>

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

