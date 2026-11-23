<?php ?>



<?php get_header(); ?>

  <div id="main" class="clearfix">
     <div class="inner-wrap">
	<?php do_action( 'spacious_before_body_content' ); ?>

		<div id="content" class="clearfix">

<article>
 <div class="l-inner checkup">

	<section class="page_fv">
	 <h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/main_image.png" alt="健診事業のご案内" class="pc_image">
	 <img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/mainimage_sp.png" alt="健診事業のご案内" class="sp_image">
	 </h1>
	</section>

		<div class="clearfix">
		<div id="main_contents_second">

<div id="itroduction_left_contents">
<div class="subtitle_top">
	<div class="comm_frame_title_wrap">
	<div class="comm_frame_title">主な事業</div>
	</div>
</div>
<p class="txtmin">歯科医師会では「健康増進法」のなかで「８０２０運動」「生活習慣病予防」を推進するためにたくさんの事業を実施して、皆様のお口の健康のお手伝いをしています。</p>

<section class="ck-card">
<h3 class="ck-title"><span>1歳児歯科健診<small>（1歳児初めての歯の健康教室）</small></span></h3>
<dl class="ck-rows">
<?php ck_row('実施場所', 'place-01'); ?>
<?php ck_row('開始時間', 'open-01'); ?>
<?php ck_row('実施要領', 'detail-01'); ?>
<?php ck_row('問合せ先', 'contact-01'); ?>
</dl>
<div class="ck-btns">
<a class="ck-btn" href="<?php echo esc_url( home_url( '/business_checkup_1/' ) ); ?>">詳細はこちら</a>
</div>
</section>
<section class="ck-card">
<h3 class="ck-title"><span>1歳半・3歳児歯科健診</span></h3>
<dl class="ck-rows">
<?php ck_row('実施場所', 'place-02'); ?>
<?php ck_row('問合せ先', 'contact-02'); ?>
</dl>
<p class="ck-note">北野町、市役所、南部保健センターで集団検診も行われています</p>
<div class="ck-btns">
<a class="ck-btn" href="<?php echo esc_url( home_url( '/business_checkup_2/' ) ); ?>">北野町の詳細はこちら</a>
<a class="ck-btn" href="<?php echo esc_url( home_url( '/business_checkup_3/' ) ); ?>">南部保健センターの詳細はこちら</a>
<a class="ck-btn" href="<?php echo esc_url( home_url( '/business_checkup_4/' ) ); ?>">久留米市役所の詳細はこちら</a>
</div>
</section>
<section class="ck-card">
<h3 class="ck-title"><span>歯っぴー検診<small>（歯周病検診）</small></span></h3>
<dl class="ck-rows">
<?php ck_row('実施場所', 'place-03'); ?>
<?php ck_row('対象者', 'target-03'); ?>
<?php ck_row('負担金額', 'price-03'); ?>
<?php ck_row('実施要領', 'detail-03'); ?>
<?php ck_row('健診内容', 'kenshin-03'); ?>
<?php ck_row('問合せ先', 'contact-03'); ?>
</dl>
</section>
<section class="ck-card">
<h3 class="ck-title"><span>産業歯科健診</span></h3>
<dl class="ck-rows">
<?php ck_row('', 'detail-04'); ?>
</dl>
</section>
<section class="ck-card">
<h3 class="ck-title"><span>妊婦歯科健診</span></h3>
<dl class="ck-rows">
<?php ck_row('実施場所', 'place-05'); ?>
<?php ck_row('負担金額', 'price-05'); ?>
<?php ck_row('実施要領', 'detail-05'); ?>
<?php ck_row('問合せ先', 'contact-05'); ?>
</dl>
</section>
<section class="ck-card">
<h3 class="ck-title"><span>後期高齢者歯科健診</span></h3>
<dl class="ck-rows">
<?php ck_row('実施場所', 'place-06'); ?>
<?php ck_row('対象者', 'target-06'); ?>
<?php ck_row('実施要領', 'detail-06'); ?>
<?php ck_row('健診内容', 'kenshin-06'); ?>
<?php ck_row('負担金額', 'price-06'); ?>
</dl>
</section>

<div class="subtitle_top">
	<div class="comm_frame_title_wrap">
	<div class="comm_frame_title">その他の事業</div>
	</div>
</div>
<div class="other_checkup_wrap">
<div class="image"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/business_checkup/business_checkup.jpg" alt="その他の事業" /></div>
<div class="text">
<div class="frame">
<ul>
 	<li>休日急患歯科診療(当番医制度)</li>
 	<li>心身障害者（児）歯科健診・診療</li>
 	<li>在宅訪問歯科連携室事業</li>
 	<li>歯科保健教育・相談事業</li>
 	<li>歯の衛生週間事業</li>
 	<li>県民健康づくりセミナー</li>
 	<li>「8020」すこやかライフ歯科保健大会</li>
 	<li>かかりつけ歯科医</li>
</ul>
</div>
</div>
</div>

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

