<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sarada_Lite
 */

sarada_lite_page_layout_header_two(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

        /**
         * Entry Content
         * 
         * @hooked sarada_lite_entry_content - 15
         * @hooked sarada_lite_entry_footer  - 20
        */
        do_action( 'sarada_lite_page_entry_content' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
