<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
?>
   
<article <?php post_class('post');?>>
	<div class="post-media">
   <?php ts_post_thumbnail(); ?>
	</div><!-- Post Media end -->
	<div class="post-body">
		<div class="entry-header">
			
         <div class="post-meta">
         <?php 
       
      
         if(get_theme_mod('ts_blog_author')):
            printf(
               '<span class="post-author"><i class="icon icon-user"></i> <a href="%2$s">%3$s</a></span>',
               get_avatar( get_the_author_meta( 'ID' ), 55 ), 
               esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
               get_the_author()
            );
         endif;

         if(get_theme_mod('ts_blog_date')):
            if ( get_post_type() === 'post' ) {
               echo '<span class="post-meta-date">
                  <i class="icon icon-clock"></i>
                     '. get_the_date() . 
                  '</span>';
            } 
         endif;

         if(get_theme_mod('ts_blog_category')):
         $category_list = get_the_category_list( ', ' );
            if ( $category_list ) {
               echo '<span class="meta-categories post-cat">
                  <i class="icon icon-folder"></i>
                     '. $category_list .' 
                  </span>';
            }
         endif;
         ?>	
      </div>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php if ( is_sticky() ) {
					echo '<sup class="meta-featured-post"> <i class="fa fa-thumb-tack"></i> ' . esc_html__( 'Sticky', 'ts' ) . ' </sup>';
				} ?>
			</h2>
			
			<div class="entry-content">
         
         <?php  if(get_theme_mod('ts_blog_listing_desc_length')): ?>
				   <?php ts_excerpt( get_theme_mod('ts_blog_post_char_limit_length',40), null ); ?>
         <?php endif; ?> 
			</div>
         <?php  if(get_theme_mod('ts_blog_readmore')): ?>
			<div class="post-footer">
				<a class="btn-readmore" href="<?php the_permalink(); ?>">
					<?php esc_html_e(get_theme_mod('ts_blog_readmore_text','Read more'), 'ts') ?>
					<i class="icon icon-arrow-right"></i>
				</a>
         </div>
         <?php endif; ?> 

		</div><!-- Entry header end -->
	</div><!-- Post body end -->
</article>