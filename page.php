<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GIP
 */

get_header();
?>


			<section id="content-1-2" class="content-block content-1-2 bg-offwhite pad-bottom45">
				<div class="container pr-md-0">
					<!-- Start Row -->
					<div class="row">
						<div class="col-sm-12"> 
							<?php the_title( '<h1 class="entry-title text-left">', '</h1>' ); ?>
							<?php $page_subtitle = get_post_meta( get_the_ID(), 'gip_page_subtitle', true ); ?>
							<?php if($page_subtitle): ?>
							<h3 class="text-left mt-md-3"><?php echo $page_subtitle; ?></h3> 
							<?php endif; ?>
						</div>
					</div>
					<!--// END Row -->
				</div>
			</section>
			<main role="main" class="container margin-top60"> 
			<?php
			while ( have_posts() ) :
				the_post(); ?>
				<div class="row">
					<div class="col-md-8 blog-main">
						<div class="blog-post">
							<p class="blog-post-meta"><?php gip_posted_on(); ?> by <?php  gip_posted_by(); ?></p>
							<?php the_content();?>
						</div>
						<hr class="mt-md-5 mb-md-5" />
					</div>
					<!-- /.blog-main -->

					<?php get_sidebar(); ?>
					<!-- /.blog-sidebar -->
				</div>				 
				<!-- /.row -->
			<?php
			endwhile; // End of the loop.
			?>	
			</main>

				<section class="comments-area">
					<div class="container">
						<?php	
							// If comments are open or we have at least one comment, load up the comment template.
							/* if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif; */
						?>
					</div>
				</section>
				
				
<?php
get_footer();
