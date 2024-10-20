<?php
/**
 * Toolkit Filters
 *
 * @package Sarada_Lite
 */

if( ! function_exists( 'sarada_lite_blog_widget_image_size' ) ) :
    function sarada_lite_blog_widget_image_size(){
        return 'sarada-blog';
    }
endif;
// recent post widget
add_filter( 'bttk_recent_post_size', 'sarada_lite_blog_widget_image_size' );
// popular post widget
add_filter( 'bttk_popular_post_size', 'sarada_lite_blog_widget_image_size' );
// blossom portfolio single
add_filter( 'bttk_related_portfolio_image', 'sarada_lite_blog_widget_image_size' );

if( ! function_exists( 'sarada_lite_full_widget_image_size' ) ) :
    function sarada_lite_full_widget_image_size(){
        return 'full';
    }
endif;
// image text widget
add_filter( 'bttk_it_img_size', 'sarada_lite_full_widget_image_size' );
// advertisement widget
add_filter( 'bttk_ad_img_size', 'sarada_lite_full_widget_image_size' );

if( ! function_exists( 'sarada_lite_category_slider_widget_image_size' ) ) :
    function sarada_lite_category_slider_widget_image_size(){
        return 'sarada-single-six';
    }
endif;
add_filter( 'bttk_category_img_size', 'sarada_lite_category_slider_widget_image_size' );

if( ! function_exists( 'sarada_lite_featured_page_widget_alignment' ) ) :
    function sarada_lite_featured_page_widget_alignment(){
        $array = array(
            'right'     => __( 'Right', 'sarada-lite' ),
            'left'      => __( 'Left', 'sarada-lite' ),
        );
        return $array;
    }
endif;
add_filter( 'bttk_img_alignment', 'sarada_lite_featured_page_widget_alignment' );

if( ! function_exists( 'sarada_lite_featured_page_widget_filter' ) ) :
/**
 * Filter for Featured page widget
*/
function sarada_lite_featured_page_widget_filter( $html, $args, $instance ){ 
    $read_more         = !empty( $instance['readmore'] ) ? $instance['readmore'] : __( 'Read More', 'sarada-lite' );      
    $show_feat_img     = !empty( $instance['show_feat_img'] ) ? $instance['show_feat_img'] : '' ;  
    $show_page_content = !empty( $instance['show_page_content'] ) ? $instance['show_page_content'] : '' ;        
    $show_readmore     = !empty( $instance['show_readmore'] ) ? $instance['show_readmore'] : '' ;        
    $page_list         = !empty( $instance['page_list'] ) ? $instance['page_list'] : 1 ;
    $image_alignment   = !empty( $instance['image_alignment'] ) ? $instance['image_alignment'] : 'left' ;
    if( !isset( $page_list ) || $page_list == '' ) return;
    
    $post_no = get_post( $page_list ); 
    
    $target = 'target="_blank"';
    if( isset($instance['target']) && $instance['target']!='' ) {
        $target = 'target="_self"';
    }
    
    if( $post_no ){
        setup_postdata( $post_no );
        ob_start(); ?>
        <div class="widget-featured-holder <?php echo esc_attr($image_alignment);?>">
            <div class="featured-holder-wrap">                    
                <?php
                echo $args['before_title'] . esc_html( $post_no->post_title ) . $args['after_title'];
                if( has_post_thumbnail( $post_no ) && $show_feat_img ){ ?>
                <div class="img-holder">
                    <a <?php echo $target;?> href="<?php the_permalink( $post_no ); ?>">
                        <?php 
                        if( has_post_thumbnail( $post_no ) ) echo get_the_post_thumbnail( $post_no, 'sarada-blog' ); ?>
                    </a>
                </div>
                <?php } ?>
                <div class="text-holder">
                    <div class="featured_page_content">
                        <?php 
                        if( isset( $show_page_content ) && $show_page_content!='' ){
                            echo apply_filters( 'the_content', $post_no->post_content );                                
                        }else{
                            echo apply_filters( 'the_excerpt', get_the_excerpt( $post_no ) );                                
                        }
                        
                        if( isset( $show_readmore ) && $show_readmore!='' ){ ?>
                            <a href="<?php the_permalink( $post_no ); ?>" <?php echo $target;?> class="btn-readmore"><?php echo esc_html( $read_more );?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>                    
            </div>
        </div>                    
        <?php    
        $html = ob_get_clean();
        wp_reset_postdata();
        return $html;
    }
}
endif;
add_filter( 'blossom_featured_page_widget_filter', 'sarada_lite_featured_page_widget_filter', 10, 3 );

if( ! function_exists( 'sarada_lite_defer_js_files' ) ) :
    function sarada_lite_defer_js_files(){
        $defer_js = get_theme_mod( 'ed_defer', false );

        return ( $defer_js ) ? false : true;
    }
endif;
add_filter( 'bttk_public_assets_enqueue', 'sarada_lite_defer_js_files' );
add_filter( 'btif_public_assets_enqueue', 'sarada_lite_defer_js_files' );
add_filter( 'bten_public_assets_enqueue', 'sarada_lite_defer_js_files' );