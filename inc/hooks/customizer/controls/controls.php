<?php
if( class_exists( 'WP_Customize_Control' ) ):

 

   class Ts_Image_Radio_Button_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
 		public $type = 'image_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
 		public function enqueue() {
         wp_enqueue_script( 'customizer-control', TS_JS . '/custom-customizer.js', array( 'jquery' ), TS_VERSION, true );
         wp_enqueue_style( 'customizer-control', TS_CSS . '/customizer.css', null, TS_VERSION );
 		}
		/**
		 * Render the control in the customizer
		 */
 		public function render_content() {
        
 		?>
			<div class="image_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="radio-button-label">
						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
 		<?php
 		}
 	}


   class Ts_Toggle_Switch_Custom_control extends WP_Customize_Control {
      /**
       * The type of control being rendered
      */
      public $type = 'toggle_switch';
      /**
       * Enqueue our scripts and styles
      */
      
      public function enqueue(){
   
         wp_enqueue_script( 'customizer-control', TS_JS . '/custom-customizer.js', array( 'jquery' ), TS_VERSION, true );
         wp_enqueue_style( 'customizer-control', TS_CSS . '/customizer.css', null, TS_VERSION );
      }
      /**
       * Render the control in the customizer
      */
      public function render_content(){
       
      ?>
       <div class="toggle-switch-control">
         <div class="toggle-switch">
            <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
            <label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
               <span class="toggle-switch-inner"></span>
               <span class="toggle-switch-switch"></span>
            </label>
         </div>
         <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <?php if( !empty( $this->description ) ) { ?>
            <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
         <?php } ?>
      </div>
      <?php
      }
   }


	
   

endif;
