<?php
/**
 * Sarada Lite Appearance Settings
 *
 * @package Sarada_Lite
 */

function sarada_lite_customize_register_appearance( $wp_customize ) {
    
    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'sarada-lite' ),
            'description' => __( 'Customize Typography, Background Image & Color.', 'sarada-lite' ),
        ) 
    );
    
    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', 
        array(
            'default'           => '#e1bdbd',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'sarada-lite' ),
                'description' => __( 'Primary color of the theme.', 'sarada-lite' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    /** Primary Color*/
    $wp_customize->add_setting( 
        'secondary_color', 
        array(
            'default'           => '#fdf2ed',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'secondary_color', 
            array(
                'label'       => __( 'Secondary Color', 'sarada-lite' ),
                'description' => __( 'Secondary color of the theme.', 'sarada-lite' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );
    
    /** Background Color*/
    $wp_customize->get_control( 'background_color' )->description = __( 'Background color of the theme.', 'sarada-lite' );

    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'sarada-lite' ),
            'priority' => 20,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Esteban',
			'sanitize_callback' => 'sarada_lite_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Sarada_Lite_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'sarada-lite' ),
                'description' => __( 'Primary font of the site.', 'sarada-lite' ),
    			'section'     => 'typography_settings',
    			'choices'     => sarada_lite_get_all_fonts(),	
     		)
		)
	);

    /** Font Size*/
    $wp_customize->add_setting( 
        'font_size', 
        array(
            'default'           => 18,
            'sanitize_callback' => 'sarada_lite_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Slider_Control( 
            $wp_customize,
            'font_size',
            array(
                'section'     => 'typography_settings',
                'label'       => __( 'Font Size', 'sarada-lite' ),
                'description' => __( 'Change the font size of your site.', 'sarada-lite' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 50,
                    'step'  => 1,
                )                 
            )
        )
    );
    
    
    /** Secondary Font */
    $wp_customize->add_setting(
		'secondary_font',
		array(
			'default'			=> 'Caveat',
			'sanitize_callback' => 'sarada_lite_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Sarada_Lite_Select_Control(
    		$wp_customize,
    		'secondary_font',
    		array(
                'label'	      => __( 'Secondary Font', 'sarada-lite' ),
                'description' => __( 'Secondary font of the site.', 'sarada-lite' ),
    			'section'     => 'typography_settings',
    			'choices'     => sarada_lite_get_all_fonts(),	
     		)
		)
	);

    /** Font Size*/
    $wp_customize->add_setting( 
        'secondary_font_size', 
        array(
            'default'           => 18,
            'sanitize_callback' => 'sarada_lite_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Slider_Control( 
            $wp_customize,
            'secondary_font_size',
            array(
                'section'     => 'typography_settings',
                'label'       => __( 'Secondary Font Size', 'sarada-lite' ),
                'description' => __( 'Change the font size of your site.', 'sarada-lite' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 50,
                    'step'  => 1,
                )                 
            )
        )
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_localgoogle_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Load Google Fonts Locally', 'sarada-lite' ),
                'description'   => __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies.', 'sarada-lite' )
            )
        )
    );   

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_preload_local_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Preload Local Fonts', 'sarada-lite' ),
                'description'   => __( 'Preloading Google fonts will speed up your website speed.', 'sarada-lite' ),
                'active_callback' => 'sarada_lite_ed_localgoogle_fonts'
            )
        )
    );   

    ob_start(); ?>
        
        <span style="margin-bottom: 5px;display: block;"><?php esc_html_e( 'Click the button to reset the local fonts cache', 'sarada-lite' ); ?></span>
        
        <input type="button" class="button button-primary sarada-lite-flush-local-fonts-button" name="sarada-lite-flush-local-fonts-button" value="<?php esc_attr_e( 'Flush Local Font Files', 'sarada-lite' ); ?>" />
    <?php
    $sarada_lite_flush_button = ob_get_clean();

    $wp_customize->add_setting(
        'ed_flush_local_fonts',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'ed_flush_local_fonts',
        array(
            'label'         => __( 'Flush Local Fonts Cache', 'sarada-lite' ),
            'section'       => 'typography_settings',
            'description'   => $sarada_lite_flush_button,
            'type'          => 'hidden',
            'active_callback' => 'sarada_lite_ed_localgoogle_fonts'
        )
    );
    
    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel              = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority           = 10;
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 15;
    
}
add_action( 'customize_register', 'sarada_lite_customize_register_appearance' );