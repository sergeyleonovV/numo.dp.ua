<?php
/**
 * The Footer Sidebar
 *
 * @package First
 *
 */
if (   ! is_active_sidebar( 'footer-1' )
	&& ! is_active_sidebar( 'footer-2' )
	&& ! is_active_sidebar( 'footer-3' )
)
	return;
?>

<div id="supplementary" class="footer-area" role="complementary">
	<div class="footer-widget">
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<div class="footer-widget-1 widget-area">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
		<div class="footer-widget-2 widget-area">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
		<div class="footer-widget-3 widget-area">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>
		<?php endif; ?>
	</div><!-- #footer-widget-wrap -->
</div><!-- #supplementary -->

