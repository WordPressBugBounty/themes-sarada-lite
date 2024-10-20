<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sarada_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); if( is_home() ) echo ' data-wow-duration="1s" data-wow-delay="0.3s"';?> itemscope itemtype="https://schema.org/Blog">
       <?php 
        echo '<div class="content-wrap-outer">';
        
        /** 
         * @hooked sarada_lite_post_thumbnail - 20
        */
        do_action( 'sarada_lite_before_post_entry_content' );
        
            echo '<div class="content-wrap">';
            /**
             * @hooked sarada_lite_entry_header  - 10
             * @hooked sarada_lite_entry_content - 15
             * @hooked sarada_lite_entry_footer  - 20
            */
            do_action( 'sarada_lite_post_entry_content' );
            
            echo '</div>';
        echo '</div>';
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
