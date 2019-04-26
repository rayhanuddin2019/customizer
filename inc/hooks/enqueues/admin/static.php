<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue static files: javascript and css for backend
 */

   

   /**
    * Enqueue scripts and styles.
    */
   function ts_admin_scripts() {
    
    wp_enqueue_script('ts-admin', TS_JS . '/ts-admin.js', array('jquery'), TS_VERSION, true);
    
   }
   add_action( 'admin_enqueue_scripts', 'ts_admin_scripts' );




