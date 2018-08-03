<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GIP
 */

get_header();
?>

		<?php if ( have_posts() ) : ?>
		
			<section id="content-1-2" class="content-block content-1-2 bg-offwhite pad-bottom45">
				<div class="container pr-md-0">
					<!-- Start Row -->
					<div class="row">
						<div class="col-sm-12"> 
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</div>
					</div>
					<!--// END Row -->
				</div>
			</section>
			<main role="main" class="container margin-top60"> 
				<div class="row">
					<div class="col-md-8 blog-main">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

						//the_posts_navigation(); 
						?>
						<!-- Navigation -->
						<nav class="mb-5 navigation paging-navigation text-left" role="navigation">
							<?php
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages
							) );
							?>
						</nav><!-- .navigation -->
						
					</div>
					<!-- /.blog-main -->

					<?php get_sidebar(); ?>
			 
				<!-- /.row -->
			</main>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>



<?php
get_footer();
