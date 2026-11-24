<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<?php $art_type = isset($post->type) ? $post->type : 'post'; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-kind="<?php echo htmlspecialchars($art_type); ?>">
	<?php do_action( 'spacious_before_post_content' ); ?>
	<div class="entry-content clearfix art-wrap art-<?php echo htmlspecialchars($art_type); ?>">
		<div class="art-head">
			<span class="day_date art-date"><?php the_time('Y年m月d日');?></span>
			<h3 class="art-title"><?php the_title(); ?></h3>
		</div>
		<div class="art-body">

		<?php
		if ( ( spacious_options( 'spacious_featured_image_single_post_page', 0 ) == 1 ) && has_post_thumbnail() ) {
			the_post_thumbnail( 'featured-blog-large' );
		}

		the_content();

		$spacious_tag_list = get_the_tag_list( '', '&nbsp;&nbsp;&nbsp;&nbsp;', '' );
		if ( ! empty( $spacious_tag_list ) ) {
			?>
			<div class="tags">
				<?php
				_e( 'Tagged on: ', 'spacious' );
				echo $spacious_tag_list;
				?>
			</div>
			<?php
		}

		wp_link_pages( array(
			'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . __( 'Pages:', 'spacious' ),
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>'
		) );
		?>
		</div>
		<?php
		$back = array('event' => array('event/', 'イベント一覧へ戻る'), 'finance' => array('introduction/introduction_5/', '業務・財務に関する資料へ戻る'));
		$b = isset($back[$art_type]) ? $back[$art_type] : array('', 'トップページへ戻る');
		?>
		<p class="art-back"><a class="art-btn" href="<?php echo esc_url( home_url( '/' . $b[0] ) ); ?>"><?php echo $b[1]; ?></a></p>
	</div>

	<?php spacious_entry_meta(); ?>

	<?php
	do_action( 'spacious_after_post_content' );
	?>
</article>