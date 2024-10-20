<?php
/**
 * Sarada Lite Customizer Partials
 *
 * @package Sarada_Lite
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sarada_lite_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sarada_lite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'sarada_lite_get_banner_title' ) ) :
/**
 * Banner Title
*/
function sarada_lite_get_banner_title(){
    return esc_html( get_theme_mod( 'banner_title', __( 'Find Your Best Holiday', 'sarada-lite' ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_banner_subtitle' ) ) :
/**
 * Banner SubTitle
*/
function sarada_lite_get_banner_subtitle(){
    return esc_html( get_theme_mod( 'banner_subtitle', __( 'Find great adventure holidays and activities around the planet.', 'sarada-lite' ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_banner_label' ) ) :
/**
 * Banner Label
*/
function sarada_lite_get_banner_label(){
    return esc_html( get_theme_mod( 'banner_label', __( 'Explore', 'sarada-lite' ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_banner_label_two' ) ) :
/**
 * Banner Label
*/
function sarada_lite_get_banner_label_two(){
    return esc_html( get_theme_mod( 'banner_label_two', __( 'Learn More', 'sarada-lite' ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_slider_readmore' ) ) :
/**
 * Slider Read More
*/
function sarada_lite_get_slider_readmore(){
    return esc_html( get_theme_mod( 'slider_readmore', __( 'READ the ARTICLE', 'sarada-lite' ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_read_more' ) ) :
/**
 * Display blog readmore button
*/
function sarada_lite_get_read_more(){
    return esc_html( get_theme_mod( 'read_more_text', __( 'READ the ARTICLE', 'sarada-lite' ) ) );    
}
endif;

if( ! function_exists( 'sarada_lite_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function sarada_lite_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You may also like', 'sarada-lite' ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_blog_text' ) ) :
/**
 * Blog Title
*/
function sarada_lite_get_blog_text(){
    return esc_html( get_theme_mod( 'blog_text' ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_blog_content' ) ) :
/**
 * Blog SubTitle
*/
function sarada_lite_get_blog_content(){
    return esc_html( get_theme_mod( 'blog_content' ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_trending_title' ) ) :
/**
 * Trending Title
*/
function sarada_lite_get_trending_title(){
    return esc_html( get_theme_mod( 'trending_title', __( 'Trending Now', 'sarada-lite' ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_trending_subtitle' ) ) :
/**
 * Trending SubTitle
*/
function sarada_lite_get_trending_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'trending_subtitle', __( 'Articles that are loved by Fellow Fashion Enthusiast in community.', 'sarada-lite' ) ) ) );
}
endif;

if( ! function_exists( 'sarada_lite_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function sarada_lite_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'sarada-lite' );
        echo date_i18n( esc_html__( 'Y', 'sarada-lite' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'sarada-lite' );
    }
    echo '</span>'; 
}
endif;