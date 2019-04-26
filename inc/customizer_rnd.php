<?php
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Range_Value_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Footer_Range_control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Box_Model_control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Date_Picker_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Pick_A_Day_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Sortable_Repeater_Custom_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_TinyMCE_Custom_control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Gradient_Color_Picker_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer-Alpha-Color-Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Icon_Picker_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Icon_Picker_Control_Social.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Typography_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Typography_Group_Control.php';
require get_template_directory() . '/inc/hooks/customizer/controls/Customizer_Dimension_Control.php';

function rnd_customizer_settings($wp_customizer){

   
   $wp_customizer->add_panel( 'rnd_panel', array(
      'title' => esc_html__( 'RND PANEL','ts' ),
      'description' => esc_html__('all rnd settings','ts'), // Include html tags such as <p>.
      'priority' => 31, // Mixed with top-level-section hierarchy.
   
   ) );

   $wp_customizer->add_section( 'rnd_general_header_section', array(
      'title'           => esc_html__( 'Header', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );  

   $wp_customizer->add_section( 'rnd_general_gradient_section', array(
      'title'           => esc_html__( 'gradient', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) ); 

   $wp_customizer->add_section( 'rnd_general_typhography_section', array(
      'title'           => esc_html__( 'Typhography', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );

   $wp_customizer->add_section( 'rnd_general_dimension_section', array(
      'title'           => esc_html__( 'Dimension', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );

   $wp_customizer->add_section( 'rnd_general_editor_section', array(
      'title'           => esc_html__( 'wpEditor', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );

   $wp_customizer->add_section( 'rnd_general_repeater_section', array(
      'title'           => esc_html__( 'repeater', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );

   $wp_customizer->add_section( 'rnd_general_codeeditor_section', array(
      'title'           => esc_html__( 'Code editor', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );

   $wp_customizer->add_section( 'rnd_general_icon_picker_section', array(
      'title'           => esc_html__( 'icon picker', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );

   $wp_customizer->add_section( 'rnd_general_footer_section', array(
      'title'           => esc_html__( 'Footer widget', 'ts' ),
      'priority'        => '30',
      'panel' => 'rnd_panel'
   ) );

//   //   color
//   $wp_customizer->add_setting(
//       'rnd_general_header_button_bg_color', //give it an ID
//          [ 
//             'default' => '', 
//             'transport' => 'refresh', 
//             'type'=>'theme_mod',
            
         
//          ]
//    );

//    $wp_customizer->add_control(
//       'rnd_general_header_button_bg_color_clr', 
//       array(
//          'label'    => esc_html__( 'Button background color', 'ts' ),
//          'section'  => 'rnd_general_header_section',
//          'settings' => 'rnd_general_header_button_bg_color',
//          'type'     => 'color',
         
//       )
//    );
//   // text editor
 
//    require get_template_directory() . '/inc/wordpress-theme-customizer-custom-controls/select/google-font-dropdown-custom-control.php';
//    $wp_customizer->add_setting( 'google_font_setting', array(
//       'default'        => '',
//   ) );
//   $wp_customizer->add_control( new Google_Font_Dropdown_Custom_Control( $wp_customizer, 'google_font_setting', array(
//       'label'   => 'Google Font Setting',
//       'section' => 'rnd_general_header_section',
//       'settings'   => 'google_font_setting',
//       'priority' => 12
//   ) ) );
  
//   // footer range control
  $wp_customizer->add_setting( 'footer_widgets_layout_setting', array(
      'default'        => '',
      'transport' => 'postMessage'
   ) );

  $wp_customizer->add_control( new WP_Customize_Range_Control(
   $wp_customizer,
   'footer_widgets_layout_setting',
      array(
         'priority'    => 1,
         'label'       => _x( 'Footer widgets layout', 'backend', 'mentalpress_wp' ),
         'description' => _x( 'Select number of widget you want in the footer and then with the slider rearrange the layout', 'backend', 'mentalpress_wp' ),
         'section'     => 'rnd_general_footer_section',
         'input_attrs' => array(
            'min'     => 0,
            'max'     => 12,
            'step'    => 1,
            'maxCols' => 6,
         )
      )
   ) );

//   // date picker

//   // Add A Date Picker

//    $wp_customizer->add_setting( 'date_picker_setting', array(
//        'default'        => '',
//    ) );
//    $wp_customizer->add_control( new Date_Picker_Custom_Control( $wp_customizer, 'date_picker_setting', array(
//        'label'   => 'Date Picker Setting',
//        'section' => 'rnd_general_header_section',
//        'settings'   => 'date_picker_setting',
//        'priority' => 1
//    ) ) );


   require get_template_directory() . '/inc/customizer-repeater/class/customizer-repeater-control.php';
   $wp_customizer->add_setting( 'customizer_repeater_examplesa', array(
      'sanitize_callback' => 'customizer_repeater_sanitize',
      'transport' => 'postMessage'
   ));
      $wp_customizer->add_control( new Customizer_Repeater( $wp_customizer, 'customizer_repeater_examplesa', array(
      'label'   => esc_html__('Social','customizer-repeater'),
      'section' => 'rnd_general_repeater_section',
      'priority' => 1,
      'customizer_repeater_image_control' => false,
      'customizer_repeater_icon_control' => true,
      'customizer_repeater_title_control' => true,
      'customizer_repeater_subtitle_control' => false,
      'customizer_repeater_text_control' => false,
      'customizer_repeater_link_control' => false,
      'customizer_repeater_shortcode_control' => false,
      'customizer_repeater_repeater_control' => false
   ) ) );

   $wp_customizer->add_setting( 'customizer_repeater_', array(
      'sanitize_callback' => 'customizer_repeater_sanitize',
      'transport' => 'postMessage'
   ));
      $wp_customizer->add_control( new Customizer_Repeater( $wp_customizer, 'customizer_repeater_', array(
      'label'   => esc_html__('Social bazar','customizer-repeater'),
      'section' => 'rnd_general_repeater_section',
      'priority' => 1,
      'customizer_repeater_image_control' => false,
      'customizer_repeater_icon_control' => true,
      'customizer_repeater_title_control' => true,
      'customizer_repeater_subtitle_control' => false,
      'customizer_repeater_text_control' => false,
      'customizer_repeater_link_control' => false,
      'customizer_repeater_shortcode_control' => false,
      'customizer_repeater_repeater_control' => false
   ) ) );

//     // pik a day Then a setting...
//     $wp_customizer->add_setting( 'pikaday_setting', [
//       'default' => '',
//       'transport' => 'postMessage'
//   ] );
  
//   // ...and finally add the Pikaday control
//   $wp_customizer->add_control( 
//       new PikadayControl( $wp_customizer, 'pikaday_control', [
//           'label' => 'Pikaday Calendar',
//           'section' => 'rnd_general_header_section',
//           'settings' => 'pikaday_setting',
//           'position' => 'bottom right',   // position the  datepicker
//           'format' => 'MMMM Do YYYY'      // define the date format
//           // ... add any other valid Pikaday params here
//       ] )
//   );

//      //sortable repeater
//      $wp_customizer->add_setting( 'sample_sortable_repeater_control',
//      array(
//         'default' => '',
//         'transport' => 'postMessage',
    
//      )
//     );
//   $wp_customizer->add_control( new Customizer_Sortable_Repeater_Control( $wp_customizer, 'sample_sortable_repeater_control',
//      array(
//         'label' => __( 'Sortable Repeater' ),
//         'description' => esc_html__( 'This is the control description.' ),
//         'section' => 'rnd_general_repeater_section',
//         'button_labels' => array(
//            'add' => __( 'Add Row' ), // Optional. Button label for Add button. Default: Add
//         )
//      )
//   ) );
//  //  tinymce
   $wp_customizer->add_setting( 'sample_tinymce_editor',
      array(
         'default' => '',
         'transport' => 'postMessage',
         
      )
   );
   $wp_customizer->add_control( new Customizer_TinyMCE_Custom_control( $wp_customizer, 'sample_tinymce_editor',
      array(
         'label' => __( 'Copyright text' ),
         'description' => __( 'This is a TinyMCE Editor Custom Control' ),
         'section' => 'rnd_general_editor_section',
         'input_attrs' => array(
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect outdent indent | blockquote charmap',
            'mediaButtons' => true,
         )
      )
   ) );

   //gradient
   $wp_customizer->add_setting( 'sample_gradient_colors',
         array(
            'default' => '',
            'transport' => 'postMessage',
         )
      );
   $wp_customizer->add_control( new Customizer_Gradient_Color_Picker_Control( $wp_customizer, 'sample_gradient_colors',
      array(
         'label' => __( 'Banner Gradient Color' ),
         'description' => esc_html__( ' custom control description' ),
         'section' => 'rnd_general_gradient_section',
      
         
      )
   ) );

   //ALPA COLOR
    $wp_customizer->add_setting( 'sample_alpa_color',
         array(
            'default' => '',
            'transport' => 'postMessage'
         )
      );

   $wp_customizer->add_control( new WP_Customize_Color_Control( $wp_customizer, 'sample_alpa_color',
      array(
         'label' => __( 'Footer copyright text color' ),
         'description' => esc_html__( 'Sample custom control description' ),
         'section' => 'rnd_general_gradient_section',
        
         
      )
   ) );

   //icon picker
   $wp_customizer->add_setting( 'social_icon_picker_color',
      array(
         'default' => '',
         'transport' => 'postMessage'
      )
   );
   $wp_customizer->add_control( new Customizer_Icon_Picker_Control_Social( $wp_customizer, 'social_icon_picker_color',
   array(
      'label' => __( 'Social icon Picker Control' ),
      'description' => esc_html__( 'Sample custom control description' ),
      'section' => 'rnd_general_icon_picker_section',
     
   )
   ) );

   $wp_customizer->add_setting( 'custom_h2_font_style', 
    array( 
     'default' => '', 
     'transport' => 'postMessage',
     'type' => 'custom-typography' 
     )
    );
   
  $wp_customizer->add_control(
   new Customizer_Custom_Typography_Control(
      $wp_customizer,
      'custom_h2_font_style',
      array(
         'label' => __( 'Alpa typho Picker Control' ),
         'description' => esc_html__( 'Sample custom control description' ),
         'section' => 'rnd_general_icon_picker_section',
         'input_attrs' => array(
            'placeholder' => __( 'Please select a state...', 'skyrocket' ),
            'multiselect' => true,
         ),
         'choices' => array(
            'nsw' => __( 'New South Wales', 'skyrocket' ),
            'vic' => __( 'Victoria', 'skyrocket' ),
            'qld' => __( 'Queensland', 'skyrocket' ),
            'wa' => __( 'Western Australia', 'skyrocket' ),
            'sa' => __( 'South Australia', 'skyrocket' ),
            'tas' => __( 'Tasmania', 'skyrocket' ),
            'act' => __( 'Australian Capital Territory', 'skyrocket' ),
            'nt' => __( 'Northern Territory', 'skyrocket' ),
         )
      
         
      )
   )
);

$wp_customizer->add_setting('custom_info_asdasd', array(
	'default'           => '',
	
 
));
$wp_customizer->add_control(new Info_Custom_control($wp_customizer, 'custom_info_asdasd', array(
	'label'    		=> esc_html__('A custom notice', 'mytheme'),
	'section'  		=> 'rnd_general_header_section',
)));

$wp_customizer->add_setting('custom_typhography_asdasd', array(
	'default'           => '',
	'transport' => 'postMessage',
 
));
$wp_customizer->add_control(new Customizer_Custom_Typography_Group_Control($wp_customizer, 'custom_typhography_asdasd', array(
	'label'    		=> esc_html__(' Custom group typhography', 'mytheme'),
	'section'  		=> 'rnd_general_typhography_section',
)));



$wp_customizer->add_setting('custom_dimension_2nd', array(
	'default'           => '',
   'transport' => 'postMessage',
  // 'transport' => 'refresh',
 
));

$wp_customizer->add_control(new Customizer_Dimension_Control($wp_customizer, 'custom_dimension_2nd', array(
	'label'    		=> esc_html__('A 2nd custom Dimension', 'mytheme'),
   'section'  		=> 'rnd_general_dimension_section',
   'input_attrs' => array(
      'type' => 'padding',
     
   ),
)));

$wp_customizer->add_setting('custom_dimension_3nd', array(
	'default'           => '',
   'transport' => 'postMessage',
 
));

$wp_customizer->add_control(new Customizer_Dimension_Control($wp_customizer, 'custom_dimension_3nd', array(
	'label'    		=> esc_html__('A header custom margin', 'mytheme'),
   'section'  		=> 'rnd_general_dimension_section',
   'input_attrs' => array(
      'type' => 'margin',
     
   ),
)));

$wp_customizer->add_setting('code_editor_js', array(
	'default'           => '',
   'transport' => 'postMessage',
   'type' => 'option',
 
));
// checkout test.php
$wp_customizer->add_control(new WP_Customize_Code_Editor_Control($wp_customizer, 'code_editor_js', array(
	'label'    		=> esc_html__('Additional JS ', 'mytheme'),
   'section'  		=> 'rnd_general_codeeditor_section',
   
   array(
		'label'     => 'Additional JS',
		'code_type' => 'javascript',
		'settings'  => 'code_editor_js',
		'section'   => 'rnd_general_codeeditor_section',
	) 
  
)));


$wp_customizer->add_setting('code_editor_css', array(
	'default'           => '',
   'transport' => 'postMessage',
   'type' => 'option',
 
));

$wp_customizer->add_control(new WP_Customize_Code_Editor_Control($wp_customizer, 'code_editor_css', array(
  
   'label'     => 'Additional css',
   'code_type' => 'css',
   'section'   => 'rnd_general_codeeditor_section', 
  
)));





}

add_action( 'customize_register', 'rnd_customizer_settings' );








