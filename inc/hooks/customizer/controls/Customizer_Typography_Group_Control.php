<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */
 if( class_exists( 'WP_Customize_Control' ) ):
   class Customizer_Custom_Typography_Group_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'google_fonts';
		/**
		 * The list of Google Fonts
		 */
		private $fontList = false;
		/**
		 * The saved font values decoded from json
		 */
		private $fontValues = [];
		/**
		 * The index of the saved font within the list of Google fonts
		 */
		private $fontListIndex = 0;
		/**
		 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
		 */
		private $fontCount = 'all';
		/**
		 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
		 */
      private $fontOrderBy = 'alpha';
      
      private $default_font_size = '';

         
		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Get the font sort order
			if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
				$this->fontOrderBy = 'popular';
         }
         
        
			// Get the list of Google fonts
			if ( isset( $this->input_attrs['font_count'] ) ) {
				if ( 'all' != strtolower( $this->input_attrs['font_count'] ) ) {
					$this->fontCount = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
				}
			}
			$this->fontList = $this->customizer_getGoogleFonts( 'all' );
			// Decode the default json font value
			$this->fontValues = json_decode( $this->value() ,true);
         // Find the index of our default font within our list of Google fonts
         if($this->value()!=''){
          
            $this->fontListIndex = $this->skyrocket_getFontIndex( $this->fontList, $this->fontValues["font-family"] );
         }

         if( isset($this->input_attrs["font-size"]) && !isset($this->fontValues["font-size"]) ) {
            $this->fontValues["font-size"] =  $this->input_attrs["font-size"];
         }elseif(!isset($this->fontValues["font-size"])){
            $this->fontValues["font-size"] = '';
         }

         if( isset($this->input_attrs["line-height"]) && !isset($this->fontValues["line-height"]) ) {
            $this->fontValues["line-height"] =  $this->input_attrs["line-height"];
         }elseif(!isset($this->fontValues["line-height"])){
            $this->fontValues["line-height"] = '';
         }

         if( isset($this->input_attrs["letter-spacing"]) && !isset($this->fontValues["letter-spacing"]) ) {
            $this->fontValues["letter-spacing"] =  $this->input_attrs["letter-spacing"];
         }elseif(!isset($this->fontValues["letter-spacing"])){
            $this->fontValues["letter-spacing"] = '';
         }

         if( isset($this->input_attrs["trasnform"]) && !isset($this->fontValues["trasnform"]) ) {
            $this->fontValues["trasnform"] =  $this->input_attrs["trasnform"];
         }elseif(!isset($this->fontValues["trasnform"])){
            $this->fontValues["trasnform"] = 'lowercase';
         }

         if( isset($this->input_attrs["text-decoration"]) && !isset($this->fontValues["text-decoration"]) ) {
            $this->fontValues["text-decoration"] =  $this->input_attrs["text-decoration"];
         }elseif(!isset($this->fontValues["text-decoration"])){
            $this->fontValues["text-decoration"] = 'none';
         }

      
			
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array( 'jquery' ), '4.0.6', true );
			wp_enqueue_script( 'skyrocket-custom-controls-js', TS_JS . '/customizer_repeater.js', array( 'skyrocket-select2-js' ), '1.0', true );
			wp_enqueue_style( 'customizer-control', TS_CSS . '/customizer.css', array(), '1.1', 'all' );
			wp_enqueue_style( 'skyrocket-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', array(), '4.0.6', 'all' );
		}
		/**
		 * Export our List of Google Fonts to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['skyrocketfontslist'] = $this->fontList;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
   
			$fontCounter = 0;
			$isFontInList = false;
			$fontListStr = '';
			if( !empty($this->fontList) ) {
				?>
				<div class="google_fonts_select_control">
					<?php if( !empty( $this->label ) ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php } ?>
					<?php if( !empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php } ?>
					<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php $this->link(); ?> />
					<div class="google-fonts">
						<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
							<?php
								foreach( $this->fontList as $key => $value ) {
                        
									$fontCounter++;
									$fontListStr .= '<option value="' . $value->family . '" ' . selected( $this->fontValues["font-family"], $value->family, false ) . '>' . $value->family . '</option>';
									if ( $this->fontValues["font-family"] === $value->family ) {
										$isFontInList = true;
									}
									if ( is_int( $this->fontCount ) && $fontCounter === $this->fontCount ) {
										break;
									}
								}
								if ( !$isFontInList && $this->fontListIndex ) {
									// If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
									$fontListStr = '<option value="' . $this->fontList[$this->fontListIndex]->family . '" ' . selected( $this->fontValues["font-family"], $this->fontList[$this->fontListIndex]->family, false ) . '>' . $this->fontList[$this->fontListIndex]->family . ' (default)</option>' . $fontListStr;
								}
								// Display our list of font options
								echo $fontListStr;
							?>
						</select>
					</div>
					<div class="customize-control-description">Select weight &amp; style for regular text</div>
					<div class="weight-style">
						<select class="google-fonts-regularweight-style">
							<?php
								foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
									echo '<option value="' . $value . '" ' . selected( $this->fontValues["font-weight"], $value, false ) . '>' . $value . '</option>';
								}
							?>
						</select>
					</div>
               <div class="customize-control-font-size"><?php echo esc_html__("Select font size","TS"); ?></div>
               <input class="range-slider custom_group_typhography_range_font_size" type="range" min="0" max="100"  value="<?php echo (float)$this->fontValues["font-size"]; ?>">
               <input type="text" value=" <?php echo esc_html(trim($this->fontValues["font-size"])) ; ?> " class="google-fonts-size-style" /> 
             
               <div class="customize-control-line-height"><?php echo esc_html__("Select line height","TS"); ?> </div>
            
               <input class="range-slider custom_group_typhography_line_height" type="range" min="0" max="100"  value="<?php echo (float)$this->fontValues["line-height"]; ?>">
               <input type="text" value=" <?php echo esc_html(trim($this->fontValues["line-height"])); ?> " class="google-fonts-lineheight-style custom_font_line_height" /> 

               <div class="customize-control-letter-space"><?php echo esc_html__("Select letter spacing","TS"); ?></div>
               <input class="range-slider custom_group_typhography_letterspace" type="range" min="0" max="100"  value="<?php echo (float)$this->fontValues["letter-spacing"]; ?>">
				   <input type="text" value="<?php echo esc_html(trim( $this->fontValues["letter-spacing"]) ); ?>" class="google-fonts-letterspace" /> 

               <div class="customize-control-transform"><?php echo esc_html__("Select transform","TS"); ?></div>
				   <select class="google-fonts-trasnform">  
                  <option <?php echo selected( $this->fontValues["trasnform"], "lowercase", false ); ?> value="lowercase"> <?php echo esc_html__("lowercase","TS"); ?> </option> 
                  <option <?php echo selected( $this->fontValues["trasnform"], "uppercase", false ); ?> value="uppercase"> <?php echo esc_html__("uppercase","TS"); ?> </option> 
                  <option <?php echo selected( $this->fontValues["trasnform"], "capitalize", false ); ?> value="capitalize"> <?php echo esc_html__("capitalize","TS"); ?> </option> 
                  <option <?php echo selected( $this->fontValues["trasnform"], "none", false ); ?> value="none"> <?php echo esc_html__("none","TS"); ?> </option> 
              </select>  
              <div class="customize-control-decoration">Select decoration</div>
              <select class="google-fonts-decoration">  
                  <option <?php echo selected( $this->fontValues["text-decoration"], "underline", false ); ?> value="underline"> <?php echo esc_html__("underline","TS"); ?> </option> 
                  <option <?php echo selected( $this->fontValues["text-decoration"], "overline", false ); ?> value="overline"> <?php echo esc_html__("overline","TS"); ?> </option> 
                  <option <?php echo selected( $this->fontValues["text-decoration"], "line-through", false ); ?> value="line-through"> <?php echo esc_html__("line-through","TS"); ?> </option> 
                  <option <?php echo selected( $this->fontValues["text-decoration"], "blink", false ); ?> value="blink"> <?php echo esc_html__("blink","TS"); ?> </option> 
                  <option <?php echo selected( $this->fontValues["text-decoration"], "none", false ); ?> value="none"> <?php echo esc_html__("none","TS"); ?> </option> 
              </select>  
				</div>
				<?php
			}
		}
		/**
		 * Find the index of the saved font in our multidimensional array of Google Fonts
		 */
		public function skyrocket_getFontIndex( $haystack, $needle ) {
			foreach( $haystack as $key => $value ) {
				if( $value->family == $needle ) {
					return $key;
				}
			}
			return false;
		}
		/**
		 * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
		 */
		public function customizer_getGoogleFonts( $count = 30 ) {
		   $google_api= "https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyAP_KwRh1HX7tNAbLDSGhZ8K4tfu4MW4kA";
			
         $request = wp_remote_get( $google_api );

         if( is_wp_error( $request ) ) {
				return "";
			}
			$body = wp_remote_retrieve_body( $request );
			$content = json_decode( $body );
			if( $count == 'all' ) {
				return $content->items;
			} else {
				return array_slice( $content->items, 0, $count );
			}
		}
	}



endif;