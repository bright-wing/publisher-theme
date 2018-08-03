<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GIP
 */

?>


<div class="blog-post">
	<?php //the_title( '<h2 class="blog-post-title">', '</h2>' ); ?>
	<?php the_title( '<h2 class="entry-title blog-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	<p class="blog-post-meta"><?php gip_posted_on(); ?> by <?php echo gip_posted_by(); ?></p>
	<?php echo wp_trim_words( get_the_content(), 70, '...' ); ?>
</div><!-- #post-<?php the_ID(); ?> -->
<hr class="mt-md-5 mb-md-5" />