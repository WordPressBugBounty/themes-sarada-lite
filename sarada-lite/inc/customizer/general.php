<?php
/**
 * General Settings
 *
 * @package Sarada_Lite
 */

function sarada_lite_customize_register_general( $wp_customize ){
    
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'sarada-lite' ),
            'description' => __( 'Customize Banner, Featured, Social, Sharing, SEO, Post/Page, Newsletter & Instagram, Shop, Performance and Miscellaneous settings.', 'sarada-lite' ),
        ) 
    );

    /** Notification Bar Settings */
    $wp_customize->add_section(
        'notification_bar_settings',
        array(
            'title'    => __( 'Notification Bar Settings', 'sarada-lite' ),
            'priority' => 5,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Notification Bar */
    $wp_customize->add_setting( 
        'notification_bar_area', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'notification_bar_area',
            array(
                'section'        => 'notification_bar_settings',
                'label'          => __( 'Enable Notification Bar', 'sarada-lite' ),
                'description'    => __( 'Enable to show Notification bar on top of header.', 'sarada-lite' ),
            )
        )
    );

    /** Notification Bar Newsletter Shortcode */
    if ( sarada_lite_is_btnw_activated() ) {
        $wp_customize->add_setting(
            'notification_bar_newsletter',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field' 
            )
        );
        
        $wp_customize->add_control(
            'notification_bar_newsletter',
            array(
                'type'            => 'text',
                'section'         => 'notification_bar_settings',
                'label'           => __( 'Header Newsletter Shortcode', 'sarada-lite' ),
                'description'     => __( 'Enter the shortcode here.', 'sarada-lite' ),
                'active_callback' => 'sarada_lite_notification',
            )
        );
    }else{
        $wp_customize->add_setting(
            'header_newsletter_note',
            array(
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            new Sarada_Lite_Plugin_Recommend_Control(
                $wp_customize,
                'header_newsletter_note',
                array(
                    'section' => 'notification_bar_settings',
                    'label' => __('Header Newsletter Shortcode', 'sarada-lite'),
                    'capability' => 'install_plugins',
                    'plugin_slug' => 'blossomthemes-email-newsletter',
                    'description' => sprintf(__('Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s.', 'sarada-lite'), '<strong>', '</strong>'),
                    'active_callback' => 'sarada_lite_notification',
                )
            )
        );
    }
    /** Notification Bar Settings Ends */

    /** Banner Settings Starts */
    
    $wp_customize->get_section( 'header_image' )->panel                    = 'general_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'sarada-lite' );
    $wp_customize->get_section( 'header_image' )->priority                 = 15;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'sarada_lite_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'sarada_lite_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'sarada_lite_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'slider_banner',
			'sanitize_callback' => 'sarada_lite_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Sarada_Lite_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'sarada-lite' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'sarada-lite' ),
    			'section'     => 'header_image',
    			'choices'     => array(
                    'no_banner'         => __( 'Disable Banner Section', 'sarada-lite' ),
                    'static_banner'     => __( 'Static/Video CTA Banner', 'sarada-lite' ),
                    'slider_banner'     => __( 'Banner as Slider', 'sarada-lite' ),
                ),
                'priority' => 5,	
     		)            
		)
	);

    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => __( 'Find Your Best Holiday', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Title', 'sarada-lite' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'sarada_lite_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector' => '.site-banner .banner-caption h2.banner-title',
        'render_callback' => 'sarada_lite_get_banner_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( 'Find great adventure holidays and activities around the planet.', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'           => __( 'Sub Title', 'sarada-lite' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'sarada_lite_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector' => '.site-banner .banner-caption .banner-desc',
        'render_callback' => 'sarada_lite_get_banner_subtitle',
    ) );
    
    /** Banner Label */
    $wp_customize->add_setting(
        'banner_label',
        array(
            'default'           => __( 'Explore', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_label',
        array(
            'label'           => __( 'Button One Label', 'sarada-lite' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'sarada_lite_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_label', array(
        'selector' => '.site-banner .banner-caption a.button-one',
        'render_callback' => 'sarada_lite_get_banner_label',
    ) );
    
    
    /** Banner Link */
    $wp_customize->add_setting(
        'banner_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_link',
        array(
            'label'           => __( 'Button One Link', 'sarada-lite' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'sarada_lite_banner_ac'
        )
    );

    /** Banner Label */
    $wp_customize->add_setting(
        'banner_label_two',
        array(
            'default'           => __( 'Learn More', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_label_two',
        array(
            'label'           => __( 'Button Two Label', 'sarada-lite' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'sarada_lite_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_label_two', array(
        'selector' => '.site-banner .banner-caption a.button-two',
        'render_callback' => 'sarada_lite_get_banner_label_two',
    ) );
    
    
    /** Banner Link */
    $wp_customize->add_setting(
        'banner_link_two',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_link_two',
        array(
            'label'           => __( 'Button Two Link', 'sarada-lite' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'sarada_lite_banner_ac'
        )
    );

    /** Slider Content Style */
    $wp_customize->add_setting(
		'slider_type',
		array(
			'default'			=> 'latest_posts',
			'sanitize_callback' => 'sarada_lite_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Sarada_Lite_Select_Control(
    		$wp_customize,
    		'slider_type',
    		array(
                'label'	  => __( 'Slider Content Style', 'sarada-lite' ),
    			'section' => 'header_image',
    			'choices' => array(
                    'latest_posts' => __( 'Latest Posts', 'sarada-lite' ),
                    'cat'          => __( 'Category', 'sarada-lite' ),
                ),
                'active_callback' => 'sarada_lite_banner_ac'	
     		)
		)
	);
    
    /** Slider Category */
    $wp_customize->add_setting(
		'slider_cat',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sarada_lite_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Sarada_Lite_Select_Control(
    		$wp_customize,
    		'slider_cat',
    		array(
                'label'	          => __( 'Slider Category', 'sarada-lite' ),
    			'section'         => 'header_image',
    			'choices'         => sarada_lite_get_categories(),
                'active_callback' => 'sarada_lite_banner_ac'	
     		)
		)
	);
    
    /** No. of slides */
    $wp_customize->add_setting(
        'no_of_slides',
        array(
            'default'           => 3,
            'sanitize_callback' => 'sarada_lite_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
		new Sarada_Lite_Slider_Control( 
			$wp_customize,
			'no_of_slides',
			array(
				'section'     => 'header_image',
                'label'       => __( 'Number of Slides', 'sarada-lite' ),
                'description' => __( 'Choose the number of slides you want to display', 'sarada-lite' ),
                'choices'	  => array(
					'min' 	=> 1,
					'max' 	=> 20,
					'step'	=> 1,
				),
                'active_callback' => 'sarada_lite_banner_ac'                 
			)
		)
	);
    
    /** HR */
    $wp_customize->add_setting(
        'banner_hr',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Note_Control( 
			$wp_customize,
			'banner_hr',
			array(
				'section'	  => 'header_image',
				'description' => '<hr/>',
                'active_callback' => 'sarada_lite_banner_ac'
			)
		)
    );

    /** Slider Auto */
    $wp_customize->add_setting(
        'slider_auto',
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'slider_auto',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Auto', 'sarada-lite' ),
                'description' => __( 'Enable slider auto transition.', 'sarada-lite' ),
                'active_callback' => 'sarada_lite_banner_ac'
            )
        )
    );
    
    /** Slider Loop */
    $wp_customize->add_setting(
        'slider_loop',
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Sarada_Lite_Toggle_Control( 
			$wp_customize,
			'slider_loop',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Loop', 'sarada-lite' ),
                'description' => __( 'Enable slider loop.', 'sarada-lite' ),
                'active_callback' => 'sarada_lite_banner_ac'
			)
		)
	);
    
    /** Slider Caption */
    $wp_customize->add_setting(
        'slider_caption',
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Sarada_Lite_Toggle_Control( 
			$wp_customize,
			'slider_caption',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Caption', 'sarada-lite' ),
                'description' => __( 'Enable slider caption.', 'sarada-lite' ),
                'active_callback' => 'sarada_lite_banner_ac'
			)
		)
	);
    
    /** Slider Animation */
    $wp_customize->add_setting(
		'slider_animation',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sarada_lite_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Sarada_Lite_Select_Control(
    		$wp_customize,
    		'slider_animation',
    		array(
                'label'	      => __( 'Slider Animation', 'sarada-lite' ),
                'section'     => 'header_image',
    			'choices'     => array(
                    'fadeOut'        => __( 'Fade Out', 'sarada-lite' ),
                    'fadeOutLeft'    => __( 'Fade Out Left', 'sarada-lite' ),
                    'fadeOutRight'   => __( 'Fade Out Right', 'sarada-lite' ),
                    'fadeOutUp'      => __( 'Fade Out Up', 'sarada-lite' ),
                    'fadeOutDown'    => __( 'Fade Out Down', 'sarada-lite' ),
                    ''               => __( 'Slide', 'sarada-lite' ),
                    'slideOutLeft'   => __( 'Slide Out Left', 'sarada-lite' ),
                    'slideOutRight'  => __( 'Slide Out Right', 'sarada-lite' ),
                    'slideOutUp'     => __( 'Slide Out Up', 'sarada-lite' ),
                    'slideOutDown'   => __( 'Slide Out Down', 'sarada-lite' ),                    
                ),
                'active_callback' => 'sarada_lite_banner_ac'                                	
     		)
		)
	);
    
    /** Read More Text */
    $wp_customize->add_setting(
        'slider_readmore',
        array(
            'default'           => __( 'READ the ARTICLE', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'slider_readmore',
        array(
            'type'            => 'text',
            'section'         => 'header_image',
            'label'           => __( 'Slider Read More', 'sarada-lite' ),
            'active_callback' => 'sarada_lite_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'slider_readmore', array(
        'selector' => '.banner .banner-text .btn-more',
        'render_callback' => 'sarada_lite_get_slider_readmore',
    ) );

    /** Banner Settings Ends */
    
    /** Featured Section Settings Starts */

    $wp_customize->add_section(
        'featured',
        array(
            'title'    => __( 'Featured Section', 'sarada-lite' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );

    $wp_customize->add_setting( 'featured_bg_image',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/feature-section-bg.jpg' ),
            'sanitize_callback' => 'sarada_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'featured_bg_image',
            array(
                'label'         => esc_html__( 'Background Image', 'sarada-lite' ),
                'description'   => esc_html__( 'Choose background Image of your choice. Recommended size for this image is 1920px by 1080px.', 'sarada-lite' ),
                'section'       => 'featured',
                'type'          => 'image',
                'priority'      => -1,
            )
        )
    );

    $wp_customize->add_setting(
        'featured_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Note_Control( 
            $wp_customize,
            'featured_note_text',
            array(
                'section'     => 'featured',
                'description' => __( '<hr/>Add "Text" and "Blossom: Image Text" widget for featured area section.', 'sarada-lite' ),
                'priority'    => -1
            )
        )
    );

    $featured_section = $wp_customize->get_section( 'sidebar-widgets-featured' );
    if ( ! empty( $featured_section ) ) {

        $featured_section->panel     = 'general_settings';
        $featured_section->priority  = 15;
        $wp_customize->get_control( 'featured_bg_image' )->section  = 'sidebar-widgets-featured';
        $wp_customize->get_control( 'featured_note_text' )->section = 'sidebar-widgets-featured';
    }  
    
    /** Featured Section Ends */  

    /** About Section Ends */  

     $wp_customize->add_section(
        'about',
        array(
            'title'    => __( 'About Section', 'sarada-lite' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );

    $wp_customize->add_setting( 'about_bg_image',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/about-section-bg.png' ),
            'sanitize_callback' => 'sarada_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'about_bg_image',
            array(
                'label'         => esc_html__( 'Background Image', 'sarada-lite' ),
                'description'   => esc_html__( 'Choose background Image of your choice. Recommended size for this image is 1920px by 1080px in PNG format.', 'sarada-lite' ),
                'section'       => 'about',
                'type'          => 'image',
                'priority'      => -1,
            )
        )
    );

    $wp_customize->add_setting(
        'about_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Note_Control( 
            $wp_customize,
            'about_note_text',
            array(
                'section'     => 'about',
                'description' => __( '<hr/>Add "Blossom: Featured Page Widget" for about section.', 'sarada-lite' ),
                'priority'    => -1
            )
        )
    );

    $about_section = $wp_customize->get_section( 'sidebar-widgets-about' );
    if ( ! empty( $about_section ) ) {

        $about_section->panel     = 'general_settings';
        $about_section->priority  = 20;
        $wp_customize->get_control( 'about_bg_image' )->section  = 'sidebar-widgets-about';
        $wp_customize->get_control( 'about_note_text' )->section = 'sidebar-widgets-about';
    }  
    
    /** About Section Ends */  

    /** Social Media Settings */
    $wp_customize->add_section(
        'social_media_settings',
        array(
            'title'    => __( 'Social Media Settings', 'sarada-lite' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_social_links',
            array(
                'section'     => 'social_media_settings',
                'label'       => __( 'Enable Social Links', 'sarada-lite' ),
                'description' => __( 'Enable to show social links at header.', 'sarada-lite' ),
            )
        )
    );
    
    $wp_customize->add_setting( 
        new Sarada_Lite_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Sarada_Lite_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Control_Repeater(
            $wp_customize,
            'social_links',
            array(
                'section' => 'social_media_settings',               
                'label'   => __( 'Social Links', 'sarada-lite' ),
                'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'sarada-lite' ),
                        'description' => __( 'Example: fab fa-facebook-f', 'sarada-lite' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'sarada-lite' ),
                        'description' => __( 'Example: https://facebook.com', 'sarada-lite' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'sarada-lite' ),
                    'field' => 'link'
                ),
                'choices'   => array(
                    'limit' => 10
                )                        
            )
        )
    );
    /** Social Media Settings Ends */

    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'sarada-lite' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_post_update_date',
            array(
                'section'     => 'seo_settings',
                'label'       => __( 'Enable Last Update Post Date', 'sarada-lite' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'sarada-lite' ),
            )
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_breadcrumb',
            array(
                'section'     => 'seo_settings',
                'label'       => __( 'Enable Breadcrumb', 'sarada-lite' ),
                'description' => __( 'Enable to show breadcrumb in inner pages.', 'sarada-lite' ),
            )
        )
    );
    
    /** Breadcrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => __( 'Home', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'    => 'text',
            'section' => 'seo_settings',
            'label'   => __( 'Breadcrumb Home Text', 'sarada-lite' ),
        )
    );  
    /** SEO Settings Ends */

    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'sarada-lite' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_prefix_archive',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Prefix in Archive Page', 'sarada-lite' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'sarada-lite' ),
            )
        )
    );
        
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_excerpt',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Enable Blog Excerpt', 'sarada-lite' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'sarada-lite' ),
            )
        )
    );
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 35,
            'sanitize_callback' => 'sarada_lite_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Slider_Control( 
            $wp_customize,
            'excerpt_length',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Excerpt Length', 'sarada-lite' ),
                'description' => __( 'Automatically generated excerpt length (in words).', 'sarada-lite' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 100,
                    'step'  => 5,
                )                 
            )
        )
    );

    /** Read More Text */
    $wp_customize->add_setting(
        'blog_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'blog_text',
        array(
            'label'   => __( 'Blog Title', 'sarada-lite' ),
            'section' => 'post_page_settings',
            'type'    => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'blog_text', array(
        'selector' => '.page-header .blog-title',
        'render_callback' => 'sarada_lite_get_blog_text',
    ) );

    /** Read More Text */
    $wp_customize->add_setting(
        'blog_content',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'blog_content',
        array(
            'label'   => __( 'Blog Description', 'sarada-lite' ),
            'section' => 'post_page_settings',
            'type'    => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'blog_content', array(
        'selector' => '.page-header .blog-content',
        'render_callback' => 'sarada_lite_get_blog_content',
    ) );
    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'READ the ARTICLE', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'sarada-lite' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-readmore',
        'render_callback' => 'sarada_lite_get_read_more',
    ) );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Note_Control( 
            $wp_customize,
            'post_note_text',
            array(
                'section'     => 'post_page_settings',
                'description' => sprintf( __( '%s These options affect your individual posts.', 'sarada-lite' ), '<hr/>' ),
            )
        )
    );
    
    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_author',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Author Section', 'sarada-lite' ),
                'description' => __( 'Enable to hide author section.', 'sarada-lite' ),
            )
        )
    );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_related',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Show Related Posts', 'sarada-lite' ),
                'description' => __( 'Enable to show related posts in single page.', 'sarada-lite' ),
            )
        )
    );
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'You may also like', 'sarada-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'sarada-lite' ),
            'active_callback' => 'sarada_lite_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.related-posts .title',
        'render_callback' => 'sarada_lite_get_related_title',
    ) );
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_comments',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Show Comments', 'sarada-lite' ),
                'description' => __( 'Enable to show Comments in Single Post/Page.', 'sarada-lite' ),
            )
        )
    );
    
    /** Comment Section After Content */
    $wp_customize->add_setting( 
        'toggle_comments', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'toggle_comments',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Toggle Comment Section', 'sarada-lite' ),
                'description' => __( 'Enable to show comment section after post content. Refresh site for changes.', 'sarada-lite' ),
                'active_callback' => 'sarada_lite_comments_toggle'
            )
        )
    );

    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_category',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Category', 'sarada-lite' ),
                'description' => __( 'Enable to hide category.', 'sarada-lite' ),
            )
        )
    );
    
    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_post_author',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Post Author', 'sarada-lite' ),
                'description' => __( 'Enable to hide post author.', 'sarada-lite' ),
            )
        )
    );
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_post_date',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Posted Date', 'sarada-lite' ),
                'description' => __( 'Enable to hide posted date.', 'sarada-lite' ),
            )
        )
    );

    /** Posts(Blog) & Pages Settings Ends */

    /** Shop Settings */
    $wp_customize->add_section(
        'shop-section',
        array(
            'title'    => __( 'Shop Section', 'sarada-lite' ),
            'priority' => 53,
            'panel'    => 'general_settings',
        )
    );

    $wp_customize->add_setting( 'shop_bg_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'shop_bg_color',
            array(
                'label'         => esc_html__( 'Background Color', 'sarada-lite' ),
                'description'   => esc_html__( 'Choose background Image of your choice.', 'sarada-lite' ),
                'section'       => 'shop-section',
                'priority'      => -1,
            )
        )
    );

    $wp_customize->add_setting(
        'shop_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Note_Control( 
            $wp_customize,
            'shop_note_text',
            array(
                'section'     => 'shop-section',
                'description' => __( '<hr/>Add "Custom HTML" or "Products" widget for shop section.', 'sarada-lite' ),
                'priority'    => -1
            )
        )
    );

    $shop_section = $wp_customize->get_section( 'sidebar-widgets-shop-section' );
    if ( ! empty( $shop_section ) ) {

        $shop_section->panel     = 'general_settings';
        $shop_section->priority  = 53;
        $wp_customize->get_control( 'shop_bg_color' )->section  = 'sidebar-widgets-shop-section';
        $wp_customize->get_control( 'shop_note_text' )->section = 'sidebar-widgets-shop-section';
    }

    /** Shop Settings Ends*/

    /** Newsletter Settings */
    $wp_customize->add_section(
        'newsletter_settings',
        array(
            'title'    => __( 'Newsletter Settings', 'sarada-lite' ),
            'priority' => 60,
            'panel'    => 'general_settings',
        )
    );
    
    if( sarada_lite_is_btnw_activated() ){
        
        /** Enable Newsletter Section */
        $wp_customize->add_setting( 
            'ed_newsletter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new Sarada_Lite_Toggle_Control( 
                $wp_customize,
                'ed_newsletter',
                array(
                    'section'     => 'newsletter_settings',
                    'label'       => __( 'Newsletter Section', 'sarada-lite' ),
                    'description' => __( 'Enable to show Newsletter Section in homepage', 'sarada-lite' ),
                )
            )
        );

        /** Enable Newsletter Section */
        $wp_customize->add_setting( 
            'ed_single_newsletter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new Sarada_Lite_Toggle_Control( 
                $wp_customize,
                'ed_single_newsletter',
                array(
                    'section'     => 'newsletter_settings',
                    'label'       => __( 'Single Newsletter Section', 'sarada-lite' ),
                    'description' => __( 'Enable to show Newsletter Section in single post.', 'sarada-lite' ),
                )
            )
        );
    
        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'newsletter_shortcode',
            array(
                'type'        => 'text',
                'section'     => 'newsletter_settings',
                'label'       => __( 'Newsletter Shortcode', 'sarada-lite' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'sarada-lite' ),
            )
        );

        
    } else {
        $wp_customize->add_setting(
            'newsletter_recommend',
            array(
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            new Sarada_Lite_Plugin_Recommend_Control(
                $wp_customize,
                'newsletter_recommend',
                array(
                    'section'     => 'newsletter_settings',
                    'label'       => __( 'Newsletter Shortcode', 'sarada-lite' ),
                    'capability'  => 'install_plugins',
                    'plugin_slug' => 'blossomthemes-email-newsletter',//This is the slug of recommended plugin.
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'sarada-lite' ), '<strong>', '</strong>' ),
                )
            )
        );
    }    

    /** Newsletter Settings Ends */
    
    /** Instagram Settings */
    $wp_customize->add_section(
        'instagram_settings',
        array(
            'title'    => __( 'Instagram Settings', 'sarada-lite' ),
            'priority' => 70,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Instagram Section */
    $wp_customize->add_setting( 
        'ed_instagram', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_instagram',
            array(
                'section'     => 'instagram_settings',
                'label'       => __( 'Instagram Section', 'sarada-lite' ),
                'description' => __( 'Enable to show Instagram Section', 'sarada-lite' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'instagram_shortcode', 
        array(
            'default'           => '[instagram-feed]',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    
    $wp_customize->add_control(
        'instagram_shortcode',
        array(
            'section'         => 'instagram_settings',
            'label'           => __( 'Shortcode', 'sarada-lite' ),
            'type'            => 'text',
            'description'     => __( 'Add shortcode for your instagram profile below:', 'sarada-lite' ),
            'active_callback' => 'sarada_lite_ed_instagram',
        )
    );

    /** Instagram Settings Ends */

    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'sarada-lite' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );

    /** Upload Home AD One */
    $wp_customize->add_setting(
        'header_one_bg',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/header-bg.png' ),
            'sanitize_callback' => 'sarada_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'header_one_bg',
           array(
               'label'           => __( 'Header Background Image', 'sarada-lite' ),
               'section'         => 'misc_settings',
           )
       )
    );

    /** Shop Page Description */
    $wp_customize->add_setting( 
        'ed_shop_archive_description', 
        array(
            'default'           => false,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_shop_archive_description',
            array(
                'section'         => 'misc_settings',
                'label'           => __( 'Shop Page Description', 'sarada-lite' ),
                'description'     => __( 'Enable to show Shop Page Description.', 'sarada-lite' ),
                'active_callback' => 'sarada_lite_is_woocommerce_activated'
            )
        )
    );

    /** Animation Enable Disable */
    $wp_customize->add_setting(
        'ed_animation',
        array(
            'default'           => true,
            'sanitize_callback' => 'sarada_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Sarada_Lite_Toggle_Control( 
            $wp_customize,
            'ed_animation',
            array(
                'section'       => 'misc_settings',
                'label'         => __( 'Enable Animation', 'sarada-lite' ),
                'description'   => __( 'Enable to hide show animation in homepage.', 'sarada-lite' ),
            )
        )
    );

    $wp_customize->add_setting( 'error_show_image',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/error404-img.jpg' ),
            'sanitize_callback' => 'sarada_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'error_show_image',
            array(
                'label'         => esc_html__( 'Add 404 Image', 'sarada-lite' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 432px by 652px.', 'sarada-lite' ),
                'section'       => 'misc_settings',
                'type'          => 'image',
            )
        )
    );

    /** Miscellaneous Settings Ends */
    
    
}
add_action( 'customize_register', 'sarada_lite_customize_register_general' );