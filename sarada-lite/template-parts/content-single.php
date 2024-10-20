<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sarada_Lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
       <?php 
        
        echo '<div class="content-wrap">';
        /**
         * 
         * @hooked sarada_lite_entry_content - 15
         * @hooked sarada_lite_entry_footer  - 20
        */
        do_action( 'sarada_lite_single_entry_content' );
        echo '</div>';
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
