<?php
/**
 * Customizer specific functions
 *
 * @package Cerebro
 */

/**
 * Generate divider to use in Customizer page
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	class WP_Customize_Divider_Control extends WP_Customize_Control {
		public $type = 'divider';

		public function render_content() {
			?>
			<div class="customizer-divider"></div>
			<?php
		}
	}

endif;
