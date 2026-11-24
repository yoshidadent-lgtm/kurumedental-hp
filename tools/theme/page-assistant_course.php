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
	<h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/assistant_course/main_image.png" alt="歯科助手講習会のご案内" class="pc_image">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/assistant_course/mainimage_sp.png" alt="歯科助手講習会のご案内" class="sp_image">
	</h1>
	</section>

		<div class="clearfix">
		<div id="main_contents_second">

<div id="itroduction_left_contents">
<h2 class="ac-h">歯科助手講習会のご案内<small>Assistant Course Guidance</small></h2>

<?php if(have_rows('assistantcourse_guidance')): ?>
<?php while(have_rows('assistantcourse_guidance')): the_row(); ?>
<section class="ac-card">
<dl class="ac-rows">
<div class="ac-row"><dt>講習会名</dt><dd><?php the_sub_field('assistantcourse_name'); ?></dd></div>
<div class="ac-row"><dt>講習会内容</dt><dd><?php the_sub_field('assistantcourse_text'); ?></dd></div>
</dl>
</section>
<?php endwhile; ?>
<?php endif; ?>

<h2 class="ac-h">歯科助手講習会の要項<small>Assistant Course Points</small></h2>

<section class="ac-card">
<dl class="ac-rows">
<div class="ac-row"><dt>講習期間</dt><dd><?php if(get_field('assistantcourse_period')): ?><?php the_field('assistantcourse_period'); ?>～<?php endif; ?><?php the_field('assistantcourse_period_end'); ?></dd></div>
<div class="ac-row"><dt>講習日時</dt><dd>毎週土曜日午後2時～4時</dd></div>
<div class="ac-row"><dt>講習会場</dt><dd><?php the_field('assistantcourse_Venue'); ?></dd></div>
<div class="ac-row"><dt>資格取得</dt><dd><?php the_field('assistantcourse_qualification'); ?></dd></div>
<div class="ac-row"><dt>定員</dt><dd><?php if(get_field('assistantcourse_Capacity')): ?><?php the_field('assistantcourse_Capacity'); ?><?php endif; ?></dd></div>
<div class="ac-row"><dt>受講資格</dt><dd><?php the_field('assistantcourse_attend'); ?></dd></div>
<div class="ac-row"><dt>資料</dt><dd class="ac-files">
<?php if(get_field('assistantcourse_file')): ?><a class="ac-btn" href="<?php the_field('assistantcourse_file'); ?>" target="_blank" rel="noopener noreferrer">募集要項</a><?php endif; ?>
<?php if(get_field('assistantcourse_file_2')): ?><a class="ac-btn" href="<?php the_field('assistantcourse_file_2'); ?>" target="_blank" rel="noopener noreferrer">受講願書</a><?php endif; ?>
<?php if(get_field('assistantcourse_file_3')): ?><a class="ac-btn" href="<?php the_field('assistantcourse_file_3'); ?>" target="_blank" rel="noopener noreferrer">ポスター</a><?php endif; ?>
</dd></div>
<div class="ac-row"><dt>お問い合わせ</dt><dd><?php echo ck_tel(ck_val('assistantcourse_info')); ?></dd></div>
<div class="ac-row ac-map-row"><dt>講習会場の地図</dt><dd class="ac-map"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=q&amp;source=s_q&amp;hl=ja&amp;geocode=&amp;q=%E4%B9%85%E7%95%99%E7%B1%B3%E6%AD%AF%E7%A7%91%E5%8C%BB%E5%B8%AB%E4%BC%9A&amp;aq=&amp;sll=34.728949,138.455511&amp;sspn=59.267706,135.263672&amp;brcurrent=3,0x3541a684076bd893:0xbc5552c09d13a085,0&amp;ie=UTF8&amp;hq=%E4%B9%85%E7%95%99%E7%B1%B3%E6%AD%AF%E7%A7%91%E5%8C%BB%E5%B8%AB%E4%BC%9A&amp;hnear=&amp;t=m&amp;ll=33.321205,130.516033&amp;spn=0.057376,0.113125&amp;z=13&amp;output=embed&amp;iwloc=B"></iframe></dd></div>
</dl>
</section>

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

