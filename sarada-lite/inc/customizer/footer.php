<?php
/**
 * Footer Setting
 *
 * @package Sarada_Lite
 */

function sarada_lite_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'sarada-lite' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );

    $wp_customize->add_setting( 'footer_bg',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/footer-bg.jpg' ),
            'sanitize_callback' => 'sarada_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'footer_bg',
            array(
                'label'         => esc_html__( 'Footer Background Image', 'sarada-lite' ),
                'description'   => esc_html__( 'Choose background Image of your choice.', 'sarada-lite' ),
                'section'       => 'footer_settings',
                'type'          => 'image',
            )
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => __( 'Footer Copyright Text', 'sarada-lite' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.site-info .copyright',
        'render_callback' => 'sarada_lite_get_footer_copyright',
    ) );
        
}
add_action( 'customize_register', 'sarada_lite_customize_register_footer' );