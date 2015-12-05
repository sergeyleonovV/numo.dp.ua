<?php
/**
 * @package First
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php first_header_meta(); ?>
		<?php if ( has_post_thumbnail() ): ?>
		<div class="post-thumbnail"><?php the_post_thumbnail(); ?></div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(	'before' => '<div class="page-links">' . __( 'Pages:', 'first' ), 'after'  => '</div>', ) ); ?>
	</div><!-- .entry-content -->

	<?php first_footer_meta(); ?>
</article><!-- #post-## -->

