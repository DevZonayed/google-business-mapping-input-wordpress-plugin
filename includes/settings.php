<?php
function business_profile_autocomplete_plugin_settings_page() {
	add_options_page(
		'business_profile_autocomplete Plugin Settings',
		'business_profile_autocomplete Plugin',
		'manage_options',
		'business_profile_autocomplete-plugin-settings',
		'business_profile_autocomplete_plugin_render_settings_page'
	);
}
add_action( 'admin_menu', 'business_profile_autocomplete_plugin_settings_page' );

function business_profile_autocomplete_plugin_render_settings_page() {
	?>
	<div class="wrap">
		<h1>business_profile_autocomplete Plugin Settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'business_profile_autocomplete-plugin-settings' );
			do_settings_sections( 'business_profile_autocomplete-plugin-settings' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

// Register settings and fields
function business_profile_autocomplete_plugin_register_settings() {
	register_setting(
		'business_profile_autocomplete-plugin-settings',
		'business_profile_autocomplete_plugin_api_key'
	);

	add_settings_section(
		'business_profile_autocomplete-plugin-section',
		'API Key',
		'business_profile_autocomplete_plugin_section_callback',
		'business_profile_autocomplete-plugin-settings'
	);

	add_settings_field(
		'business_profile_autocomplete-plugin-api-key-field',
		'API Key',
		'business_profile_autocomplete_plugin_api_key_field_callback',
		'business_profile_autocomplete-plugin-settings',
		'business_profile_autocomplete-plugin-section'
	);
}
add_action( 'admin_init', 'business_profile_autocomplete_plugin_register_settings' );

// Section callback
function business_profile_autocomplete_plugin_section_callback() {
	echo 'Enter your Google Maps API Key:';
}

// API key field callback
function business_profile_autocomplete_plugin_api_key_field_callback() {
	$api_key = get_option( 'business_profile_autocomplete_plugin_api_key' );
	?>
	<input type="text" name="business_profile_autocomplete_plugin_api_key" value="<?php echo esc_attr( $api_key ); ?>"
		class="regular-text">
	<?php
}

// Enqueue scripts
function business_profile_autocomplete_enqueue_scripts() {
	$api_key = get_option( 'business_profile_autocomplete_plugin_api_key' );
	wp_register_script(
		'google-maps',
		'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places',
		array(),
		'1.0',
		true
	);

	wp_enqueue_script( 'google-maps' );

	wp_enqueue_script(
		'business_profile_autocomplete-script',
		plugin_dir_url( __FILE__ ) . '../js/business-profile-autocomplete.js',
		array( 'jquery' ),
		'1.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'business_profile_autocomplete_enqueue_scripts' );