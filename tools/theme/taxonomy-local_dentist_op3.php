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

	<section class="page_fv">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/mainimage.png" alt="地域の歯医者さん">
	</section>
<div id="main_contents_second"><div class="subtitle_top"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/local_dentist/bar_title_04.png" alt="歯っぴい検診受付歯科医院"></div>


<?php if(is_tax('local_dentist_op3','yasutake')): ?>
<!--安武・荒木・大善寺-->
	<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;安武・荒木・大善寺</p>
	<?php if(have_posts()): ?>
	<?php while(have_posts()):the_post(); ?>
	<?php if(get_field('clinic_name')): ?>
		   <div class="comm_frame clearfix">
			<div class="comm_frame_title_wrap">
			<div class="comm_frame_title">
			<?php the_field('clinic_name'); ?>
			</div>
			</div>
				<?php if(get_field('clinic_address')): ?><div class="clinic-contents">
				<span class="clinic-name">住所</span>		
				<?php the_field('clinic_address'); ?>
				</div><?php endif; ?>
				<?php if(get_field('clinic_tel')): ?><div class="clinic-contents">
				<span class="clinic-name">TEL</span>
				<?php the_field('clinic_tel'); ?></div><?php endif; ?>

			<div class="clinic-contents">
			<span class="clinic-name">備考</span>
			<?php
			$fields = get_field_objects($post_id);
			$dir_array = $fields["clinic_remarks"]["choices"];
			$check = get_field('clinic_remarks');
			if($check): ?>
			<?php foreach($check as $value): ?>
			        <span class="cat <?php echo $value; ?>"><?php echo $dir_array[$value]; ?></span>
			<?php endforeach; endif ?>
			</div>

			<?php if(get_field('clinic_address')): ?>
			<a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" target="_blank" class="comm_detail_btn">アクセス</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php endwhile; else: ?>
	<!--安武・荒木・大善寺-->
	 <p>現在医院を登録中です</p>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

<?php elseif(is_tax('local_dentist_op3','mutumon')): ?>

<!--六ッ門・津福・長門石-->
	<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;六ッ門・津福・長門石</p>
	<?php if(have_posts()): ?>
	<?php while(have_posts()):the_post(); ?>
	<?php if(get_field('clinic_name')): ?>
		   <div class="comm_frame clearfix">
			<div class="comm_frame_title_wrap">
			<div class="comm_frame_title">
			<?php the_field('clinic_name'); ?>
			</div>
			</div>
				<?php if(get_field('clinic_address')): ?><div class="clinic-contents">
				<span class="clinic-name">住所</span>		
				<?php the_field('clinic_address'); ?>
				</div><?php endif; ?>
				<?php if(get_field('clinic_tel')): ?><div class="clinic-contents">
				<span class="clinic-name">TEL</span>
				<?php the_field('clinic_tel'); ?></div><?php endif; ?>

			<div class="clinic-contents">
			<span class="clinic-name">備考</span>
			<?php
			$fields = get_field_objects($post_id);
			$dir_array = $fields["clinic_remarks"]["choices"];
			$check = get_field('clinic_remarks');
			if($check): ?>
			<?php foreach($check as $value): ?>
			        <span class="cat <?php echo $value; ?>"><?php echo $dir_array[$value]; ?></span>
			<?php endforeach; endif ?>
			</div>

			<?php if(get_field('clinic_address')): ?>
			<a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" target="_blank" class="comm_detail_btn">アクセス</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php endwhile; else: ?>
	<!--六ッ門・津福・長門石-->
	 <p>現在医院を登録中です</p>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

