<?php
require get_template_directory() . '/inc/hooks/customizer/controls/controls.php';


/**
 * ts Theme Customizer
 *
 * @package ts
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ts_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ts_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ts_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'ts_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ts_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ts_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ts_customize_preview_js() {

  
   wp_enqueue_script( 'ts-customizer', TS_JS . '/customizer.js', array( 'customize-preview' ), TS_VERSION, true );

   
}
add_action( 'customize_preview_init', 'ts_customize_preview_js' );

// blog section

function blog_customizer_settings( $wp_customizer ) { 
      
      //genaral
      $wp_customizer->add_panel( 'ts_general', array(
         'title' => esc_html__( 'General','ts' ),
         'description' => esc_html__('all general settings','ts'), // Include html tags such as <p>.
         'priority' => 31, // Mixed with top-level-section hierarchy.
       
        ) );
        $wp_customizer->add_section( 'ts_general_header_section', array(
         'title'           => esc_html__( 'Header', 'ts' ),
         'priority'        => '30',
         'panel' => 'ts_general'
      ) );  
      
      $wp_customizer->add_panel( 'ts_blog', array(
      'title' => esc_html__( 'Blog','ts' ),
      'description' => esc_html__('all blog post','ts'), // Include html tags such as <p>.
      'priority' => 31, // Mixed with top-level-section hierarchy.
    
     ) );

      $wp_customizer->add_section( 'ts_blog_section', array(
         'title'           => esc_html__( 'Blog list', 'ts' ),
         'priority'        => '30',
         'panel' => 'ts_blog'
      ) );

      $wp_customizer->add_section( 'ts_single_blog_section', array(
         'title'           => esc_html__( 'Single blog ', 'ts' ),
         'priority'        => '32',
         'panel' => 'ts_blog'
      ) );
      
      $wp_customizer->add_setting( 'ts_blog_author', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
         'type'=>'theme_mod' //theme_mod or option
      ) );

   

      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_author_clr', 
         array(
            'label'	=> esc_html__( 'Blog Author', 'ts' ),
            'section' => 'ts_blog_section',
            'settings' => 'ts_blog_author',
           
         ) 
      ));
      $wp_customizer->add_setting( 'ts_blog_date', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
         'type'=>'theme_mod' //theme_mod or option
      ) );

  
      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_date_clr', 
         array(
            'label'	=> esc_html__( 'Blog date', 'ts' ),
            'section' => 'ts_blog_section',
            'settings' => 'ts_blog_date',
           
         ) 
      ));

      $wp_customizer->add_setting( 'ts_blog_category', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_category_clr', 
         array(
            'label'	=> esc_html__( 'Blog category', 'ts' ),
            'section' => 'ts_blog_section',
            'settings' => 'ts_blog_category',
          
         ) 
      ));

      $wp_customizer->add_setting( 'ts_blog_listing_desc_length', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_list_desc_length_clr', 
         array(
            'label'	=> esc_html__( 'Blog list description length', 'ts' ),
            'section' => 'ts_blog_section',
            'settings' => 'ts_blog_listing_desc_length',
          
         ) 
      ));

      $wp_customizer->add_setting( 'ts_blog_post_char_limit_length', array(
         'default'   => esc_html__("Post Char Limit",'ts'),
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );
     
      $wp_customizer->add_control(
         'ts_blog_post_char_length_clr', 
         array(
            'label'    => esc_html__( 'Post Char Limit', 'ts' ),
            'section'  => 'ts_blog_section',
            'settings' => 'ts_blog_post_char_limit_length',
            'type'     => 'number',
            'active_callback' => function () {
             
               if ( get_theme_mod( 'ts_blog_listing_desc_length' ) == 1 ) {
                  return true;
               }
      
               return false;
            }
            
         )
      );
     
     
      $wp_customizer->add_setting( 'ts_blog_readmore', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_readmore_clr', 
         array(
            'label'	=> esc_html__( 'Blog readmore', 'ts' ),
            'section' => 'ts_blog_section',
            'settings' => 'ts_blog_readmore',
          
         ) 
      ));

        
      $wp_customizer->add_setting( 'ts_blog_readmore_text', array(
         'default'   => esc_html__( 'readmore', 'ts' ),
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

      $wp_customizer->add_control(
         'ts_blog_readmore_text_clr', 
         array(
            'label'    => esc_html__( 'Readmore text', 'ts' ),
            'section'  => 'ts_blog_section',
            'settings' => 'ts_blog_readmore_text',
            'type'     => 'text',
            'active_callback' => function () {
             
               if ( get_theme_mod( 'ts_blog_readmore' ) == 1 ) {
                  return true;
               }
      
               return false;
            }
            
         )
      );


      $wp_customizer->add_setting( 'ts_blog_layout', array(
         'default'   => 'right',
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

     $wp_customizer->add_control( new Ts_Image_Radio_Button_Custom_Control( $wp_customizer, 'ts_blog_layout',
			array(
				'label' => esc_html__( 'Blog layout', 'ts' ),
				'description' => esc_html__( ' Blog layout ', 'ts' ),
				'section' => 'ts_blog_section',
				'choices' => array(
					'left' => array(
						'image' => TS_IMG . '/admin/customizer/sidebar-left.png',
						'name' => esc_html__( 'Left Sidebar', 'ts' )
					),
					'full' => array(
						'image' => TS_IMG . '/admin/customizer/sidebar-none.png',
						'name' => esc_html__( 'No Sidebar', 'ts' )
					),
					'right' => array(
						'image' => TS_IMG . '/admin/customizer/sidebar-right.png',
						'name' => esc_html__( 'Right Sidebar', 'ts' )
					)
				)
			)
		) );

      $wp_customizer->add_setting( 'ts_blog_post_comment_open', array(
      'default'   => 1,
      'transport' => 'refresh', //postMessage
      'type'=>'theme_mod' //theme_mod or option

      ) );
    
      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_post_comment_open_clr', 
         array(
            'label'	=> esc_html__( 'Single Post Comment', 'ts' ),
            'section' => 'ts_single_blog_section',
            'settings' => 'ts_blog_post_comment_open',
          
         ) 
      )); 

      $wp_customizer->add_setting( 'ts_blog_post_navigation', array(
         'default'   => 1,
         'transport' => 'refresh', //postMessage
         'type'=>'theme_mod' //theme_mod or option
   
         ) );
   
         
      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
            $wp_customizer, 
            'ts_blog_post_navigation_clr', 
            array(
               'label'	=> esc_html__( 'Post navigation', 'ts' ),
               'section' => 'ts_single_blog_section',
               'settings' => 'ts_blog_post_navigation',
             
            ) 
      )); 

      $wp_customizer->add_setting( 'ts_blog_related_post', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
         'type'=>'theme_mod' //theme_mod or option
   
         ) );
   
         
      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
            $wp_customizer, 
            'ts_blog_related_post_clr', 
            array(
               'label'	=> esc_html__( 'Related Post', 'ts' ),
               'section' => 'ts_single_blog_section',
               'settings' => 'ts_blog_related_post',
             
            ) 
      )); 


      //banner blog start 
      $wp_customizer->add_panel( 'ts_banner', array(
         'title' => esc_html__( 'Banner settings','ts' ),
         'description' => esc_html__('Banner settings','ts'), // Include html tags such as <p>.
         'priority' => 33, // Mixed with top-level-section hierarchy.
       
      ) );
   
      $wp_customizer->add_section( 'ts_blog_banner_section', array(
            'title'           => esc_html__( 'Blog', 'ts' ),
            'priority'        => '30',
            'panel' => 'ts_banner'
      ) );
  
      $wp_customizer->add_setting( 'ts_blog_banner_show', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_banner_show_clr', 
         array(
            'label'	=> esc_html__( 'Show Banner', 'ts' ),
            'section' => 'ts_blog_banner_section',
            'settings' => 'ts_blog_banner_show',
          
         ) 
      ));

      
      $wp_customizer->add_setting( 'ts_blog_banner_breadcrumb_show', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_blog_banner_breadcrumb_show_clr', 
         array(
            'label'	=> esc_html__( 'Show breadcrumb', 'ts' ),
            'section' => 'ts_blog_banner_section',
            'settings' => 'ts_blog_banner_breadcrumb_show',
          
         ) 
      ));
 
      $wp_customizer->add_setting( 'ts_blog_banner_title', array(
         'default'   => esc_html__( 'Blog', 'ts' ),
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );

      $wp_customizer->add_control(
         'ts_blog_banner_title_clr', 
         array(
            'label'    => esc_html__( 'Banner title', 'ts' ),
            'section'  => 'ts_blog_banner_section',
            'settings' => 'ts_blog_banner_title',
            'type'     => 'text',
            
         )
      ); 

     
      $wp_customizer->add_setting( 'ts_blog_banner_img', array(
         'default'   => '',
         'transport' => 'refresh', //postMessage
   		'type'=>'theme_mod' //theme_mod or option
      ) );


      $wp_customizer->add_control( 
         new WP_Customize_Upload_Control( 
         $wp_customizer, 
         'ts_blog_banner_img_clr', 
         array(
            'label'      => esc_html__( 'Banner Background Image', 'ts' ),
            'section'    => 'ts_blog_banner_section',
            'settings'   => 'ts_blog_banner_img',
         ) ) 
      );

     //banner end
    
     // banner page 



   $wp_customizer->add_section( 'ts_page_banner_section', array(
         'title'           => esc_html__( 'Page ', 'ts' ),
         'priority'        => '30',
         'panel' => 'ts_banner'
   ) );

   $wp_customizer->add_setting( 'ts_page_banner_show', array(
      'default'   => 0,
      'transport' => 'refresh', //postMessage
      'type'=>'theme_mod' //theme_mod or option
   ) );

   $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
      $wp_customizer, 
      'ts_page_banner_show_clr', 
      array(
         'label'	=> esc_html__( 'Show Banner', 'ts' ),
         'section' => 'ts_page_banner_section',
         'settings' => 'ts_page_banner_show',
       
      ) 
   ));

   
   $wp_customizer->add_setting( 'ts_page_banner_breadcrumb_show', array(
      'default'   => 0,
      'transport' => 'refresh', //postMessage
      'type'=>'theme_mod' //theme_mod or option
   ) );

   $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
      $wp_customizer, 
      'ts_page_banner_breadcrumb_show_clr', 
      array(
         'label'	=> esc_html__( 'Show breadcrumb', 'ts' ),
         'section' => 'ts_page_banner_section',
         'settings' => 'ts_page_banner_breadcrumb_show',
       
      ) 
   ));

   $wp_customizer->add_setting( 'ts_page_banner_title', array(
      'default'   => esc_html__( 'Blog', 'ts' ),
      'transport' => 'refresh', //postMessage
      'type'=>'theme_mod' //theme_mod or option
   ) );

   $wp_customizer->add_control(
      'ts_page_banner_title_clr', 
      array(
         'label'    => esc_html__( 'Banner page title', 'ts' ),
         'section'  => 'ts_page_banner_section',
         'settings' => 'ts_page_banner_title',
         'type'     => 'text',
         
      )
   ); 

  
   $wp_customizer->add_setting( 'ts_page_banner_img', array(
      'default'   => '',
      'transport' => 'refresh', //postMessage
      'type'=>'theme_mod' //theme_mod or option
   ) );


   $wp_customizer->add_control( 
      new WP_Customize_Upload_Control( 
      $wp_customizer, 
      'ts_page_banner_img_clr', 
      array(
         'label'      => esc_html__( 'Banner Background Image', 'ts' ),
         'section'    => 'ts_page_banner_section',
         'settings'   => 'ts_page_banner_img',
      ) ) 
   );

     // banner page end

    // header style
    $wp_customizer->add_setting( 'ts_general_header_layout', array(
      'default'   => 'standard',
      'transport' => 'refresh', //postMessage
      'type'=>'theme_mod' //theme_mod or option
   ) );

   $wp_customizer->add_control( new Ts_Image_Radio_Button_Custom_Control( $wp_customizer, 'ts_general_header_layout',
         array(
            'label' => esc_html__( 'Header layout', 'ts' ),
            'section' => 'ts_general_header_section',
            'choices' => array(
               'standard' => array(
                  'image' => TS_IMG . '/admin/header-style/style2.png',
                  'name' => esc_html__( 'Standard', 'ts' )
               ),
               'transparent' => array(
                  'image' => TS_IMG . '/admin/header-style/style1.png',
                  'name' => esc_html__( 'Transparent', 'ts' )
               ),
              
            
            )
         )
      ) );
   
       // logo dark
      
       $wp_customizer->add_setting(
         'ts_blog_site_dark_logo', //give it an ID
            [ 
               'default' => '', 
               'transport' => 'refresh', 
               'type'=>'theme_mod',
            ]
      );
       
    

     $wp_customizer->add_control( new WP_Customize_Upload_Control( 
      $wp_customizer, 
      'ts_blog_site_dark_logo_clr', 
         array(
            'label'      => esc_html__( 'Dark logo', 'ts' ),
            'section'    => 'ts_general_header_section',
            'settings'   => 'ts_blog_site_dark_logo',
            'active_callback' => function () {

               if ( get_theme_mod( 'ts_general_header_layout' ) == 'standard' ) {
                  return true;
               }
               
               return false;
            }
            
         ) ) 
      );

      $wp_customizer->add_setting( 'ts_general_header_button_show', array(
         'default'   => 0,
         'transport' => 'refresh', //postMessage
         'type'=>'theme_mod' //theme_mod or option
      ) );

  
      $wp_customizer->add_control( new Ts_Toggle_Switch_Custom_control( 
         $wp_customizer, 
         'ts_general_header_button_show_clr', 
         array(
            'label'	=> esc_html__( 'Show Button', 'ts' ),
            'section' => 'ts_general_header_section',
            'settings' => 'ts_general_header_button_show',
           
         ) 
      ));

      $wp_customizer->add_setting(
         'ts_general_header_button_text', //give it an ID
            [ 
               'default' => '', 
               'transport' => 'refresh', 
               'type'=>'theme_mod',
              
              
            ]
      );

      $wp_customizer->add_control(
         'ts_general_header_button_text_clr', 
         array(
            'label'    => esc_html__( 'Button text', 'ts' ),
            'section'  => 'ts_general_header_section',
            'settings' => 'ts_general_header_button_text',
            'type'     => 'text',
          
            
         )
      );

      $wp_customizer->add_setting(
         'ts_general_header_button_url', //give it an ID
            [ 
               'default' => '', 
               'transport' => 'refresh', 
               'type'=>'theme_mod',
               'sanitize_callback' => function($url_link){
                 
                  if (filter_var($url_link, FILTER_VALIDATE_URL) === FALSE) {
                    return '';
                 }
                 return $url_link;
               }
              
            ]
      );

      $wp_customizer->add_control(
         'ts_general_header_button_url_clr', 
         array(
            'label'    => esc_html__( 'Button url', 'ts' ),
            'section'  => 'ts_general_header_section',
            'settings' => 'ts_general_header_button_url',
            'type'     => 'url',
            'active_callback' => function () {

               if ( get_theme_mod( 'ts_general_header_button_text') == '' ) {
                  return false;
               }
               
               return true;
            }
            
         )
      );

      $wp_customizer->add_setting(
         'ts_general_header_button_bg_color', //give it an ID
            [ 
               'default' => '', 
               'transport' => 'refresh', 
               'type'=>'theme_mod',
               
              
            ]
      );

      $wp_customizer->add_control(
         'ts_general_header_button_bg_color_clr', 
         array(
            'label'    => esc_html__( 'Button background color', 'ts' ),
            'section'  => 'ts_general_header_section',
            'settings' => 'ts_general_header_button_bg_color',
            'type'     => 'color',
            'active_callback' => function () {

               if ( get_theme_mod( 'ts_general_header_button_text') =='' ) {
                  return false;
               }
               
               return true;
            }
            
         )
      );

   
       
      

}


add_action( 'customize_register', 'blog_customizer_settings' );
// end blog section

//callback 



