<?php

   get_header();
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

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'ts' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/blog/contents/content', 'search' );

			endwhile;

            get_template_part( 'template-parts/blog/paginations/pagination', 'style1' );

		else :

		      get_template_part( 'template-parts/blog/contents/content', 'none' );

		endif;
		?>

         </div><!-- #col -->
         <?php 
            if($layout == "right"):
                  get_sidebar();
            endif; 
           ?>
     </div><!-- #row -->
	</div><!-- #container -->
</section>

<?php

get_footer();
