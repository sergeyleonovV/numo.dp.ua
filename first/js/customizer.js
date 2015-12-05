/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site Title & Tagline
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Fonts
	wp.customize( 'first_body_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css( 'font-size', newval + 'px' );
		} );
	} );

	// Colors
	wp.customize( 'first_menu_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site-bar, .main-navigation ul ul' ).css( 'background-color', newval );
		} );
	} );
	wp.customize( 'first_footer_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-area' ).css( 'background-color', newval );
		} );
	} );
	wp.customize( 'first_link_color', function( value ) {
		value.bind( function( newval ) {
			$( '.entry-content a, .entry-summary a, .comment-content a, .navigation a, .comment-navigation a, .current-menu-item > a' ).css( 'color', newval );
		} );
	} );

	// Layout
	wp.customize( 'first_layout', function( value ) {
		value.bind( function( newval ) {
			if ( "wide" !== newval ) {
				$( 'body' ).addClass( 'boxed' );
			} else {
				$( 'body' ).removeClass( 'boxed' );
			}
		} );
	} );
	wp.customize( 'first_header_layout', function( value ) {
		value.bind( function( newval ) {
			if ( "center" !== newval ) {
				$( 'body' ).addClass( 'header-side' );
			} else {
				$( 'body' ).removeClass( 'header-side' );
			}
		} );
	} );
	wp.customize( 'first_footer_layout', function( value ) {
		value.bind( function( newval ) {
			if ( "center" !== newval ) {
				$( 'body' ).addClass( 'footer-side' );
			} else {
				$( 'body' ).removeClass( 'footer-side' );
			}
		} );
	} );

	// Title
	wp.customize( 'first_title_font_size', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title' ).css( 'font-size', newval + 'px' );
		} );
	} );
	wp.customize( 'first_title_letter_spacing', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title' ).css( 'letter-spacing', newval + 'px' );
		} );
	} );
	wp.customize( 'first_title_margin_top', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title' ).css( 'margin-top', newval + 'px' );
		} );
	} );
	wp.customize( 'first_title_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );
	wp.customize( 'first_title_uppercase', function( value ) {
		value.bind( function( newval ) {
			if ( newval ) {
				$( '.site-title' ).css( 'text-transform', 'uppercase' );
			} else {
				$( '.site-title' ).css( 'text-transform', 'none' );
			}
		} );
	} );
	wp.customize( 'first_title_font_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).css( 'color', newval );
		} );
	} );

	// Logo
	wp.customize( 'first_logo_margin_top', function( value ) {
		value.bind( function( newval ) {
			$( '.site-logo' ).css( 'margin-top', newval + 'px' );
		} );
	} );
	wp.customize( 'first_logo_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$( '.site-logo' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );

	// Custom CSS
	wp.customize( 'first_custom_css', function( value ) {
		value.bind( function( to ) {
			$( '#first-custom-css' ).text( to );
		} );
	} );
} )( jQuery );
