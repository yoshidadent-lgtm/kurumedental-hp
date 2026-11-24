


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
					<div class="vd-call">
					  <a class="vd-call-btn" href="tel:08077452697"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.300.2 2.500.6 3.600.1.300 0 .700-.2 1z" fill="currentColor"/></svg><span><small>口腔管理推進室</small><strong>080-7745-2697</strong></span><em>タップで電話</em></a>
					  <p class="vd-call-note">受付：月〜金曜日（日曜・祝日は除く）9:00〜16:00　／　歯科医師会の相談員が対応します。</p>
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
					</div>

					<div class="visiting_box vd-card">
					  <h3 class="vd-h">業務内容</h3>
					  <div class="vd-body"><?php echo vd_field('job'); ?></div>
					</div>

					<div class="visiting_box vd-card">
					  <h3 class="vd-h">対象となる方</h3>
					  <div class="vd-body"><?php echo vd_field('target'); ?></div>
					</div>

					<div class="visiting_box vd-card">
					  <h3 class="vd-h">対象となる地域</h3>
					  <div class="vd-body"><?php echo vd_field('place'); ?></div>
					</div>

					<div class="visiting_box vd-card">
					  <h3 class="vd-h">費　用</h3>
					  <div class="vd-body"><?php echo vd_field('price'); ?></div>
					</div>

					<div class="visiting_box">	
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/visiting_dental/tel_info1.jpg">
					</div>
					<div class="vd-call">
					  <a class="vd-call-btn" href="tel:08077452697"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.300.2 2.500.6 3.600.1.300 0 .700-.2 1z" fill="currentColor"/></svg><span><small>口腔管理推進室</small><strong>080-7745-2697</strong></span><em>タップで電話</em></a>
					  <p class="vd-call-note">受付：月〜金曜日（日曜・祝日は除く）9:00〜16:00　／　歯科医師会の相談員が対応します。</p>
					</div>

 <div class="vd-towns"><?php echo vd_field('free-area'); ?></div>
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

