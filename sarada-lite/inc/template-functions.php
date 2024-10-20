<?php
/**
 * Sarada Lite Template Functions which enhance the theme by hooking into WordPress
 *
 * @package Sarada_Lite
 */

if( ! function_exists( 'sarada_lite_doctype' ) ) :
/**
 * Doctype Declaration
*/
function sarada_lite_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'sarada_lite_doctype', 'sarada_lite_doctype' );

if( ! function_exists( 'sarada_lite_head' ) ) :
/**
 * Before wp_head 
*/
function sarada_lite_head(){ ?>
    <meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'sarada_lite_before_wp_head', 'sarada_lite_head' );

if( ! function_exists( 'sarada_lite_page_start' ) ) :
/**
 * Page Start
*/
function sarada_lite_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link" href="#content"><?php esc_html_e( 'Skip to Content', 'sarada-lite' ); ?></a>
    <?php
}
endif;
add_action( 'sarada_lite_before_header', 'sarada_lite_page_start', 20 );

if( ! function_exists( 'sarada_lite_notification_bar' ) ) :
/**
 * Promotional Block 
*/
function sarada_lite_notification_bar(){

    $ed_notification_bar    = get_theme_mod( 'notification_bar_area', false );
    $newsletter   = get_theme_mod( 'notification_bar_newsletter' );

    if( $ed_notification_bar && sarada_lite_is_btnw_activated() && $newsletter ) { ?>
        <div id="sticky_bar" class="sticky-t-bar newsletter-enabled active">
            <div class="sticky-bar-content">
               <?php echo do_shortcode( $newsletter ); ?> 
            </div>
            <button class="close"></button>
        </div>
        <?php
    }
}
endif;
add_action( 'sarada_lite_header', 'sarada_lite_notification_bar', 10 );

if( ! function_exists( 'sarada_lite_header' ) ) :
/**
 * Header Start
*/
function sarada_lite_header(){ 
    $header_bg = get_theme_mod( 'header_one_bg', esc_url( get_template_directory_uri() . '/images/header-bg.png' ) );
    ?>
    <header id="masthead" class="site-header style-one<?php if( $header_bg ) echo ' has-bg'; ?>" <?php if( $header_bg ) : ?> style="background-image: url('<?php echo esc_url( $header_bg ); ?>'); <?php endif; ?>">
        <div class="header-mid">
            <div class="container">
                <?php sarada_lite_primary_navigation(); ?>
                <?php sarada_lite_secondary_navigation(); ?>
                <?php sarada_lite_site_branding(); ?>
                <?php if( sarada_lite_social_links( false ) ){
                    echo '<div class="header-social">';
                    sarada_lite_social_links();
                    echo '</div>';
                } ?>
            </div>
        </div>
        <?php sarada_lite_sticky_header(); ?>
    </header>
<?php     
}
endif;
add_action( 'sarada_lite_header', 'sarada_lite_header', 25 );

