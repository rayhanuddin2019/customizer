<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */
 if( class_exists( 'WP_Customize_Control' ) ):
class Customizer_Custom_Typography_Control extends WP_Customize_Control {

/**
		 * The type of control being rendered
		 */
		public $type = 'custom-typography';
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

endif;