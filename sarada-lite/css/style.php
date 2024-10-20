<?php
/**
 * Sarada Lite Dynamic Styles
 * 
 * @package Sarada_Lite
*/

if( ! function_exists( 'sarada_lite_dynamic_css') ) :
/**
 * Dynamic Css
 */
function sarada_lite_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Esteban' );
    $primary_fonts   = sarada_lite_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Caveat' );
    $secondary_fonts = sarada_lite_get_fonts( $secondary_font, '700' );

    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Caveat', 'variant'=>'700' ) );
    $site_title_fonts     = sarada_lite_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 36 );

    $font_size       = get_theme_mod( 'font_size', 18 );
    $secondary_font_size       = get_theme_mod( 'secondary_font_size', 18 );
    
    $primary_color    = get_theme_mod( 'primary_color', '#e1bdbd' );
    $secondary_color  = get_theme_mod( 'secondary_color', '#fdf2ed' );
    $site_title_color = get_theme_mod( 'site_title_color', '#111111' );
    $site_logo_size   = get_theme_mod( 'site_logo_size', 250 );
    
    $rgb = sarada_lite_hex2rgb( sarada_lite_sanitize_hex_color( $primary_color ) );
    $rgb_two = sarada_lite_hex2rgb( sarada_lite_sanitize_hex_color( $secondary_color ) );
    $about_bg_image = get_theme_mod( 'about_bg_image', esc_url( get_template_directory_uri() . '/images/about-section-bg.png' ) );
     
    echo "<style type='text/css' media='all'>"; ?>
     
    .content-newsletter .blossomthemes-email-newsletter-wrapper.bg-img:after,
    .widget_blossomthemes_email_newsletter_widget .blossomthemes-email-newsletter-wrapper:after{
        <?php echo 'background: rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.8);'; ?>
    }
    
    /*Typography*/
    
    html{
        font-size   : <?php echo absint( $secondary_font_size ); ?>px;
    }
    
    body {
        font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }

    .about-section::before{
        background-image: url('<?php echo esc_url( $about_bg_image ); ?>');
    }
    
    .site-branding .site-title-wrap .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }
    
    .site-branding .site-title-wrap .site-title a{
        color: <?php echo sarada_lite_sanitize_hex_color( $site_title_color ); ?>;
    }

    :root {
	    --primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
	    --secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
	    --primary-color: <?php echo sarada_lite_sanitize_hex_color( $primary_color ); ?>;
	    --primary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ); ?>;
        --secondary-color: <?php echo sarada_lite_sanitize_hex_color( $secondary_color ); ?>;
        --secondary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb_two[0], $rgb_two[1], $rgb_two[2] ); ?>;
	}

    .custom-logo-link img{
	    width: <?php echo absint( $site_logo_size ); ?>px;
	    max-width: 100%;
	}
     
    <?php echo "</style>";
}
endif;
add_action( 'wp_head', 'sarada_lite_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function sarada_lite_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function sarada_lite_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/**
 * Convert '#' to '%23'
*/
function sarada_lite_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}