if( ! function_exists( 'sarada_lite_banner' ) ) :
/**
 * Banner Section 
*/
function sarada_lite_banner(){

    if( is_front_page() || is_home() ) {
        $ed_banner      = get_theme_mod( 'ed_banner_section', 'slider_banner' );
        $slider_type    = get_theme_mod( 'slider_type', 'latest_posts' ); 
        $slider_cat     = get_theme_mod( 'slider_cat' );
        $posts_per_page = get_theme_mod( 'no_of_slides', 3 );
        $ed_caption     = get_theme_mod( 'slider_caption', true );
        $read_more      = get_theme_mod( 'slider_readmore', __( 'READ the ARTICLE', 'sarada-lite' ) );
        $banner_title     = get_theme_mod( 'banner_title', __( 'Find Your Best Holiday', 'sarada-lite' ) );
        $banner_subtitle  = get_theme_mod( 'banner_subtitle', __( 'Find great adventure holidays and activities around the planet.', 'sarada-lite' ) );
        $banner_label     = get_theme_mod( 'banner_label', __( 'Explore', 'sarada-lite' ) );
        $banner_link      = get_theme_mod( 'banner_link', '#' );
        $banner_label_two = get_theme_mod( 'banner_label_two', __( 'Learn More', 'sarada-lite' ) );
        $banner_link_two  = get_theme_mod( 'banner_link_two', '#' );
        
        if( $ed_banner == 'static_banner' && has_custom_header() ){ 
            if( has_header_video() ) {
                $custom_header_class = ' video-banner';
            }else{
                $custom_header_class = ' static-banner';
            } ?>
            <div id="banner_section" class="site-banner static-cta-banner style-one <?php echo esc_attr( $custom_header_class ); ?>">
                <div class="static-banner-wrap">
                    <?php 
                        the_custom_header_markup(); 
                        if( $ed_banner == 'static_banner' && ( $banner_title || $banner_subtitle || ( $banner_label && $banner_link ) ) ){
                            echo '<div class="banner-caption"><div class="container">';
                            if( $banner_title ) echo '<h2 class="banner-title">' . esc_html( $banner_title ) . '</h2>';
                            if( $banner_subtitle ) echo '<div class="banner-desc">' . wp_kses_post( $banner_subtitle ) . '</div>';
                            if( $banner_label && $banner_link ) echo '<a class="btn-readmore button-one" href="' . esc_url( $banner_link ) . '">' . esc_html( $banner_label ) . '</a>';
                            if( $banner_label_two && $banner_link_two ) echo '<a class="btn-readmore button-two" href="' . esc_url( $banner_link_two ) . '">' . esc_html( $banner_label_two ) . '</a>';
                            echo '</div></div>';
                        }
                    ?>
                </div>
            </div>
        <?php
        }elseif( $ed_banner == 'slider_banner' ){
            if( $slider_type == 'latest_posts' || $slider_type == 'cat' ){
            
                $args = array(
                    'post_status'         => 'publish',            
                    'ignore_sticky_posts' => true
                );
                
                if( $slider_type === 'cat' && $slider_cat ){
                    $args['post_type']      = 'post';
                    $args['cat']            = $slider_cat; 
                    $args['posts_per_page'] = -1;  
                }else{
                    $args['post_type']      = 'post';
                    $args['posts_per_page'] = $posts_per_page;
                }
                    
                $qry = new WP_Query( $args );
            
                if( $qry->have_posts() ){ ?>
                <div id="banner_section" class="site-banner style-one">
                    <div class="item-wrap owl-carousel">
                        <?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                            <div class="item has-single-img">
                                <div class="banner-img">
                                    <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( 'sarada-blog', array( 'itemprop' => 'image' ) );    
                                    }else{
                                        sarada_lite_get_fallback_svg( 'sarada-blog' );
                                    } ?>
                                </div>
                                    
                                <?php if( $ed_caption ){ ?>                        
                                    <div class="banner-caption">
                                    <?php
                                        sarada_lite_category();
                                        the_title( '<h2 class="banner-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                        if( $read_more ) echo '<div class="button-wrap"><a href="' . esc_url( get_the_permalink() ) . '" class="btn-readmore">' . esc_html( $read_more ) . '</a></div>';                                            
                                    ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>                        
                    </div>
                </div>
                <?php
                }
                wp_reset_postdata();
            }            
        } 
    }   
}
endif;
add_action( 'sarada_lite_after_header', 'sarada_lite_banner', 15 );

if( ! function_exists( 'sarada_lite_featured_area' ) ) :
/**
 * Featured Area Section
 * 
*/
function sarada_lite_featured_area() { 
    
    $featured_bg_image = get_theme_mod( 'featured_bg_image', esc_url( get_template_directory_uri() . '/images/feature-section-bg.jpg' ) );
    if( ( is_front_page() || is_home() ) && is_active_sidebar( 'featured' ) ) { ?>
        <section id="feature_section" class="feature-section wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="background-image: url('<?php echo esc_url( $featured_bg_image ); ?>');">
            <div class="container">
                <div class="section-grid">   
                    <?php dynamic_sidebar( 'featured' ); ?>
                </div>
            </div>
        </section><!-- .feature-section --> 
    <?php }
}
endif;
add_action( 'sarada_lite_after_header', 'sarada_lite_featured_area', 20 );

if( ! function_exists( 'sarada_lite_about_section' ) ) :
/**
 * About Section
 * 
*/
function sarada_lite_about_section() { 
    if( ( is_front_page() || is_home() ) && is_active_sidebar( 'about' ) ) { ?>
        <section id="about_section" class="about-section wow slideInUp" data-wow-duration="1s" data-wow-delay="0.3s">
            <div class="section-grid">   
                <?php dynamic_sidebar( 'about' ); ?>
            </div>
        </section><!-- .feature-section --> 
    <?php }
}
endif;
add_action( 'sarada_lite_after_header', 'sarada_lite_about_section', 25 );

if( ! function_exists( 'sarada_lite_content_start' ) ) :
/**
 * Content Start
 *   
*/
function sarada_lite_content_start(){ ?>    
    <div id="content" class="site-content">
    <?php
        if( is_single() && !( ( sarada_lite_is_woocommerce_activated() && is_product() ) || ( sarada_lite_is_bttk_activated() && is_singular( 'blossom-portfolio' ) ) ) ) sarada_lite_single_layout_header();
        echo '<div class="container">';
        if( is_archive() || is_search() ) sarada_lite_breadcrumb();
}
endif;
add_action( 'sarada_lite_content', 'sarada_lite_content_start' );

if( ! function_exists( 'sarada_lite_page_header' ) ) :
/**
 * Content Start
 *   
*/
function sarada_lite_page_header(){ 
    $blog_text          = get_theme_mod( 'blog_text' );
    $blog_content       = get_theme_mod( 'blog_content' );
    $author_title       = get_the_author_meta( 'display_name' );
    $author_description = get_the_author_meta( 'description' );

    if ( ( is_home() && ( ! $blog_text || ! $blog_content ) ) || ( is_author() && ! $author_description ) ){
        return;
    }else{
        echo '<header class="page-header">';
    }

        if ( is_home() ){      
            if( $blog_text ) echo '<h2 class="page-title blog-title">' . esc_html( $blog_text) . '</h2>';
            if( $blog_content ) echo '<div class="page-content blog-content">' . wpautop( wp_kses_post( $blog_content ) ). '</div>';
        }

        if( is_search() ){ 
            get_search_form();
        }
            
        if( is_archive() ){              
        
            if( is_author() ){
                $author_title       = get_the_author_meta( 'display_name' );
                $author_description = get_the_author_meta( 'description' );
                if( $author_description ){ ?>
                    <div class="author-section">
                        <div class="author-img-wrap">
                            <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?></figure>
                            <?php echo '<h3 class="author-name">' . esc_html( $author_title ) . '</h3>'; ?>
                        </div>
                        <?php if( $author_description ) : ?>
                            <div class="author-content-wrap">
                                <?php echo '<div class="author-content">' . wpautop( wp_kses_post( $author_description ) ) . '</div>'; ?>      
                            </div>
                        <?php endif; ?>
                    </div>
                <?php }
            }
            else{
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
            }
        }            
            
        if ( ( is_home() && ( ! $blog_text || ! $blog_content ) ) || ( is_author() && !$author_description ) ){
            return;
        }else{
            echo '</header>';
        }
        
        if( is_archive() || is_search() ) sarada_lite_posts_per_page_count(); ?>      
<?php }
endif;
add_action( 'sarada_lite_before_posts_content', 'sarada_lite_page_header', 10 );

if ( ! function_exists( 'sarada_lite_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function sarada_lite_post_thumbnail() {
    
    if( is_home() ){                
        if( has_post_thumbnail() ) {
            echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
            if( has_post_thumbnail() ){                        
                the_post_thumbnail( 'sarada-blog', array( 'itemprop' => 'image' ) );    
            }else{
                sarada_lite_get_fallback_svg( 'sarada-blog' );
            }              
            echo '</a></figure>';
        }
    }elseif( is_archive() || is_search() ){
        if( has_post_thumbnail() ) {
            echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
            if( has_post_thumbnail() ){
                the_post_thumbnail( 'sarada-blog', array( 'itemprop' => 'image' ) );    
            }else{
                sarada_lite_get_fallback_svg( 'sarada-blog' );
            }    
            echo '</a></figure>';
        }
    }
}
endif;
add_action( 'sarada_lite_before_page_entry_content', 'sarada_lite_post_thumbnail' );
add_action( 'sarada_lite_before_post_entry_content', 'sarada_lite_post_thumbnail', 20 );

if( ! function_exists( 'sarada_lite_entry_header' ) ) :
/**
 * Entry Header
*/
function sarada_lite_entry_header(){ 
    ?>
    <header class="entry-header">
        <?php 
            
            sarada_lite_category();    
        
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );      
            if( 'post' === get_post_type() ){
                echo '<div class="entry-meta">';
                    sarada_lite_posted_by();
                    sarada_lite_posted_on();
                    sarada_lite_comment_count();
                echo '</div>';
            }  
        ?>
    </header>         
    <?php    
}
endif;
add_action( 'sarada_lite_post_entry_content', 'sarada_lite_entry_header', 10 );

if( ! function_exists( 'sarada_lite_entry_content' ) ) :
/**
 * Entry Content
*/
function sarada_lite_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
    <div class="entry-content" itemprop="text">
        <?php
            if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sarada-lite' ),
                    'after'  => '</div>',
                ) );
            }else{
                the_excerpt();
            }
        ?>
    </div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'sarada_lite_page_entry_content', 'sarada_lite_entry_content', 15 );
