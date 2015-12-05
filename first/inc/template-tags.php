<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package First
 */

if ( ! function_exists( 'first_logo' ) ) :
/**
 * Display logo image.
 */
function first_logo() {
	$logo_alt = ( get_theme_mod( 'first_replace_blogname' ) ) ? get_bloginfo( 'name' ) : '';
	$logo_src = esc_url( get_theme_mod( 'first_logo' ) );
	list( $logo_width ) = getimagesize( $logo_src );
	if ( get_theme_mod( 'first_retina_logo' ) ) {
		$logo_width = round( $logo_width / 2 );
	}
	?>
	<img alt="<?php echo $logo_alt; ?>" src="<?php echo $logo_src; ?>" width="<?php echo $logo_width; ?>" />
	<?php
}
endif;

if ( ! function_exists( 'first_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function first_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'first' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'first' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'first' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'first_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function first_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'first' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous"><div class="post-nav-title">' . __( 'Previous post', 'first' ) . '</div>%link</div>', _x( '%title', 'Previous post link', 'first' ) );
				next_post_link(     '<div class="nav-next"><div class="post-nav-title">' . __( 'Next post', 'first' ) . '</div>%link</div>', _x( '%title', 'Next post link', 'first' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'first_header_meta' ) ) :
/**
 * Display post header meta.
 */
function first_header_meta() {
	// Hide for pages on Search.
	if ( 'post' != get_post_type() ) {
		return;
	}
	?>
	<div class="entry-meta">
		<span class="posted-on">
			<?php printf( '<a href="%1$s" rel="bookmark"><time class="entry-date published" datetime="%2$s">%3$s</time></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			); ?>
		</span>
		<?php if ( ! get_theme_mod( 'first_hide_author' ) ) : ?>
		<span class="byline"><span class="meta-sep"> / </span>
			<span class="author vcard">
				<?php printf( '<a class="url fn n" href="%1$s">%2$s</a>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				); ?>
			</span>
		</span>
		<?php endif; ?>
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><span class="meta-sep"> / </span> <?php comments_popup_link( __( 'Leave a comment', 'first' ), __( '1 Comment', 'first' ), __( '% Comments', 'first' ) ); ?></span>
		<?php endif; ?>
		<?php if ( is_sticky() ): ?>
		<span class="featured"><?php _e( 'Featured', 'first' ); ?></span>
		<?php endif; ?>
	</div><!-- .entry-meta -->
	<?php
}
endif;

if ( ! function_exists( 'first_footer_meta' ) ) :
/**
 * Display post footer meta when applicable.
 */
function first_footer_meta() {
	// Don't print empty markup if there's no Categories or Tags.
	$tags_list = get_the_tag_list( '', __( ', ', 'first' ) );
	if ( get_theme_mod( 'first_hide_category' ) && '' == $tags_list ) {
		return;
	}
	?>
	<footer class="entry-meta entry-footer">
		<?php if ( ! get_theme_mod( 'first_hide_category' ) ) : ?>
		<span class="cat-links">
			<?php the_category( __( ', ', 'first' ) ); ?>
		</span>
		<?php endif; ?>
		<?php if ( '' != $tags_list ) : ?>
		<span class="tags-links">
			<?php echo $tags_list; ?>
		</span>
		<?php endif; // End if $tags_list ?>
	</footer><!-- .entry-meta -->
	<?php
}
endif;