<?php elseif(is_tax('local_dentist_op3','kushihara')): ?>
<!--櫛原町・城南町・日吉町-->
<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;櫛原町・城南町・日吉町</p>
	<?php if(have_posts()): ?>
	<?php while(have_posts()):the_post(); ?>
	<?php if(get_field('clinic_name')): ?>
		   <div class="comm_frame clearfix">
			<div class="comm_frame_title_wrap">
			<div class="comm_frame_title">
			<?php the_field('clinic_name'); ?>
			</div>
			</div>
				<?php if(get_field('clinic_address')): ?><div class="clinic-contents">
				<span class="clinic-name">住所</span>		
				<?php the_field('clinic_address'); ?>
				</div><?php endif; ?>
				<?php if(get_field('clinic_tel')): ?><div class="clinic-contents">
				<span class="clinic-name">TEL</span>
				<?php the_field('clinic_tel'); ?></div><?php endif; ?>

			<div class="clinic-contents">
			<span class="clinic-name">備考</span>
			<?php
			$fields = get_field_objects($post_id);
			$dir_array = $fields["clinic_remarks"]["choices"];
			$check = get_field('clinic_remarks');
			if($check): ?>
			<?php foreach($check as $value): ?>
			        <span class="cat <?php echo $value; ?>"><?php echo $dir_array[$value]; ?></span>
			<?php endforeach; endif ?>
			</div>

			<?php if(get_field('clinic_address')): ?>
			<a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" target="_blank" class="comm_detail_btn">アクセス</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php endwhile; else: ?>
	<!--櫛原町・城南町・日吉町-->
	 <p>現在医院を登録中です</p>
	<?php endif; ?>
	<?php wp_reset_query(); ?>


<?php elseif(is_tax('local_dentist_op3','nishimachi')): ?>
<!--西町・諏訪野町・南町-->
<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;西町・諏訪野町・南町</p>
	<?php if(have_posts()): ?>
	<?php while(have_posts()):the_post(); ?>
	<?php if(get_field('clinic_name')): ?>
		   <div class="comm_frame clearfix">
			<div class="comm_frame_title_wrap">
			<div class="comm_frame_title">
			<?php the_field('clinic_name'); ?>
			</div>
			</div>
				<?php if(get_field('clinic_address')): ?><div class="clinic-contents">
				<span class="clinic-name">住所</span>		
				<?php the_field('clinic_address'); ?>
				</div><?php endif; ?>
				<?php if(get_field('clinic_tel')): ?><div class="clinic-contents">
				<span class="clinic-name">TEL</span>
				<?php the_field('clinic_tel'); ?></div><?php endif; ?>

			<div class="clinic-contents">
			<span class="clinic-name">備考</span>
			<?php
			$fields = get_field_objects($post_id);
			$dir_array = $fields["clinic_remarks"]["choices"];
			$check = get_field('clinic_remarks');
			if($check): ?>
			<?php foreach($check as $value): ?>
			        <span class="cat <?php echo $value; ?>"><?php echo $dir_array[$value]; ?></span>
			<?php endforeach; endif ?>
			</div>

			<?php if(get_field('clinic_address')): ?>
			<a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" target="_blank" class="comm_detail_btn">アクセス</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php endwhile; else: ?>
	<!--西町・諏訪野町・南町-->
	 <p>現在医院を登録中です</p>
	<?php endif; ?>
	<?php wp_reset_query(); ?>


<?php elseif(is_tax('local_dentist_op3','miimachi')): ?>
<!--御井町・国分町・野中町-->
	<?php if(have_posts()): ?>
	<?php while(have_posts()):the_post(); ?>
	<?php if(get_field('clinic_name')): ?>
		   <div class="comm_frame clearfix">
			<div class="comm_frame_title_wrap">
			<div class="comm_frame_title">
			<?php the_field('clinic_name'); ?>
			</div>
			</div>
				<?php if(get_field('clinic_address')): ?><div class="clinic-contents">
				<span class="clinic-name">住所</span>		
				<?php the_field('clinic_address'); ?>
				</div><?php endif; ?>
				<?php if(get_field('clinic_tel')): ?><div class="clinic-contents">
				<span class="clinic-name">TEL</span>
				<?php the_field('clinic_tel'); ?></div><?php endif; ?>

			<div class="clinic-contents">
			<span class="clinic-name">備考</span>
			<?php
			$fields = get_field_objects($post_id);
			$dir_array = $fields["clinic_remarks"]["choices"];
			$check = get_field('clinic_remarks');
			if($check): ?>
			<?php foreach($check as $value): ?>
			        <span class="cat <?php echo $value; ?>"><?php echo $dir_array[$value]; ?></span>
			<?php endforeach; endif ?>
			</div>

			<?php if(get_field('clinic_address')): ?>
			<a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" target="_blank" class="comm_detail_btn">アクセス</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php endwhile; else: ?>
	<!--御井町・国分町・野中町-->
	 <p>現在医院を登録中です</p>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

