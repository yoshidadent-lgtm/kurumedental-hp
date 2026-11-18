<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<div>
	<?php do_action( 'spacious_before_sidebar' ); ?>
<?php if(is_page('introduction') || page_is_ancestor_of('introduction')): ?>
		<div id="second_contents_right">

		 		<div id="mem_nav_wrap">
				<ul>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a></li>
				<li><a href="<?php echo esc_url( home_url( '/introduction/introduction/' ) ); ?>">会長挨拶</a></li>
				<li><a href="<?php echo esc_url( home_url( '/introduction/introduction_2/' ) ); ?>">役員紹介</a></li>
				<li><a href="<?php echo esc_url( home_url( '/introduction/introduction_3/' ) ); ?>">案内地図</a></li>
				<li><a href="<?php echo esc_url( home_url( '/introduction/introduction_4/' ) ); ?>">入会案内</a></li>
				<li><a href="<?php echo esc_url( home_url( '/introduction/introduction_5/' ) ); ?>">業務・財務に関する資料</a></li>
				</ul>

		</div>
		</div>



<?php elseif(is_page('visiting_dental') || page_is_ancestor_of('visiting_dental')): ?>
		<div id="second_contents_right">
		<div id="side_contents">
		<div id="side_menu_1"><a href="<?php echo esc_url( home_url( '/event/' ) ); ?>"></a></div>
		<div id="side_menu_2"><a href="https://kurume-dental.or.jp/kdhs/" target="_blank"></a></div>
		<div id="side_menu_3"><a href="<?php echo esc_url( home_url( '/assistant_course/' ) ); ?>"></a></div>
		<div id="side_menu_4"><a href="http://www.8020zaidan.or.jp/index.html" target="_blank"></a></div>
		<div id="side_menu_5"><a href="https://kurume-oral.com/" target="_blank"></a></div>
			</div>		</div>

<?php elseif(is_page('holiday_clinic') || page_is_ancestor_of('holiday_clinic')): ?>
		<div id="second_contents_right">
		<div id="side_contents">
		<div id="side_menu_1"><a href="<?php echo esc_url( home_url( '/event/' ) ); ?>"></a></div>
		<div id="side_menu_2"><a href="https://kurume-dental.or.jp/kdhs/" target="_blank"></a></div>
		<div id="side_menu_3"><a href="<?php echo esc_url( home_url( '/assistant_course/' ) ); ?>"></a></div>
		<div id="side_menu_4"><a href="http://www.8020zaidan.or.jp/index.html" target="_blank"></a></div>
		<div id="side_menu_5"><a href="https://kurume-oral.com/" target="_blank"></a></div>
</div>		</div>

<?php elseif(is_page('business_checkup') || page_is_ancestor_of('business_checkup')): ?>
		<div id="second_contents_right">
		<div id="side_contents">
		<div id="side_menu_1"><a href="<?php echo esc_url( home_url( '/event/' ) ); ?>"></a></div>
		<div id="side_menu_2"><a href="https://kurume-dental.or.jp/kdhs/" target="_blank"></a></div>
		<div id="side_menu_3"><a href="<?php echo esc_url( home_url( '/assistant_course/' ) ); ?>"></a></div>
		<div id="side_menu_4"><a href="http://www.8020zaidan.or.jp/index.html" target="_blank"></a></div>
		<div id="side_menu_5"><a href="https://kurume-oral.com/" target="_blank"></a></div>
</div>		</div>

<?php elseif(is_tax('local_dentist_op1')): ?>
		<div id="second_contents_right">
		<div id="side_contents">
		<div id="side_menu_1"><a href="<?php echo esc_url( home_url( '/event/' ) ); ?>"></a></div>
		<div id="side_menu_2"><a href="https://kurume-dental.or.jp/kdhs/" target="_blank"></a></div>
		<div id="side_menu_3"><a href="<?php echo esc_url( home_url( '/assistant_course/' ) ); ?>"></a></div>
		<div id="side_menu_4"><a href="http://www.8020zaidan.or.jp/index.html" target="_blank"></a></div>
		<div id="side_menu_5"><a href="https://kurume-oral.com/" target="_blank"></a></div>
</div>		</div>

<?php elseif(is_tax('local_dentist')): ?>
		<div id="second_contents_right">
		<div id="side_contents">
		<div id="side_menu_1"><a href="<?php echo esc_url( home_url( '/event/' ) ); ?>"></a></div>
		<div id="side_menu_2"><a href="https://kurume-dental.or.jp/kdhs/" target="_blank"></a></div>
		<div id="side_menu_3"><a href="<?php echo esc_url( home_url( '/assistant_course/' ) ); ?>"></a></div>
		<div id="side_menu_4"><a href="http://www.8020zaidan.or.jp/index.html" target="_blank"></a></div>
		<div id="side_menu_5"><a href="https://kurume-oral.com/" target="_blank"></a></div>
</div>		</div>

<?php elseif(is_page('member') || page_is_ancestor_of('member')): ?>
		<div id="second_contents_right">
		<div id="side_contents_member">
				<div id="side_menu_1"><a href="<?php echo esc_url( home_url( '/members/newsletter/' ) ); ?>"></a></div>
				<div id="side_menu_2"><a href="<?php echo esc_url( home_url( '/members/monthly_report/' ) ); ?>"></a></div>
				<div id="side_menu_3"><a href="<?php echo esc_url( home_url( '/members/member_plan/' ) ); ?>"></a></div>
				<div id="side_menu_4"><a href="<?php echo esc_url( home_url( '/members/council_news/' ) ); ?>"></a></div>
				<div id="side_menu_5"><a href="<?php echo esc_url( home_url( '/members/chairman_notebook/' ) ); ?>"></a></div>
				<div id="side_menu_6"><a href="<?php echo esc_url( home_url( '/members/airchive/' ) ); ?>"></a></div>
				<div id="side_menu_7"><a href="<?php echo esc_url( home_url( '/members/member/' ) ); ?>"></a></div>
				<div id="side_menu_logout"><a href="/member/members/logout"></a></div>

		</div></div>

<?php endif; ?>

	<?php do_action( 'spacious_after_sidebar' ); ?>
</div>
