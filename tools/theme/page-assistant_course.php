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
<div class="subtitle_top"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/assistant_course/title_01.png" alt="歯科助手講習会のご案内"></div>

<?php if(have_rows('assistantcourse_guidance')): ?>
<?php while(have_rows('assistantcourse_guidance')): the_row(); ?>
<table id="assistant_course_table">
<tbody>
	<tr>
	<th>講習会名</th>
	<td><?php the_sub_field('assistantcourse_name'); ?></td>
	</tr>
	<tr>
	<th>講習会内容</th>
	<td><?php the_sub_field('assistantcourse_text'); ?></td>
	</tr>
</tbody>
</table>
<?php endwhile; ?>
<?php else: ?>

<?php endif; ?>


<div class="subtitle_top"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/assistant_course/title_02.png" alt="歯科助手講習会の要項"></div>

<table id="assistant_course_table">
<tbody>
	<tr>
	<th>講習期間</th>
	<td><?php if(get_field('assistantcourse_period')): ?><?php the_field('assistantcourse_period'); ?>～<?php endif; ?><?php the_field('assistantcourse_period_end'); ?></td>
	</tr>
	<tr>
	<th>講習日時</th>
	<td>毎週土曜日午後2時～4時</td>
	</tr>
	<tr>
	<th>講習会場</th>
	<td><?php the_field('assistantcourse_Venue'); ?></td>
	</tr>
	<tr>
	<th>資格取得</th>
	<td><?php the_field('assistantcourse_qualification'); ?></td>
	</tr>
	<tr>
	<th>定員</th>
	<td><?php if(get_field('assistantcourse_Capacity')): ?><?php the_field('assistantcourse_Capacity'); ?><?php endif; ?></td>
	</tr>
	<tr>
	<th>受講資格</th>
	<td><?php the_field('assistantcourse_attend'); ?></td>
	</tr>
	<tr>
	<th>資料</th>
	<td>
	<ul><?php if(get_field('assistantcourse_file')): ?><li><a href="<?php the_field('assistantcourse_file'); ?>" target="_blank" style="text-decoration:underline;">募集要項</a></li><?php endif; ?>
<?php if(get_field('assistantcourse_file_2')): ?><li><a href="<?php the_field('assistantcourse_file_2'); ?>" target="_blank" style="text-decoration:underline;">受講願書</a></li><?php endif; ?>
		<?php if(get_field('assistantcourse_file_3')): ?><li><a href="<?php the_field('assistantcourse_file_3'); ?>" target="_blank" style="text-decoration:underline;">ポスター</a></li><?php endif; ?>
	</ul>
	</td>
	</tr>
	<tr>
	<th>お問い合わせ</th>
	<td><?php the_field('assistantcourse_info'); ?></td>
	</tr>
	<tr>
	<th>講習会場<br>地図</th>
	<td><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=q&amp;source=s_q&amp;hl=ja&amp;geocode=&amp;q=%E4%B9%85%E7%95%99%E7%B1%B3%E6%AD%AF%E7%A7%91%E5%8C%BB%E5%B8%AB%E4%BC%9A&amp;aq=&amp;sll=34.728949,138.455511&amp;sspn=59.267706,135.263672&amp;brcurrent=3,0x3541a684076bd893:0xbc5552c09d13a085,0&amp;ie=UTF8&amp;hq=%E4%B9%85%E7%95%99%E7%B1%B3%E6%AD%AF%E7%A7%91%E5%8C%BB%E5%B8%AB%E4%BC%9A&amp;hnear=&amp;t=m&amp;ll=33.321205,130.516033&amp;spn=0.057376,0.113125&amp;z=13&amp;output=embed&amp;iwloc=B"></iframe>
	</td>
	</tr>
</tbody>
</table>



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