add_action( 'sarada_lite_post_entry_content', 'sarada_lite_entry_content', 15 );
add_action( 'sarada_lite_single_entry_content', 'sarada_lite_entry_content', 15 );

if( ! function_exists( 'sarada_lite_entry_footer' ) ) :
/**
 * Entry Footer
*/
function sarada_lite_entry_footer(){ 
    $readmore = get_theme_mod( 'read_more_text', __( 'READ the ARTICLE', 'sarada-lite' ) ); ?>
	<footer class="entry-footer">
		<?php
			if( is_single() ){
			    sarada_lite_tag();
			}
            
            if( is_home() || is_archive() || is_search() ){
                echo '<div class="button-wrap"><a href="' . esc_url( get_the_permalink() ) . '" class="btn-readmore">' . esc_html( $readmore ) . '</a></div>';
            }
            
            if( get_edit_post_link() ){
                edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'sarada-lite' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
            }
		?>
	</footer><!-- .entry-footer -->
	<?php 
}
endif;
add_action( 'sarada_lite_page_entry_content', 'sarada_lite_entry_footer', 20 );
add_action( 'sarada_lite_post_entry_content', 'sarada_lite_entry_footer', 20 );
add_action( 'sarada_lite_single_entry_content', 'sarada_lite_entry_footer', 15 );

