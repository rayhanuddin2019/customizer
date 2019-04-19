<?php if (!defined('ABSPATH')) die('Direct access forbidden.');

/**
 * Enqueue scripts and styles.
 */
function ts_frontend_scripts() {
	

   wp_enqueue_script( 'ts-navigation', TS_JS . '/navigation.js', array( 'jquery' ), TS_VERSION, true );
   wp_enqueue_script( 'ts-skip-link-focus-fix', TS_JS . '/skip-link-focus-fix.js', array( ), TS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ); 
   }
   
   // stylesheets
   // ----------------------------------------------------------------------------------------
   
     // 3rd party css
      
      wp_enqueue_style( 'bootstrap', TS_CSS . '/bootstrap.min.css', null, TS_VERSION );
      wp_enqueue_style( 'font-awesome', TS_CSS . '/font-awesome.css', null, TS_VERSION );
      wp_enqueue_style( 'icofont', TS_CSS . '/icofont.css', null, TS_VERSION );
      wp_enqueue_style( 'ts-style', TS_CSS . '/style.css', null, TS_VERSION );
      // theme css
      wp_enqueue_style( 'ts-master', TS_CSS . '/master.css', null, TS_VERSION );
 

   
      // javascripts
   // ----------------------------------------------------------------------------------------
 

      // 3rd party scripts
      wp_enqueue_script( 'bootstrap', TS_JS . '/bootstrap.min.js', array( 'jquery' ), TS_VERSION, true );

      // theme scripts
      wp_enqueue_script( 'ts-script', TS_JS . '/script.js', array( 'jquery' ), TS_VERSION, true );
      
      

}
add_action( 'wp_enqueue_scripts', 'ts_frontend_scripts' );