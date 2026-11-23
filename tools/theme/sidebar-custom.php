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
		<?php side_cards(); ?>		
	</div>


	<?php do_action( 'spacious_after_sidebar' ); ?>
</div>