if( ! function_exists( 'sarada_lite_author' ) ) :
/**
 * Author Section
*/
function sarada_lite_author(){ 
    $ed_author          = get_theme_mod( 'ed_author', false );
    $author_title       = get_the_author_meta( 'display_name' );
    $author_description = get_the_author_meta( 'description' );
    if( ! $ed_author && $author_description ){ ?>
        <div class="author-section">
            <div class="author-img-wrap">
                <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?></figure>
                <?php echo '<h3 class="author-name">' . esc_html( $author_title ) . '</h3>'; ?>
            </div>
            <div class="author-content-wrap">
                <?php echo '<div class="author-content">' . wpautop( wp_kses_post( $author_description ) ) . '</div>'; ?>      
            </div>
        </div>
    <?php
    }
}
endif;
add_action( 'sarada_lite_after_post_content', 'sarada_lite_author', 15 );

if( ! function_exists( 'sarada_lite_navigation' ) ) :
/**
 * Navigation
*/
function sarada_lite_navigation(){
    if( is_single() ){
        $next_post = get_next_post();
        $prev_post = get_previous_post();

        if( $prev_post || $next_post ) { ?>            
            <nav class="post-navigation pagination" role="navigation">
                <span class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'sarada-lite' ); ?></span>
                <div class="nav-links">
                    <?php if( $prev_post ){ ?>
                    <div class="nav-previous">
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                            <span class="meta-nav"><?php esc_html_e( 'Previous Post', 'sarada-lite' ); ?></span>
                            <figure class="post-img">
                                <?php
                                $prev_img = get_post_thumbnail_id( $prev_post->ID );
                                if( $prev_img ){
                                    $prev_url = wp_get_attachment_image_url( $prev_img, 'sarada-blog' );
                                    echo '<img src="' . esc_url( $prev_url ) . '" alt="' . the_title_attribute( 'echo=0', $prev_post ) . '">';                                        
                                }else{
                                    sarada_lite_get_fallback_svg( 'sarada-blog' );
                                }
                                ?>
                            </figure>
                            <span class="post-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if( $next_post ){ ?>
                    <div class="nav-next">
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                            <span class="meta-nav"><?php esc_html_e( 'Next Post', 'sarada-lite' ); ?></span>
                            <figure class="post-img">
                                <?php
                                $next_img = get_post_thumbnail_id( $next_post->ID );
                                if( $next_img ){
                                    $next_url = wp_get_attachment_image_url( $next_img, 'sarada-blog' );
                                    echo '<img src="' . esc_url( $next_url ) . '" alt="' . the_title_attribute( 'echo=0', $next_post ) . '">';                                        
                                }else{
                                    sarada_lite_get_fallback_svg( 'sarada-blog' );
                                }
                                ?>
                            </figure>
                            <span class="post-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </nav>        
            <?php
        }
    }else{    
        the_posts_navigation();       
    }
}
endif;
add_action( 'sarada_lite_after_post_content', 'sarada_lite_navigation', 20 );
add_action( 'sarada_lite_after_posts_content', 'sarada_lite_navigation' );

