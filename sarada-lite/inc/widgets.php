<?php
/**
 * Sarada Lite Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Sarada_Lite
 */

function sarada_lite_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'sarada-lite' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'sarada-lite' ),
        ),
        'featured'   => array(
            'name'        => __( 'Featured Area Section', 'sarada-lite' ),
            'id'          => 'featured', 
            'description' => __( 'Add "Text" & "Blossom: Image Text" widget for featured area section.', 'sarada-lite' ),
        ),
        'about'   => array(
            'name'        => __( 'About Section', 'sarada-lite' ),
            'id'          => 'about', 
            'description' => __( 'Add "Blossom: Featured Page Widget" for about section.', 'sarada-lite' ),
        ),
        'shop-section'   => array(
            'name'        => __( 'Shop Section', 'sarada-lite' ),
            'id'          => 'shop-section', 
            'description' => __( 'Add "Custom HTML" or "Products" for shop section.', 'sarada-lite' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'sarada-lite' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'sarada-lite' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'sarada-lite' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'sarada-lite' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'sarada-lite' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'sarada-lite' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'sarada-lite' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'sarada-lite' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
    
}
add_action( 'widgets_init', 'sarada_lite_widgets_init' );