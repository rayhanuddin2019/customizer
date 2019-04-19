<?php 
if( class_exists( 'WP_Customize_Control' ) ):
class Customizer_Box_Model extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'box_model';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
         wp_enqueue_script( 'customizer-control', TS_JS . '/custom-customizer.js', array( 'jquery' ), TS_VERSION, true );
         wp_enqueue_style( 'customizer-control', TS_CSS . '/customizer.css', null, TS_VERSION );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
			<p class="description customize-control-description"><?php echo esc_html( $this->description ); ?></p>
			<?php endif;
			$saved_values = ( ! is_array( $this->value() ) && ! empty( $this->value() ) ) ? explode( ', ', $this->value() ) : explode( ', ', '\'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\'' ); ?>
			<div class="box-model-wrapper">
			<?php
			foreach ( $this->choices as $key => $value ) {
				if ( 'margin' === $key ) { ?>
				<div class="box-model-margin">
					<span><?php esc_html_e( 'Margin', 'TS' ); ?></span>
					<?php
					$margin_count = 0;
					foreach ( $value as $m_key => $m_value ) {
						echo '<input onkeyup="ts_custom_box_model_change()" type="number" placeholder="-" value="' . esc_attr( $saved_values[ $margin_count ] ) . '" class="box-model-field ' . esc_html( $m_key ) . '">';
						$margin_count++;
					} ?>
				</div><?php
				}
				if ( 'padding' === $key ) { ?>
				<div class="box-model-padding">
					<span><?php esc_html_e( 'Padding', 'TS' ); ?></span>
					<?php
					$padding_count = 4; // margin takes array keys 0-3, padding 4-7.
					foreach ( $value as $p_key => $p_value ) {
						echo '<input onkeyup="ts_custom_box_model_change()"  type="number" placeholder="-" value="' . esc_attr( $saved_values[ $padding_count ] ) . '" class="box-model-field ' . esc_html( $p_key ) . '">';
						$padding_count++;
					} ?>
				</div><?php
				}
			} ?>
				<div class="box-model-content">
					<span><?php esc_html_e( 'Content', 'TS' ); ?></span>
				</div>
				<input type="hidden" class="box-model-saved" <?php $this->link(); ?> value="<?php echo esc_attr( $saved_values ); ?>" />
			</div>
			<?php
		}
   }
   
endif;