if( ! function_exists( 'sarada_lite_newsletter_single' ) ) :
/**
 * Newsletter
*/
function sarada_lite_newsletter_single(){ 
    $ed_newsletter = get_theme_mod( 'ed_single_newsletter', false );
    $newsletter    = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter && $newsletter ){ ?>
        <div class="newsletter-block">
            <?php echo do_shortcode( $newsletter ); ?>
        </div>
        <?php
    }
}
endif;
add_action( 'sarada_lite_after_post_content', 'sarada_lite_newsletter_single', 25 );

if( ! function_exists( 'sarada_lite_related_posts' ) ) :
/**
 * Related Posts 
*/
function sarada_lite_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    
    if( $ed_related_post ){
        sarada_lite_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'sarada_lite_after_post_content', 'sarada_lite_related_posts', 30 );

if( ! function_exists( 'sarada_lite_latest_posts' ) ) :
/**
 * Latest Posts
*/
function sarada_lite_latest_posts(){ 
    sarada_lite_get_posts_list( 'latest' );
}
endif;
add_action( 'sarada_lite_latest_posts', 'sarada_lite_latest_posts' );

if( ! function_exists( 'sarada_lite_comment' ) ) :
/**
 * Comments Template 
*/
function sarada_lite_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( get_theme_mod( 'ed_comments', true ) && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'sarada_lite_after_post_content', 'sarada_lite_comment', sarada_lite_comment_toggle() );
add_action( 'sarada_lite_after_page_content', 'sarada_lite_comment' );

if( ! function_exists( 'sarada_lite_content_end' ) ) :
/**
 * Content End
*/
function sarada_lite_content_end(){          
        if( !is_404() ) echo '</div><!-- .container -->'; ?>
    </div><!-- .site-content -->
    <?php
}
endif;
add_action( 'sarada_lite_before_footer', 'sarada_lite_content_end', 20 );

if( ! function_exists( 'sarada_lite_shop_section' ) ) :
/**
 * Shop Section
*/
function sarada_lite_shop_section(){

    $shop_bg_color = get_theme_mod( 'shop_bg_color', '#ffffff' );
    if( ( is_front_page() || is_home() ) && is_active_sidebar( 'shop-section' ) ) { ?>
        <section id="shop_section" class="shop-favourite-section wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="background-color:<?php echo esc_url( $shop_bg_color ); ?>;">
            <div class="container">
                <div class="section-grid">
                    <?php dynamic_sidebar( 'shop-section' ); ?>
                </div>
            </div>
        </section><!-- .shop-favourite-section -->
    <?php }
}
endif;
add_action( 'sarada_lite_before_footer_start', 'sarada_lite_shop_section', 10 );

