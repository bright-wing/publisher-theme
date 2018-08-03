<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GIP
 */

get_header();
?>

			
			<section id="content-1-2" class="content-block content-1-2 bg-offwhite pad-bottom45">
				<div class="container pr-md-0">
					<!-- Start Row -->
					<div class="row">
						<div class="col-sm-6"> 
							<?php the_title( '<h1 class="entry-title text-left">', '</h1>' ); ?>
							<?php $post_subtitle = get_post_meta( get_the_ID(), 'gip_post_subtitle', true ); ?>
							<?php if($post_subtitle): ?>
							<h3 class="text-left mt-md-3"><?php echo $post_subtitle; ?></h3> 
							<?php endif; ?>
						</div>
						
						
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
								get_template_part( 'template-parts/content', 'sticky2' );
								endwhile; 
								wp_reset_postdata(); 
							?>
						<?php else : ?>
							<div class="col-md-12"><?php esc_html_e( 'Sorry, no sticky posts found.' ); ?></div>
						<?php endif; ?>
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
						
						<section class="comments-area mt-5">
							<?php	
								// If comments are open or we have at least one comment, load up the comment template.
								 if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif; 
							?>
						</section>
					</div>
					<!-- /.blog-main -->
					
					<?php get_sidebar(); ?>

				</div>				 
				<!-- /.row -->
			<?php
			endwhile; // End of the loop.
			?>	
			</main>

				<section class="content-block team-2 team-2-2 bg-white">
					<div class="container">
						<div class="underlined-title">
							<h2 class="text-left">Suggested Reading</h2>
						</div>
						<div class="row">
							<?php
								$post_id = $post->ID;
								//$post_ids = get_option( 'sticky_posts' );
								//array_push($post_ids, $post_id);
								//print_r($post_ids);
								
								$categories = array();
								$_categories = get_the_category($post_id);
								foreach ($_categories as $_cat) {
									$categories[] = $_cat->term_id;
								}

								$args = array(
										'orderby' => 'rand', //important to fetch random posts
										'post_type' => 'post',
										'posts_per_page' => 4,
										'post__not_in' => array($post_id), //exclude the same post
										'category__in' => $categories,
										'post_status'=>'publish',
										//'ignore_sticky_posts' => 1
									);
								//$related_posts = get_posts($args);
								$related_posts = new WP_Query( $args );
								
								while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
									<div class="col-md-3 col-sm-6 col-xs-12 team-wrapper">
										<figure class="effect-lily">
											<div class="card mb-4 effect-lily box-shadow">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('post-thumb', array('class'=>'img-fluid img-responsive card-img-top w-100')); ?></a>
											</div>									 
										</figure>
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
									</div>
								<?php 
								endwhile; 
								wp_reset_postdata(); 
								?>
							<!-- /.gallery-item-wrapper -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container -->
				</section>




<?php
get_footer();
