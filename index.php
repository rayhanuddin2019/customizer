<?php

   get_header();
   get_template_part( 'template-parts/banner/content', 'banner-blog' ); 
   $layout = get_theme_mod('ts_blog_layout','left');
   $column = $layout=="full" || !is_active_sidebar('sidebar-1')? 'col-lg-12' : 'col-lg-8 col-md-12';

?>

<section id="main-content" class="blog main-container" role="main">
	<div class="container">
		<div class="row">
         <?php
            if($layout == "left"):
               get_sidebar();
            endif;
         ?>
         <div class="<?php echo esc_attr($column); ?>">
               <?php
               if ( have_posts() ) :

                  if ( is_home() && ! is_front_page() ) :
                     ?>
                     <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                     </header>
                     <?php
                  endif;

                  /* Start the Loop */
                  while ( have_posts() ) :
                     the_post();

                     get_template_part( 'template-parts/blog/contents/content', get_post_format() ); 

                  endwhile;
                     get_template_part( 'template-parts/blog/paginations/pagination', 'style1' );
                 

               else :

                     get_template_part( 'template-parts/content', 'none' );

               endif;
               ?>
           </div><!-- #col -->
         <?php 

           if($layout == "right"):
			   	get_sidebar();
            endif;
            
         ?>
      </div><!-- #row -->
	</div><!-- #primary -->
</section>
<?php

get_footer();
