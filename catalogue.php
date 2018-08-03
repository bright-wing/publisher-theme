<?php
/**
 * Template Name: Catalogue
 * @package GIP
 */

get_header();
?>

			<section id="content-1-2" class="content-block content-1-2 bg-offwhite">
				<div class="container">
					<!-- Start Row -->
					<div class="row">
						<div class="col-sm-8"> 
							<?php the_title( '<h1 class="entry-title text-left">', '</h1>' ); ?>
							<?php $page_subtitle = get_post_meta( get_the_ID(), 'gip_page_subtitle', true ); ?>
							<?php if($page_subtitle): ?>
							<h3 class="text-left mt-md-3"><?php echo $page_subtitle; ?></h3> 
							<?php endif; ?>						 							 							 
						</div>
						<div class="col-md-4">
							<?php if( get_theme_mod( 'download_our_catalogue_button') != "" ) : ?>
								<a style="background: <?php echo get_theme_mod('download_our_catalogue_btn_color', '#007bff'); ?>; box-shadow: 0 2px <?php echo get_theme_mod('download_our_catalogue_btn_color', '#007bff'); ?>;"  href="<?php echo get_theme_mod( 'download_our_catalogue_button'); ?>" class="btn btn-secondary my-2">Download our catalogue</a> 
							<?php endif; ?>	 
						</div>
					</div>

					<ul class="filter-button-group filter pb-md-0 mt-md-5 mb-md-0">
						<li class="active">
							<a href="#" data-filter="*">All</a>
						</li>

					<?php
					$book_cats = get_terms( array( 
						'taxonomy' => 'product_cat',
						'parent'   => 0
					) );

					if ( $book_cats && ! is_wp_error( $book_cats ) ) : 
					foreach ( $book_cats as $book_cat ) {?>
						<li>
							<a href="#" data-filter=".<?php echo $book_cat->slug;?>"><?php echo $book_cat->name;?></a>
						</li>
					<?php }
					endif;
					?>

					</ul>
					<!--// END Row -->
				</div>
			</section>
			<section class="content-block gallery-1 gallery-1-3">
				<div class="container">
					<!-- /.gallery-filter -->
					<section class="content-block gallery-2 pt-md-2">
						<div class="container">
							<div class="row grid">
								<?php 
								$args = array(
									'post_type' => 'product',
									'posts_per_page'=> -1,
									'orderby' => 'rand',
									/* 'tax_query' => array(
										array(
											'taxonomy' => 'genre',
											'field'    => 'slug',
											'terms'    => '',
										),
									), */
								);
								// the query
								$the_query = new WP_Query( $args ); ?>

								<?php if ( $the_query->have_posts() ) : ?>
								
									<!-- the loop -->
									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<div class="grid-item col-md-3 col-sm-6 col-xs-12 <?php  
																						$terms = wp_get_post_terms( get_the_ID(), 'product_cat' );
																												 
																						if ( $terms && ! is_wp_error( $terms ) ) : 
																							foreach ( $terms as $term ) {
																								echo ' ' . $term->slug .' ';
																							}
																						endif; 
																					  ?>">
											<figure class="effect-lily">
												<?php the_post_thumbnail('full', array('class'=>'img-fluid')); ?>
												<figcaption class="bg-black-hover">
													<a href="<?php the_permalink(); ?>">View more</a>
												</figcaption>								 
											</figure>
										</div>
									<?php endwhile; ?>
									<!-- end of the loop -->

									<?php wp_reset_postdata(); ?>

								<?php else : ?>
									<div class="col-md-12"><?php esc_html_e( 'Sorry, no books found.' ); ?></div>
								<?php endif; ?>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.container -->
					</section>
					<!-- /.row -->
				</div>
				<!-- /.container -->
			</section>

	
<?php
get_footer();
