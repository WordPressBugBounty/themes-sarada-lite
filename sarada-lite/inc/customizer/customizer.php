<?php
/**
 * Sarada Lite Theme Customizer
 *
 * @package Sarada_Lite
 */

/**
 * Requiring customizer panels & sections
*/
$sarada_lite_panels     = array( 'info', 'site', 'layout', 'appearance', 'general', 'footer' );

foreach( $sarada_lite_panels as $p ){
   require get_template_directory() . '/inc/customizer/' . $p . '.php';
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sarada_lite_customize_preview_js() {
	wp_enqueue_script( 'sarada-lite-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), SARADA_LITE_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'sarada_lite_customize_preview_js' );

function sarada_lite_customize_script(){
	$array = array(
        'flushFonts'        => wp_create_nonce( 'sarada-lite-local-fonts-flush' ),
    );
    
    wp_enqueue_style( 'sarada-lite-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), SARADA_LITE_THEME_VERSION );
    wp_enqueue_script( 'sarada-lite-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), SARADA_LITE_THEME_VERSION, true );

	wp_localize_script( 'sarada-lite-customize', 'sarada_lite_cdata', $array );

    wp_localize_script( 'sarada-lite-repeater', 'sarada_lite_customize',
		array(
			'nonce' => wp_create_nonce( 'sarada_lite_customize_nonce' )
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'sarada_lite_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';

$config_customizer = array(
	'recommended_plugins' => array(
		//change the slug for respective plugin recomendation
        'blossomthemes-toolkit' => array(
			'recommended' => true,
			'description' => sprintf(
				/* translators: %s: plugin name */
				esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'sarada-lite' ), '<strong>BlossomThemes Toolkit</strong>'
			),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'sarada-lite' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'sarada-lite' ),
	'activate_button_label'     => esc_html__( 'Activate', 'sarada-lite' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'sarada-lite' ),
);
Sarada_Lite_Customizer_Notice::init( apply_filters( 'sarada_lite_customizer_notice_array', $config_customizer ) );

/**
 * Reset font folder
 *
 * @access public
 * @return void
 */
function sarada_lite_ajax_delete_fonts_folder() {
	// Check request.
	if ( ! check_ajax_referer( 'sarada-lite-local-fonts-flush', 'nonce', false ) ) {
		wp_send_json_error( 'invalid_nonce' );
	}
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( 'invalid_permissions' );
	}
	if ( class_exists( '\Sarada_Lite_WebFont_Loader' ) ) {
		$font_loader = new \Sarada_Lite_WebFont_Loader( '' );
		$removed = $font_loader->delete_fonts_folder();
		if ( ! $removed ) {
			wp_send_json_error( 'failed_to_flush' );
		}
		wp_send_json_success();
	}
	wp_send_json_error( 'no_font_loader' );
}
add_action( 'wp_ajax_sarada_lite_flush_fonts_folder', 'sarada_lite_ajax_delete_fonts_folder' );