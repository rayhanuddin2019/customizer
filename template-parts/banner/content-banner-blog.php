<?php 

   $banner_image = TS_IMG.'/banner/banner_bg.jpg';
   $banner_title = get_bloginfo( 'name' );
   $show = 'yes';
   $show_breadcrumb = 'no';

  //image
   $banner_image = get_theme_mod('ts_blog_banner_img') ? get_theme_mod('ts_blog_banner_img') : TS_IMG.'/banner/banner_bg.jpg';
   //title 
   $banner_title = get_theme_mod('ts_blog_banner_title') ? get_theme_mod('ts_blog_banner_title') : get_bloginfo( 'name' );
   //bg image show
   $show = !get_theme_mod('ts_blog_banner_show') ? get_theme_mod('ts_blog_banner_show'): 'yes'; 
  
   //breadcumb show 
   $show_breadcrumb =  !get_theme_mod('ts_blog_banner_breadcrumb_show') ? get_theme_mod('ts_blog_banner_breadcrumb_show') : 'yes';
 
   
 if( isset($banner_image) && $banner_image != ''){
   $banner_image = 'style="background-image:url('.esc_url( $banner_image ).');"';
}


?>

<?php if(isset($show) && $show == 'yes'): ?>
<div id="page-banner-area" class="page-banner-area" <?php echo wp_kses_post( $banner_image ); ?>>
   <!-- Subpage title start -->
   <div class="page-banner-title">
   
      <div class="text-center">
      
         <p class="banner-title">
         <?php 
            if(is_archive()){
            the_archive_title();
         }else{
           echo esc_html($banner_title);
         }
    
         ?> 
         </p> 
      
      
      <?php if($show_breadcrumb == 'yes'): ?>
            <?php ts_get_breadcrumbs(' / '); ?>
      <?php endif; ?>
      </div>
   </div><!-- Subpage title end -->
</div><!-- Page Banner end -->
<?php endif; ?>