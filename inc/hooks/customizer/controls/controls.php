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


   class Customizer_Dropdown_Select2_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'dropdown_select2';
		/**
		 * The type of Select2 Dropwdown to display. Can be either a single select dropdown or a multi-select dropdown. Either false for true. Default = false
		 */
		private $multiselect = false;
		/**
		 * The Placeholder value to display. Select2 requires a Placeholder value to be set when using the clearall option. Default = 'Please select...'
		 */
		private $placeholder = 'Please select...';
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Check if this is a multi-select field
			if ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) {
				$this->multiselect = true;
			}
			// Check if a placeholder string has been specified
			if ( isset( $this->input_attrs['placeholder'] ) && $this->input_attrs['placeholder'] ) {
				$this->placeholder = $this->input_attrs['placeholder'];
			}
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'uyhuskyrocket-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array( 'jquery' ), '4.0.6', true );
		   wp_enqueue_script( 'customizer-control-repeat', TS_JS . '/customizer_repeater.js', array( 'jquery' ), TS_VERSION, true );
         wp_enqueue_style( 'customizer-control', TS_CSS . '/customizer.css', null, TS_VERSION );
			wp_enqueue_style( 'sdsdskyrocket-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', array(), '4.0.6', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$defaultValue = $this->value();
			if ( $this->multiselect ) {
				$defaultValue = explode( ',', $this->value() );
			}
		?>
			<div class="dropdown_select2_control">
				<?php if( !empty( $this->label ) ) { ?>
					<label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</label>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-dropdown-select2" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> />
				<select name="select2-list-<?php echo ( $this->multiselect ? 'multi[]' : 'single' ); ?>" class="customize-control-select2" data-placeholder="<?php echo $this->placeholder; ?>" <?php echo ( $this->multiselect ? 'multiple="multiple" ' : '' ); ?>>
					<?php
						if ( !$this->multiselect ) {
							// When using Select2 for single selection, the Placeholder needs an empty <option> at the top of the list for it to work (multi-selects dont need this)
							echo '<option></option>';
						}
						foreach ( $this->choices as $key => $value ) {
							if ( is_array( $value ) ) {
								echo '<optgroup label="' . esc_attr( $key ) . '">';
								foreach ( $value as $optgroupkey => $optgroupvalue ) {
									echo '<option value="' . esc_attr( $optgroupkey ) . '" ' . ( in_array( esc_attr( $optgroupkey ), $defaultValue ) ? 'selected="selected"' : '' ) . '>' . esc_attr( $optgroupvalue ) . '</option>';
								}
								echo '</optgroup>';
							}
							else {
								echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $key ), $defaultValue, false )  . '>' . esc_attr( $value ) . '</option>';
							}
	 					}
	 				?>
				</select>
			</div>
		<?php
		}
   }
   
   class Customizer_Custom_Textarea_Control extends WP_Customize_Control {
		public $type = 'customizer-textarea';
 
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
   }
   
   class Info_Custom_control extends WP_Customize_Control{
      public $type = 'text';

      public function enqueue() {

		   wp_enqueue_script( 'customizer-control-repeat', TS_JS . '/customizer_repeater.js', array( 'jquery' ), TS_VERSION, true );
    
		}
      public function render_content(){
         ?>
         <span class="customize-control-dropdown"><?php echo esc_html( $this->label ); ?></span>
          <input type="text" class="customize-control-dropdown-text" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> />

         <select class="custom-typhography-fonts">
            <option value="lateo">lateo</option>
            <option value="times">time</option>
            <option value="relay">relay</option>
       
         </select>

         <select class="custom-typhography-fonts-size">
            <option value="10">10</option>
            <option value="12">12</option>
            <option value="13">13</option>
       
         </select>
         <?php
      }
   }


	
   

endif;
