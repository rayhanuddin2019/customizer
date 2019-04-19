<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ts
 */

get_header();

$layout = get_theme_mod('ts_blog_layout','left');
$column = $layout == "full" || !is_active_sidebar('sidebar-1')? 'col-lg-12' : 'col-lg-8 col-md-12';
?>

<section id="main-content" class="main-container" role="main">
	<div class="container">
		<div class="row">
      <?php
         if($layout == "left"):
		 		get_sidebar();
         endif;
      ?>
         <div class="<?php echo esc_attr($column); ?>">
		<?php
         while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/blog/contents/content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
               comments_template();
            endif;

         endwhile; // End of the loop.
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
