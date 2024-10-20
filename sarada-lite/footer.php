<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sarada_Lite
 */
    
    /**
     * After Content
     * 
     * @hooked sarada_lite_content_end - 20
    */
    do_action( 'sarada_lite_before_footer' );
    
    /**
     * Before Footer
     * 
     * @hooked sarada_lite_shop_section          - 10
     * @hooked sarada_lite_newsletter_section    - 30
    */
    do_action( 'sarada_lite_before_footer_start' );

    /**
     * Footer
     * 
     * @hooked sarada_lite_footer_start  - 20
     * @hooked sarada_lite_footer_top    - 30
     * @hooked sarada_lite_footer_mid    - 40
     * @hooked sarada_lite_footer_bottom - 50
     * @hooked sarada_lite_footer_end    - 60
    */
    do_action( 'sarada_lite_footer' );
    
    /**
     * After Footer
     * 
     * @hooked sarada_lite_page_end    - 20
    */
    do_action( 'sarada_lite_after_footer' );

    wp_footer(); ?>

</body>
</html>
