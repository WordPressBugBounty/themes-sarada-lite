<?php
/**
 * Site Title Setting
 *
 * @package Sarada_Lite
 */

function sarada_lite_customize_register( $wp_customize ) {
	
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
	
	if( isset( $wp_customize->selective_refresh ) ){
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'sarada_lite_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'sarada_lite_customize_partial_blogdescription',
		) );
	}
    
    /** Site Logo Size */
    $wp_customize->add_setting(
        'site_logo_size',
        array(
            'default' => 250, 
            'sanitize_callback' => 'sarada_lite_sanitize_number_absint',
        )
    );

    $wp_customize->add_control(
        'site_logo_size',
        array(
            'type' => 'number',
            'section' => 'title_tagline', 
            'label' => __( 'Set the width(px) of your Site Logo', 'sarada-lite' ),
        )
    );

    /** Site Title Font */
    $wp_customize->add_setting( 
        'site_title_font', 
        array(
            'default' => array(                                         
                'font-family' => 'Caveat',
                'variant'     => '700',
            ),
            'sanitize_callback' => array( 'Sarada_Lite_Fonts', 'sanitize_typography' )
        ) 
    );

    $wp_customize->add_control( 
        new Sarada_Lite_Typography_Control( 
            $wp_customize, 
            'site_title_font', 
            array(
                'label'       => __( 'Site Title Font', 'sarada-lite' ),
                'description' => __( 'Site title and tagline font.', 'sarada-lite' ),
                'section'     => 'title_tagline',
                'priority'    => 60, 
            ) 
        ) 
    );
    
    /** Site Title Font Size*/
    $wp_customize->add_setting( 
        'site_title_font_size', 
        array(
            'default'           => 36,
            'sanitize_callback' => 'sarada_lite_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Slider_Control( 
            $wp_customize,
            'site_title_font_size',
            array(
                'section'     => 'title_tagline',
                'label'       => __( 'Site Title Font Size', 'sarada-lite' ),
                'description' => __( 'Change the font size of your site title.', 'sarada-lite' ),
                'priority'    => 65,
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 200,
                    'step'  => 1,
                )                 
            )
        )
    );
    
    /** Site Title Color*/
    $wp_customize->add_setting( 
        'site_title_color', 
        array(
            'default'           => '#111111',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'site_title_color', 
            array(
                'label'       => __( 'Site Title Color', 'sarada-lite' ),
                'description' => __( 'Site Title color of the theme.', 'sarada-lite' ),
                'section'     => 'title_tagline',
                'priority'    => 66,
            )
        )
    );

    
}
add_action( 'customize_register', 'sarada_lite_customize_register' );