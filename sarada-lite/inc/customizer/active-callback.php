<?php
/**
 * Active Callback
 * 
 * @package Sarada_Lite
*/

/**
 * Active Callback for Notification Bar.
*/
function sarada_lite_notification( $control ){
    
    $ed_notification_bar    = $control->manager->get_setting( 'notification_bar_area' )->value();
    $control_id    = $control->id;

    if ( $control_id == 'notification_bar_newsletter' && $ed_notification_bar ) return true;
    if ( $control_id == 'header_newsletter_note' && $ed_notification_bar ) return true;

    return false;
}

if( ! function_exists( 'sarada_lite_banner_ac') ) :
/**
 * Active Callback for Banner Slider
*/
function sarada_lite_banner_ac( $control ){
    $banner        = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type   = $control->manager->get_setting( 'slider_type' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_label_two' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_two' && $banner == 'static_banner' ) return true;
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_speed' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;          
    if ( $control_id == 'slider_readmore' && $banner == 'slider_banner' ) return true;    
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'banner_hr' && $banner == 'slider_banner' ) return true;
    
    return false;
}
endif;

/**
 * Active Callback for post/page
*/
function sarada_lite_post_page_ac( $control ){
    
    $ed_related    = $control->manager->get_setting( 'ed_related' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'related_post_title' && $ed_related == true ) return true;
    
    return false;
}

/**
 * Active Callback for comment toggle.
*/
function sarada_lite_comments_toggle( $control ){
    
    $comment_toggle = $control->manager->get_setting( 'ed_comments' )->value();
    
    if ( $comment_toggle == true ) return true;
    
    return false;
}

/**
 * Active Callback for local fonts
*/
function sarada_lite_ed_localgoogle_fonts(){
    $ed_localgoogle_fonts = get_theme_mod( 'ed_localgoogle_fonts' , false );

    if( $ed_localgoogle_fonts ) return true;
    
    return false; 
}

/**
 * Active Callback for Instagram.
*/
function sarada_lite_ed_instagram(){
    
    $ed_instagram = get_theme_mod( 'ed_instagram', false );

    if ( $ed_instagram ) return true;

    return false;
}