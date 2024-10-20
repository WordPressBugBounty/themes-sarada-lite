<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Sarada_Lite
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <section class="error-404 not-found">
                <?php $error_img = get_theme_mod( 'error_show_image', esc_url( get_template_directory_uri() . '/images/error404-img.jpg' ) ); 
                if( $error_img ) :
                    echo '<figure class="error-img"><img src="' . esc_url( $error_img ). '" alt="' . esc_attr__( 'error-404', 'sarada-lite' ) . '"></figure>';
                endif; ?>
                <div class="page-content">
                    <div class="error-num-wrap">
                        <div class="error-num"><?php esc_html_e( '404', 'sarada-lite' ); ?></div>
                        <span class="error-txt"><?php esc_html_e( 'error', 'sarada-lite' ); ?></span>
                    </div>
                    <h2><?php esc_html_e( 'Page not found.', 'sarada-lite' ); ?></h2>
                    <a class="btn-readmore" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fas fa-chevron-left"></i><?php esc_html_e( 'Go to Homepage', 'sarada-lite' ); ?></a>
                </div><!-- .page-content -->
                <div class="error-404-search">
                    <h3 class="post-title"><?php esc_html_e( 'Try Searching', 'sarada-lite' ); ?></h3>
                    <?php get_search_form(); ?>
                </div>
            </section><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
    </div><!-- .container -->
    
    <?php
    /**
     * @see sarada_lite_latest_posts
    */
    do_action( 'sarada_lite_latest_posts' );
    
get_footer();