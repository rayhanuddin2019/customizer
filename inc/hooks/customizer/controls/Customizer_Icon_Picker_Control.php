<?php
if( class_exists( 'WP_Customize_Control' ) ):
/**
 * Icon Picker Customizer Control - O2 Customizer Library
 *
 * This control adds an icon picker which allows you to easily pick
 * icons from Font Awesome, Genericons and Dashicons.
 *
 * Icon Picker is a part of O2 library, which is a
 * free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this library. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package O2 Customizer Library
 * @subpackage Icon Picker
 * @since 0.1
 */

	class Customizer_Icon_Picker_Control extends WP_Customize_Control {

		public $type = 'o2-icon-picker';

		public $iconset = array();

		public function to_json() {
			if ( empty( $this->iconset ) ) {
				$this->iconset = 'fa';
			}
			$iconset               = $this->iconset;
			$this->json['iconset'] = $iconset;
			parent::to_json();
		}

		public function enqueue() {
			wp_enqueue_script( 'o2-icon-picker-ddslick-min', TS_JS . '/icon-picker/assets/js/jquery.ddslick.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'o2-icon-picker-control', TS_JS . '/icon-picker/assets/js/icon-picker-control.js', array( 'jquery', 'o2-icon-picker-ddslick-min' ), '', true );
			if ( in_array( $this->iconset, array( 'genericon', 'genericons' ) ) ) {
				wp_enqueue_style( 'genericons', TS_CSS . '/assets/genericons/genericons.css' );
			} elseif ( in_array( $this->iconset, array( 'dashicon', 'dashicons' ) ) ) {
				wp_enqueue_style( 'dashicons' );
			} else {
				wp_enqueue_style( 'font-awesome', TS_CSS . '/assets/font-awesome/css/font-awesome.min.css' );
			}
		}

		public function render_content() {
			if ( empty( $this->choices ) ) {
				if ( in_array( $this->iconset, array( 'genericon', 'genericons' ) ) ) {
					require_once TS_INC . '/hooks/customizer/inc/genericons-icons.php';
					$this->choices = o2_genericons_list();
				} elseif ( in_array( $this->iconset, array( 'dashicon', 'dashicons' ) ) ) {
					require_once TS_INC . '/hooks/customizer/inc/dashicons-icons.php';
					$this->choices = o2_dashicons_list();
				} else {
					require_once TS_INC . '/hooks/customizer/inc/fa-icons.php';
					$this->choices = o2_font_awesome_list();
				}
			}
		?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
            
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<select class="o2-icon-picker-icon-control" id="<?php echo esc_attr( $this->id ); ?>">
					<?php foreach ( $this->choices as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php echo selected( $this->value(), $value, false ); ?> data-iconsrc="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		<?php }

	}

endif;
