<?php

get_header();

?>

<section id="main-content" class="blog main-container" role="main">
	<div class="container">
		<div class="row">
        <div class="col-lg-6 mx-auto">
                  <div class="error-page text-center">
                    <?php	get_search_form(); ?>
                     <div class="error-code">
                        <h2><strong><?php esc_html_e('404', 'ts'); ?></strong></h2>
                     </div>
                     <div class="error-message">
                        <h3><?php esc_html_e('Oops... Page Not Found!', 'ts'); ?></h3>
                     </div>
                     <div class="error-body">
                        <?php esc_html_e('Try using the button below to go to main page of the site', 'ts'); ?> <br>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e('Back to Home Page', 'ts'); ?></a>
                     </div>
                  </div>
               </div>
         </div><!-- #col -->
  	</div><!-- #container -->
</section>
>

<?php
get_footer();
