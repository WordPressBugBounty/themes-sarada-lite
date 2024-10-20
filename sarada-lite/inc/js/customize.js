jQuery(document).ready(function($) {

	/* Move widgets to general settings panel */
    wp.customize.section( 'sidebar-widgets-featured' ).panel( 'general_settings' );
    wp.customize.section( 'sidebar-widgets-featured' ).priority( '20' );
	wp.customize.section( 'sidebar-widgets-about' ).panel( 'general_settings' );
    wp.customize.section( 'sidebar-widgets-about' ).priority( '25' );
    wp.customize.section( 'sidebar-widgets-shop-section' ).panel( 'general_settings' );
    wp.customize.section( 'sidebar-widgets-shop-section' ).priority( '53' );
	
	//Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-general_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        Sarada_Lite_scrollToSection( section_id );
    }); 

    $( 'input[name=sarada-lite-flush-local-fonts-button]' ).on( 'click', function( e ) {
        var data = {
            wp_customize: 'on',
            action: 'sarada_lite_flush_fonts_folder',
            nonce: sarada_lite_cdata.flushFonts
        };  
        $( 'input[name=sarada-lite-flush-local-fonts-button]' ).attr('disabled', 'disabled');

        $.post( ajaxurl, data, function ( response ) {
            if ( response && response.success ) {
                $( 'input[name=sarada-lite-flush-local-fonts-button]' ).val( 'Successfully Flushed' );
            } else {
                $( 'input[name=sarada-lite-flush-local-fonts-button]' ).val( 'Failed, Reload Page and Try Again' );
            }
        });
    });

});

function Sarada_Lite_scrollToSection( section_id ){
    var preview_section_id = "sticky_bar";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-header_image':
        preview_section_id = "banner_section";
        break;

        case 'accordion-section-sidebar-widgets-featured':
        preview_section_id = "feature_section";
        break;

        case 'accordion-section-sidebar-widgets-about':
        preview_section_id = "about_section";
        break;

        case 'accordion-section-sidebar-widgets-shop-section':
        preview_section_id = "shop_section";
        break;
        
        case 'accordion-section-trending_section':
        preview_section_id = "trending_section";
        break;
		
		case 'accordion-section-newsletter_settings':
        preview_section_id = "newsletter_section";
        break;

        case 'accordion-section-instagram_settings':
        preview_section_id = "instagram_section";
        break;
    
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.blog').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

( function( api ) {

    // Extends our custom "example-1" section.
    api.sectionConstructor['sarada-lite-pro-section'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );