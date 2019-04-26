<?php
if( class_exists( 'WP_Customize_Control' ) ):


	class Customizer_Icon_Picker_Control_Social extends WP_Customize_Control {

		public $type = 'social-icon-picker';

      public $iconset = array();
      
      public $customizer_icon_container = '';

	
      
     /*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
      parent::__construct( $manager, $id, $args ); 

      if ( file_exists( get_template_directory() . '/inc/customizer-repeater/inc/icons_social.php' ) ) {
			$this->customizer_icon_container =  '/inc/customizer-repeater/inc/icons_social';
		}

   }

		public function enqueue() {
    
         wp_enqueue_style( 'customizer-repeater-admin-stylesheet', get_template_directory_uri().'/inc/customizer-repeater/css/admin-style.css', array(), time() );
         wp_enqueue_style( 'customizer-repeater-fontawesome-iconpicker-script', get_template_directory_uri() . '/inc/customizer-repeater/css/fontawesome-iconpicker.min.css', array(), time() );
         
         wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/inc/customizer-repeater/css/font-awesome.min.css', array(), time() );
         
		}

		public function render_content() {
		
		?>
			<label>
		 	  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			  <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		     <input class="customizer-social-icon-picker" value="<?php echo $this->value(); ?>" type="text" id="customizer-social-icon-<?php echo esc_attr( $this->id ); ?>" <?php esc_attr( $this->link() ); ?> />

           
            <?php get_template_part( $this->customizer_icon_container ); ?>
				
			</label>
		<?php }

	}

endif;
