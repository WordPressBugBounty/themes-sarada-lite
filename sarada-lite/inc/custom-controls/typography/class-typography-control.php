<?php
/**
 * Sarada Lite Customizer Typography Control
 *
 * @package Sarada_Lite
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Sarada_Lite_Typography_Control' ) ) {
    
    class Sarada_Lite_Typography_Control extends WP_Customize_Control{
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'sarada-lite-typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'sarada_lite_il8n_strings', array(
    			'on'                 => esc_attr__( 'ON', 'sarada-lite' ),
    			'off'                => esc_attr__( 'OFF', 'sarada-lite' ),
    			'all'                => esc_attr__( 'All', 'sarada-lite' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'sarada-lite' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'sarada-lite' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'sarada-lite' ),
    			'greek'              => esc_attr__( 'Greek', 'sarada-lite' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'sarada-lite' ),
    			'khmer'              => esc_attr__( 'Khmer', 'sarada-lite' ),
    			'latin'              => esc_attr__( 'Latin', 'sarada-lite' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'sarada-lite' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'sarada-lite' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'sarada-lite' ),
    			'arabic'             => esc_attr__( 'Arabic', 'sarada-lite' ),
    			'bengali'            => esc_attr__( 'Bengali', 'sarada-lite' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'sarada-lite' ),
    			'tamil'              => esc_attr__( 'Tamil', 'sarada-lite' ),
    			'telugu'             => esc_attr__( 'Telugu', 'sarada-lite' ),
    			'thai'               => esc_attr__( 'Thai', 'sarada-lite' ),
    			'serif'              => _x( 'Serif', 'font style', 'sarada-lite' ),
    			'sans-serif'         => _x( 'Sans Serif', 'font style', 'sarada-lite' ),
    			'monospace'          => _x( 'Monospace', 'font style', 'sarada-lite' ),
    			'font-family'        => esc_attr__( 'Font Family', 'sarada-lite' ),
    			'font-size'          => esc_attr__( 'Font Size', 'sarada-lite' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'sarada-lite' ),
    			'line-height'        => esc_attr__( 'Line Height', 'sarada-lite' ),
    			'font-style'         => esc_attr__( 'Font Style', 'sarada-lite' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'sarada-lite' ),
    			'text-align'         => esc_attr__( 'Text Align', 'sarada-lite' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'sarada-lite' ),
    			'none'               => esc_attr__( 'None', 'sarada-lite' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'sarada-lite' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'sarada-lite' ),
    			'top'                => esc_attr__( 'Top', 'sarada-lite' ),
    			'bottom'             => esc_attr__( 'Bottom', 'sarada-lite' ),
    			'left'               => esc_attr__( 'Left', 'sarada-lite' ),
    			'right'              => esc_attr__( 'Right', 'sarada-lite' ),
    			'center'             => esc_attr__( 'Center', 'sarada-lite' ),
    			'justify'            => esc_attr__( 'Justify', 'sarada-lite' ),
    			'color'              => esc_attr__( 'Color', 'sarada-lite' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'sarada-lite' ),
    			'variant'            => esc_attr__( 'Variant', 'sarada-lite' ),
    			'style'              => esc_attr__( 'Style', 'sarada-lite' ),
    			'size'               => esc_attr__( 'Size', 'sarada-lite' ),
    			'height'             => esc_attr__( 'Height', 'sarada-lite' ),
    			'spacing'            => esc_attr__( 'Spacing', 'sarada-lite' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'sarada-lite' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'sarada-lite' ),
    			'light'              => esc_attr__( 'Light 200', 'sarada-lite' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'sarada-lite' ),
    			'book'               => esc_attr__( 'Book 300', 'sarada-lite' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'sarada-lite' ),
    			'regular'            => esc_attr__( 'Normal 400', 'sarada-lite' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'sarada-lite' ),
    			'medium'             => esc_attr__( 'Medium 500', 'sarada-lite' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'sarada-lite' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'sarada-lite' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'sarada-lite' ),
    			'bold'               => esc_attr__( 'Bold 700', 'sarada-lite' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'sarada-lite' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'sarada-lite' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'sarada-lite' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'sarada-lite' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'sarada-lite' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'sarada-lite' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'sarada-lite-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.css', null );
            
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		wp_enqueue_script( 'sarada-lite-selectize', get_template_directory_uri() . '/inc/js/selectize.js', array( 'jquery' ), false, true );
    		wp_enqueue_script( 'sarada-lite-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.js', array( 'jquery', 'sarada-lite-selectize' ), false, true );
    
    		$google_fonts   = Sarada_Lite_Fonts::get_google_fonts();
    		$standard_fonts = Sarada_Lite_Fonts::get_standard_fonts();
    		$all_variants   = Sarada_Lite_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $value['stack'],
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'sarada-lite-typography', 'all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template(){ ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="sarada-lite-typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant sarada-lite-variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="sarada-lite-typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
    	}  

        protected function render_content(){
        }  
    }
}