if( ! function_exists( 'sarada_lite_newsletter_section' ) ) :
/**
 * Newsletter
*/
function sarada_lite_newsletter_section(){ 
    $ed_newsletter = get_theme_mod( 'ed_newsletter', false );
    $newsletter    = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter && $newsletter && !is_single() ){ ?>
        <div id="newsletter_section" class="newsletter-block wow fadeIn" data-wow-delay="0.1s">
            <?php echo do_shortcode( $newsletter ); ?>
        </div>
        <?php
    }
}
endif;
add_action( 'sarada_lite_before_footer_start', 'sarada_lite_newsletter_section', 30 );

if( ! function_exists( 'sarada_lite_footer_start' ) ) :
/**
 * Footer Start
*/
function sarada_lite_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'sarada_lite_footer', 'sarada_lite_footer_start', 20 );

if( ! function_exists( 'sarada_lite_footer_top' ) ) :
/**
 * Footer Top
*/
function sarada_lite_footer_top(){    
    $footer_bg       = get_theme_mod( 'footer_bg', esc_url( get_template_directory_uri() . '/images/footer-bg.jpg' ) );
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t" style="background-image: url('<?php echo esc_url( $footer_bg ); ?>');">
			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
            <?php foreach( $active_sidebars as $active ){ ?>
				<div class="col">
				   <?php dynamic_sidebar( $active ); ?>	
				</div>
            <?php } ?>
            </div>
    	</div>
        <?php 
    }   
}
endif;
add_action( 'sarada_lite_footer', 'sarada_lite_footer_top', 30 );

if( ! function_exists( 'sarada_lite_footer_mid' ) ) :
/**
 * Footer Top
*/
function sarada_lite_footer_mid(){ ?>   
    <div class="footer-m">
        <div class="grid">
            <?php sarada_lite_instagram(); ?>               
        </div>
    </div>  
<?php }
endif;
add_action( 'sarada_lite_footer', 'sarada_lite_footer_mid', 30 );

if( ! function_exists( 'sarada_lite_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function sarada_lite_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
			<div class="site-info">            
            <?php
                sarada_lite_get_footer_copyright();
                echo esc_html__( ' Sarada Lite | Developed By ', 'sarada-lite' ); 
                echo '<a href="' . esc_url( 'https://blossomthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Blossom Themes', 'sarada-lite' ) . '</a>.';                
                printf( esc_html__( ' Powered by %s. ', 'sarada-lite' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'sarada-lite' ) ) .'" target="_blank">WordPress</a>' );
                if( function_exists( 'the_privacy_policy_link' ) ){
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <?php sarada_lite_footer_navigation(); ?>
            <button class="back-to-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M58.427 225.456L124 159.882V456c0 13.255 10.745 24 24 24h24c13.255 0 24-10.745 24-24V159.882l65.573 65.574c9.373 9.373 24.569 9.373 33.941 0l16.971-16.971c9.373-9.373 9.373-24.569 0-33.941L176.971 39.029c-9.373-9.373-24.568-9.373-33.941 0L7.515 174.544c-9.373 9.373-9.373 24.569 0 33.941l16.971 16.971c9.372 9.373 24.568 9.373 33.941 0z"></path></svg>
            </button>
		</div>
	</div>
    <?php
}
endif;
add_action( 'sarada_lite_footer', 'sarada_lite_footer_bottom', 50 );

if( ! function_exists( 'sarada_lite_footer_end' ) ) :
/**
 * Footer End 
*/
function sarada_lite_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'sarada_lite_footer', 'sarada_lite_footer_end', 60 );

if( ! function_exists( 'sarada_lite_page_end' ) ) :
/**
 * Page End
*/
function sarada_lite_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'sarada_lite_after_footer', 'sarada_lite_page_end', 20 );