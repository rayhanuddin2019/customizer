<?php

require get_template_directory() . '/inc/customizer-repeater/functions.php';

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