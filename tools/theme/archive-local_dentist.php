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

<div id="main_contents_second">

	<div class="subtitle_top"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/bar_title_01.png" alt="地域の歯医者さん"></div>

	<div class="local_dentist_flame">
	<div id="map_navigation">
	<div id="map_image">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/map_on_1.png" width="586" height="292" style="display: block; opacity: 1;">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/map_on_2.png" width="586" height="292" style="display:none;">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/map_on_3.png" width="586" height="292" style="opacity: 1; display: none;">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/map_on_4.png" width="586" height="292" style="display:none;">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/map_on_5.png" width="586" height="292" style="display:none;">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/map_on_6.png" width="586" height="292" style="display:none;">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/map_on_7.png" width="586" height="292" style="display:none;">
	</div><!-- #map_image -->
	<ul id="area_btn_list">
	<li class="area_btn"><a href="[hurl]/local_dentist_top/local_dentist/local_dentist_a/" style="color: red;">安武・荒木・大善寺</a></li>
	<li class="area_btn"><a href="local_dentist_c.php" style="color: rgb(25, 41, 106);">御井町・国分町・野中町</a></li>
	<li class="area_btn"><a href="local_dentist_b2.php" style="color: rgb(25, 41, 106);">六ツ門・津福・長門石</a></li>
	<li class="area_btn"><a href="local_dentist_e.php" style="color: rgb(25, 41, 106);">宮の陣・小森野・北野</a></li>
	<li class="area_btn"><a href="local_dentist_b1.php" style="color: rgb(25, 41, 106);">櫛原町・城南町・日吉町</a></li>
	<li class="area_btn"><a href="local_dentist_d.php" style="color: rgb(25, 41, 106);">山川・善導寺・大橋町</a></li>
	<li class="area_btn"><a href="local_dentist_f.php" style="color: rgb(25, 41, 106);">西町・諏訪野町・南町</a></li>

	</ul><!-- #area_btn_list -->
	</div>
</div>


</div>

<?php get_sidebar( $name ); ?>

 </div>
</article>

		<!-- #content -->
	</div><!-- #primary -->
</div>
</div>

</div>

<?php do_action( 'spacious_after_body_content' ); ?>



<?php get_footer(); ?>

