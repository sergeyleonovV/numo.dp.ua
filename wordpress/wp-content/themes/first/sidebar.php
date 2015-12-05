<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package First
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="sidebar-area" role="complementary">
	<div class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div><!-- #secondary -->
