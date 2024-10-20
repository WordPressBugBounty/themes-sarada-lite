<?php
/**
 * Blossomthemes Email Newsletter Filters
 *
 * @package Sarada_Lite
 */

if( ! function_exists( 'sarada_lite_add_inner_div' ) ) :
    function sarada_lite_add_inner_div(){
        return true;
    }
endif;
add_filter( 'bt_newsletter_shortcode_inner_wrap_display', 'sarada_lite_add_inner_div' );

if( ! function_exists( 'sarada_lite_start_inner_div' ) ) :
    function sarada_lite_start_inner_div(){
        echo '<div class="container">';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_start', 'sarada_lite_start_inner_div' );

if( ! function_exists( 'sarada_lite_end_inner_div' ) ) :
    function sarada_lite_end_inner_div(){
        echo '</div>';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_close', 'sarada_lite_end_inner_div' );