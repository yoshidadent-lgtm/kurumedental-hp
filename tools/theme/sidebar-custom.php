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

		<div id="second_contents_right">
		<div id="side_contents">
		<div id="side_menu_1"><a href="<?php echo esc_url( home_url( '/event/' ) ); ?>"></a></div>
		<div id="side_menu_2"><a href="https://kurume-dental.or.jp/kdhs/" target="_blank"></a></div>
		<div id="side_menu_3"><a href="<?php echo esc_url( home_url( '/assistant_course/' ) ); ?>"></a></div>
		<div id="side_menu_4"><a href="http://www.8020zaidan.or.jp/index.html" target="_blank"></a></div>
		<div id="side_menu_5"><a href="https://kurume-oral.com/" target="_blank"></a></div>
        </div>		
	</div>


	<?php do_action( 'spacious_after_sidebar' ); ?>
</div>
