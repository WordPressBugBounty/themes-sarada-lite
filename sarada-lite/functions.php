<?php
/**
 * Sarada Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sarada_Lite
 */

$sarada_lite_theme_data = wp_get_theme();
if( ! defined( 'SARADA_LITE_THEME_VERSION' ) ) define( 'SARADA_LITE_THEME_VERSION', $sarada_lite_theme_data->get( 'Version' ) );
if( ! defined( 'SARADA_LITE_THEME_NAME' ) ) define( 'SARADA_LITE_THEME_NAME', $sarada_lite_theme_data->get( 'Name' ) );
if( ! defined( 'SARADA_LITE_THEME_TEXTDOMAIN' ) ) define( 'SARADA_LITE_THEME_TEXTDOMAIN', $sarada_lite_theme_data->get( 'TextDomain' ) );   
/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Fontawesome
 */
require get_template_directory() . '/inc/fontawesome.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Typography Functions
 */
require get_template_directory() . '/inc/typography.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Dashboard
*/
require get_template_directory() . '/inc/dashboard/dashboard.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( sarada_lite_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}

/**
 * Toolkit Filters
*/
if( sarada_lite_is_bttk_activated() ) {
	require get_template_directory() . '/inc/toolkit-functions.php';
}

/**
 * Newsletter Filters
*/
if( sarada_lite_is_btnw_activated() ) {
	require get_template_directory() . '/inc/newsletter-functions.php';
}

/**
 * Elementor Functions.
 */
if( sarada_lite_is_elementor_activated() ){
	require get_template_directory() . '/inc/elementor-compatibility.php';
}

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';