<?php elseif(is_tax('local_dentist_op3','miyanojin')): ?>
<!--宮の陣・小森野・北野-->
	<?php if(have_posts()): ?>
	<?php while(have_posts()):the_post(); ?>
	<?php if(get_field('clinic_name')): ?>
		   <div class="comm_frame clearfix">
			<div class="comm_frame_title_wrap">
			<div class="comm_frame_title">
			<?php the_field('clinic_name'); ?>
			</div>
			</div>
				<?php if(get_field('clinic_address')): ?><div class="clinic-contents">
				<span class="clinic-name">住所</span>		
				<?php the_field('clinic_address'); ?>
				</div><?php endif; ?>
				<?php if(get_field('clinic_tel')): ?><div class="clinic-contents">
				<span class="clinic-name">TEL</span>
				<?php the_field('clinic_tel'); ?></div><?php endif; ?>

			<div class="clinic-contents">
			<span class="clinic-name">備考</span>
			<?php
			$fields = get_field_objects($post_id);
			$dir_array = $fields["clinic_remarks"]["choices"];
			$check = get_field('clinic_remarks');
			if($check): ?>
			<?php foreach($check as $value): ?>
			        <span class="cat <?php echo $value; ?>"><?php echo $dir_array[$value]; ?></span>
			<?php endforeach; endif ?>
			</div>

			<?php if(get_field('clinic_address')): ?>
			<a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" target="_blank" class="comm_detail_btn">アクセス</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php endwhile; else: ?>
	<!--宮の陣・小森野・北野-->
	 <p>現在医院を登録中です</p>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

<?php elseif(is_tax('local_dentist_op3','yamakawa')): ?>
<!--山川・善導寺・大橋町-->
<p class="local_dentist_clinic_area">地域&nbsp;:&nbsp;山川・善導寺・大橋町</p>
	<?php if(have_posts()): ?>
	<?php while(have_posts()):the_post(); ?>
	<?php if(get_field('clinic_name')): ?>
		   <div class="comm_frame clearfix">
			<div class="comm_frame_title_wrap">
			<div class="comm_frame_title">
			<?php the_field('clinic_name'); ?>
			</div>
			</div>
				<?php if(get_field('clinic_address')): ?><div class="clinic-contents">
				<span class="clinic-name">住所</span>		
				<?php the_field('clinic_address'); ?>
				</div><?php endif; ?>
				<?php if(get_field('clinic_tel')): ?><div class="clinic-contents">
				<span class="clinic-name">TEL</span>
				<?php the_field('clinic_tel'); ?></div><?php endif; ?>

			<div class="clinic-contents">
			<span class="clinic-name">備考</span>
			<?php
			$fields = get_field_objects($post_id);
			$dir_array = $fields["clinic_remarks"]["choices"];
			$check = get_field('clinic_remarks');
			if($check): ?>
			<?php foreach($check as $value): ?>
			        <span class="cat <?php echo $value; ?>"><?php echo $dir_array[$value]; ?></span>
			<?php endforeach; endif ?>
			</div>

			<?php if(get_field('clinic_address')): ?>
			<a href="https://www.google.com/maps?q=福岡県久留米市<?php the_field('clinic_address'); ?>&z=14" target="_blank" class="comm_detail_btn">アクセス</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php endwhile; else: ?>
	<!--山川・善導寺・大橋町-->
	 <p>現在医院を登録中です</p>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

<?php else: ?>
<?php endif; ?>


		</div>

<?php get_sidebar('custom'); ?>

 </div>
</article>

		<!-- #content -->
	</div><!-- #primary -->
</div>
</div>

</div>

<?php do_action( 'spacious_after_body_content' ); ?>



<?php get_footer(); ?>

