<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ts
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
     
    <!-- <style>
     <?php 
     
     $color=json_decode(get_theme_mod( 'sample_gradient_colors'));
    
     ?> 
      .sample_class {
         height:500px;
         
         <?php foreach($color->background as $item){ ?>
          background: <?php echo $item.";"; ?>
         <?php } ?>
      }
     
    </style> -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site sample_class">
  	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ts' ); ?></a>
   <?php 
        $header_layout = get_theme_mod( 'ts_general_header_layout');
       
     
       //  $custom_dimension=json_decode(get_theme_mod( 'custom_dimension_asdasd'));
         $custom_dimension_2nd=json_decode(get_theme_mod( 'custom_dimension_2nd'));
         $custom_dimension_3nd=json_decode(get_theme_mod( 'custom_dimension_3nd'));
         var_dump($custom_dimension_2nd);
      
      
        get_template_part( 'template-parts/headers/header', $header_layout ); 
   ?>
	<div id="content" class="site-content">
