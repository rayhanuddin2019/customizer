
<!-- header nav start-->
<header id="header" class="header header-transparent">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<a class="navbar-brand logo" href="<?php echo home_url('/'); ?>">
            <?php
                  $custom_logo_id = get_theme_mod( 'custom_logo' );
              
                  $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                
                  if ( has_custom_logo() ) {
                        echo '<img src="'. esc_url( $logo[0] ) .'">';
                  } else {
                        echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
                  }
               ?>
				</a>
			</div><!-- Col end -->
			
			<div class="col-lg-9">
				<?php get_template_part( 'template-parts/navigations/nav', 'primary' ); ?>
			</div>

			
		</div><!-- Row end -->
	</div><!--Container end -->
</header><!-- Header end -->
