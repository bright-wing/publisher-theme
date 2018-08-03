<?php
/**
 * Template part for displaying sticky posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GIP
 */

?>
<?php 
	$thumbnail_data  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb');
	$thumbnail_url = $thumbnail_data[0];
?>
<div style="background-image:url('<?php echo $thumbnail_url ?>')" class="big-sticky jumbotron p-3 p-md-5 text-white rounded bg-dark mt-sm-5">
	<div class="col-md-6 px-0">
		<h1 class="display-4 font-italic"><?php the_title();?></h1>
		<p class="lead my-3"><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?></p>
		<p class="lead mb-0"><a href="<?php the_permalink(); ?>" class="text-white font-weight-bold">Continue reading...</a></p>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->