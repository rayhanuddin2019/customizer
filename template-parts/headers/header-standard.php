
<!-- header nav start-->
<header class="header-standard">
	<div class="container">
		<div class="row">
				<div class="col-lg-3">
					<a class="navbar-brand logo" href="<?php echo home_url('/'); ?>">
               <?php
                  $dark_logo = get_theme_mod( 'ts_blog_site_dark_logo');
                             
                  if ( $dark_logo ) {
                        echo '<img src="'. esc_url( $dark_logo ) .'">';
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
