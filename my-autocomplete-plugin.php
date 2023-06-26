<?php
/*
Plugin Name: google business mapping input
Description: Implements Google Maps Places business_profile_autocomplete functionality.
Version: 1.0
Author: Zonayed Ahamad
Author URI: https://github.com/DevZonayed/google-business-mapping-input-wordpress-plugin
*/


require_once plugin_dir_path( __FILE__ ) . 'includes/settings.php';


register_activation_hook( __FILE__, 'business_profile_autocomplete_plugin_activate' );

register_deactivation_hook( __FILE__, 'business_profile_autocomplete_plugin_deactivate' );

add_shortcode( 'gBusinessProfileInput', 'business_profile_autocomplete_shortcode' );

function business_profile_autocomplete_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'name' => '',
		'class' => ''
	), $atts );

	ob_start();
	?>
	<input type="text" class="<?php echo esc_attr( $atts['class'] ); ?>" id="businessInput"
		placeholder="Enter a business name" name="<?php echo esc_attr( $atts['name'] ); ?>" value="">
	<?php
	return ob_get_clean();
}

function business_profile_autocomplete_plugin_activate() {

}

// Deactivation hook callback
function business_profile_autocomplete_plugin_deactivate() {
}