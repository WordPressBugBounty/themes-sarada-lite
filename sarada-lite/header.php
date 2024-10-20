<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sarada_Lite
 */
    /**
     * Doctype Hook
     * 
     * @hooked sarada_lite_doctype
    */
    do_action( 'sarada_lite_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked sarada_lite_head
    */
    do_action( 'sarada_lite_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked sarada_lite_page_start - 20 
    */
    do_action( 'sarada_lite_before_header' );
    
    /**
     * Header
     * 
     * @hooked sarada_lite_notification_bar - 10
     * @hooked sarada_lite_header           - 25     
    */
    do_action( 'sarada_lite_header' );
    
    /**
     * Before Content
     * 
     * @hooked sarada_lite_banner             - 15
     * @hooked sarada_lite_featured_area      - 20
     * @hooked sarada_lite_about_section      - 25
    */
    do_action( 'sarada_lite_after_header' );
    
    /**
     * Content
     * 
     * @hooked sarada_lite_content_start
    */
    do_action( 'sarada_lite_content' );