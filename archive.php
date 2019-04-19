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

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/blog/contents/content', get_post_type() );
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
