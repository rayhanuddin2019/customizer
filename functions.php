<?php
/**
 * ts functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ts
 */


 // shorthand contants
// ------------------------------------------------------------------------
define('TS_THEME', 'Ts Event WordPress Theme');
define('TS_VERSION', time());
define('TS_MINWP_VERSION', '4.3');


// shorthand contants for theme assets url
// ------------------------------------------------------------------------
define('TS_THEME_URI', get_template_directory_uri());
define('TS_IMG', TS_THEME_URI . '/assets/images');
define('TS_CSS', TS_THEME_URI . '/assets/css');
define('TS_JS', TS_THEME_URI . '/assets/js');



// shorthand contants for theme assets directory path
// ----------------------------------------------------------------------------------------
define('TS_THEME_DIR', get_template_directory());
define('TS_IMG_DIR', TS_THEME_DIR . '/assets/images');
define('TS_CSS_DIR', TS_THEME_DIR . '/assets/css');
define('TS_JS_DIR', TS_THEME_DIR . '/assets/js');

define('TS_INC', TS_THEME_DIR . '/inc');
/*
define('TS_CORE', TS_THEME_DIR . '/core');
define('TS_COMPONENTS', TS_THEME_DIR . '/components');
define('TS_EDITOR', TS_COMPONENTS . '/editor');
define('TS_EDITOR_ELEMENTOR', TS_EDITOR . '/elementor');
define('TS_INSTALLATION', TS_CORE . '/installation-fragments');
define('TS_REMOTE_CONTENT', esc_url('http://demo.themewinter.com/demo-content/ts'));
*/

if ( ! function_exists( 'ts_setup' ) ) :
	
	function ts_setup() {
	
		load_theme_textdomain( 'ts', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

      add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'ts' ),
		) );
	
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ts_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );
    	add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
      ) );
      
     

	}
endif;
add_action( 'after_setup_theme', 'ts_setup' );


function ts_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ts_content_width', 640 );
}
add_action( 'after_setup_theme', 'ts_content_width', 0 );


function ts_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ts' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ts' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ts_widgets_init' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer_rnd.php';


/**
 * assets enqueues.
 */
require get_template_directory() . '/inc/hooks/enqueues/admin/static.php';
require get_template_directory() . '/inc/hooks/enqueues/frontend/static.php';


/**
 * helpers.
 */
require get_template_directory() . '/inc/hooks//blog.php';
require get_template_directory() . '/inc/hooks//menus.php';
//test
require get_template_directory() . '/inc/test.php';




/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}




