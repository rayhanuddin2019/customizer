<?php

require get_template_directory() . '/inc/customizer-repeater/functions.php';

if ( ! function_exists( 'pt_footer_widgets_params' ) ) {
  
   function pt_footer_widgets_params( $params ) {
     
       static $counter = 0;
       static $first_row = true;
       $footer_widgets_layout_array = pt_footer_widgets_layout_array();

       if ( $params[0]['id'] === 'footer-widgets' ) {
           // 'before_widget' contains %d, see inc/theme-sidebars.php
           $params[0]['before_widget'] = sprintf( $params[0]['before_widget'], $footer_widgets_layout_array[$counter] );

           // first widget in the any non-first row
           if ( false === $first_row && 0 === $counter ) {
               $params[0]['before_widget'] = '</div><div class="row">' . $params[0]['before_widget'];
           }

           $counter++;
       }

       end( $footer_widgets_layout_array );
       if ( $counter > key( $footer_widgets_layout_array ) ) {
           $counter = 0;
           $first_row = false;
       }

       return $params;
   }
   add_filter( 'dynamic_sidebar_params', 'pt_footer_widgets_params', 9, 1 );
}


// Footer
$footer_widgets_num = count( pt_footer_widgets_layout_array() );

// only register if not 0
if ( $footer_widgets_num > 0 ) {
    register_sidebar(
        array(
            'name'          => _x( 'Footer', 'backend', 'mentalpress_wp' ),
            'id'            => 'footer-widgets',
            'description'   => sprintf( _x( 'Footer area works best with %d widgets. This number can be changed in the Appearance → Customize → Theme Options → Footer.', 'backend', 'mentalpress_wp' ), $footer_widgets_num ),
            'before_widget' => '<div class="col-xs-12  col-md-%%d"><div class="widget  %2$s">', // %%d is replaced dynamically in filter 'dynamic_sidebar_params'
            'after_widget'  => '</div></div>',
            'before_title'  => '<h6 class="footer-top__headings">',
            'after_title'   => '</h6>'
        )
    );
}

add_action( 'wp_footer', 'rnd_customize_output' );

function rnd_customize_output() {
	$js = get_option( 'code_editor_js', '' );
	if ( '' === $js ) {
		return;
	}
	?>
	<script type="text/javascript">
        ( function ( $ ) {
			"use strict";
			<?php echo $js . "\n"; ?>
		} )( jQuery );
	</script>
	<?php
}

add_action( 'wp_head', 'rnd_customize_output_css' );

function rnd_customize_output_css() {
	$css = get_option( 'code_editor_css', '' );
	if ( '' === $css ) {
		return;
	}
	?>
	<style>
    		
	  <?php echo $css . "\n"; ?>
	
	</style>
	<?php
}