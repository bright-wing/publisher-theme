<?php
/**
 * Template part for displaying sticky posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GIP
 */

?>

<div class="col-md-6">
	<div class="card flex-md-row mb-4 box-shadow h-md-250">
		<div class="card-body d-flex flex-column align-items-start">
			<h3 class="mb-0"> <a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title();?></a> </h3>
			<div class="mb-1 text-muted"><?php echo get_the_date('M') .' '.   get_the_date('j'); ?></div>
			<p class="card-text mb-auto"><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?></p>
			<a href="<?php the_permalink(); ?>">Continue reading</a>
		</div>
		<?php the_post_thumbnail('post-thumb-sm', array('class'=>'card-img-right flex-auto d-none d-md-block')); ?>
	</div>
</div>