<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GIP
 */

get_header();
?>
			<main role="main" class="container ">
				
				<?php 
				/* Get all Sticky Posts */
				$sticky = get_option( 'sticky_posts' );

				/* Sort Sticky Posts, newest at the top */
				rsort( $sticky );

				/* Get top 5 Sticky Posts */
				$sticky = array_slice( $sticky, 0, 1 );
				//print_r($sticky);

				/* Query Sticky Posts */
				$custom_query = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) ); ?>
				
				
				<?php if ( $custom_query->have_posts() ) : ?>
					<!-- the loop -->
					<?php 
						while ( $custom_query->have_posts() ) : $custom_query->the_post(); 
						get_template_part( 'template-parts/content', 'sticky' );
						endwhile; 
						wp_reset_postdata(); 
					?>
				<?php else : ?>
					<div class="col-md-12"><?php esc_html_e( 'Sorry, no sticky posts found.' ); ?></div>
				<?php endif; ?>

				<div class="row mb-2  mt-sm-5">
					<?php 
					/* Get all Sticky Posts */
					$sticky = get_option( 'sticky_posts' );

					/* Sort Sticky Posts, newest at the top */
					rsort( $sticky );

					/* Get top 5 Sticky Posts */
					$sticky = array_slice( $sticky, 1, 2 );
					//print_r($sticky);

					/* Query Sticky Posts */
					$custom_query = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) ); ?>
					
					
					<?php if ( $custom_query->have_posts() ) : ?>
						<!-- the loop -->
						<?php 
							while ( $custom_query->have_posts() ) : $custom_query->the_post(); 
							get_template_part( 'template-parts/content', 'sticky2' );
							endwhile; 
							wp_reset_postdata(); 
						?>
					<?php else : ?>
						<div class="col-md-12"><?php esc_html_e( 'Sorry, no sticky posts found.' ); ?></div>
					<?php endif; ?>
				</div>				 
				<div class="row">
					<div class="col-md-8 blog-main">
						<h3 class="pb-3 mb-4 font-italic border-bottom"> From the Firehose </h3>
						<?php 
							$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
							$query = new WP_Query( array( 'post__not_in' => get_option( 'sticky_posts' ), 'paged' => $paged ) );
							// Pagination fix
							$temp_query = $wp_query;
							$wp_query   = NULL;
							$wp_query   = $query;
						?>
						<?php if ( $query->have_posts() ) : ?>

							<?php
							/* Start the Loop */
							while ( $query->have_posts() ) :
								$query->the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile; ?>
							<!-- Navigation -->
							<nav class="navigation paging-navigation text-left mb-5" role="navigation">
								<?php
								//the_posts_navigation();
								$big = 999999999; // need an unlikely integer

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $query->max_num_pages
								) );
										
								// Reset main query object
								$wp_query = NULL;
								$wp_query = $temp_query;
								wp_reset_postdata(); ?>
							</nav><!-- .navigation -->
						<?php
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>

						<!-- /.blog-post -->
						<!--
						<nav class="blog-pagination">
							<a class="btn btn-outline-primary" href="#">Older</a>
							<a class="btn btn-outline-secondary disabled" href="#">Newer</a>
						</nav>
						-->
					</div>
					<!-- /.blog-main -->

					<?php get_sidebar(); ?>

				</div>				 
				<!-- /.row -->
			</main>

<?php
get_footer();
