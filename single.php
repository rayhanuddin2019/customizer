<?php
   get_header();
   get_template_part( 'template-parts/banner/content', 'banner-blog' ); 
   //$column =  is_active_sidebar('sidebar-1')? 'col-lg-8' : 'col-lg-10 mx-auto';
?>
<section id="main-content" class="blog-single main-container" role="main">
	<div class="container">
		<div class="row">
          <div class="col-lg-10 mx-auto">

		<?php
       
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/blog/contents/content', 'single' );
         
         if(get_theme_mod('ts_blog_post_navigation')):  
            ts_post_nav();
         endif;  
     
         if(get_theme_mod('ts_blog_post_comment_open')):  
            if ( comments_open() || get_comments_number() ) :
               comments_template();
            endif;
         endif;   

		endwhile; // End of the loop.
		?>

      </div><!-- #col -->
     
    
     </div><!-- #row -->
	</div><!-- #container -->
</section>
<?php

get_footer();
