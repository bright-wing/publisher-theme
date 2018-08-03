<?php
/**
 * Template Name: Home Page
 * @package GIP
 */

get_header();
?>

	<?php
		$hero_title = get_post_meta( get_the_ID(), 'gip_home_hero_title', true );
		$hero_content = get_post_meta( get_the_ID(), 'gip_home_hero_content', true );
		//$discover_our_books_url = get_post_meta( get_the_ID(), 'gip_home_discover_our_books_url', true );
		//$publish_with_us_url = get_post_meta( get_the_ID(), 'gip_home_publish_with_us_url', true );
		
	?>
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">
				<?php 
					if($hero_title){
						echo $hero_title;
					}else{
						echo "Granville Island Publishing";
					}
				?></h1>
			<p class="lead text-muted"><?php echo $hero_content ?></p>
			<p> 
				<?php if( get_theme_mod( 'discover_our_books_button') != "" ) : ?>
					<a style="background: <?php echo get_theme_mod('discover_our_books_btn_color', '#34495e'); ?>; box-shadow: 0 2px <?php echo get_theme_mod('discover_our_books_btn_color', '#34495e'); ?>;" href="<?php echo get_theme_mod( 'discover_our_books_button'); ?>" class="btn my-2 btn-dark">Discover our books</a> 
				<?php endif; ?>
				
				<?php if( get_theme_mod( 'publish_with_us_button') != "" ) : ?>
					<a style="background: <?php echo get_theme_mod('publish_with_us_btn_color', '#007bff'); ?>; box-shadow: 0 2px <?php echo get_theme_mod('publish_with_us_btn_color', '#007bff'); ?>;"  href="<?php echo get_theme_mod( 'publish_with_us_button'); ?>" class="btn btn-secondary my-2">Publish with us</a> 
				<?php endif; ?>
			</p>
		</div>
	</section>
	
	<!-- Books -->
	<section class="content-block gallery-2 bg-light bg-offwhite">
		<div class="container">
			<div class="row books grid">
				<?php 
				$args = array(
					'post_type' => 'product',
					'posts_per_page'=> 8,
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
						<div class="grid-item col-md-3 col-sm-6 col-6">
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
	<?php
		$about_us_subtitle = get_post_meta( get_the_ID(), 'gip_about_us_subtitle', true );
		$about_us_content = get_post_meta( get_the_ID(), 'gip_home_about_us_content', true );
		$our_story_btn_url = get_post_meta( get_the_ID(), 'gip_home_our_story_btn_url', true );
		$about_us_image = get_post_meta( get_the_ID(), 'gip_home_about_us_image', true );
	?>
	<section id="content-1-2" class="content-block content-1-2">
		<div class="container">
			<!-- Start Row -->
			<div class="row">
				<div class="col-sm-6"> 
					<h1>About us</h1> 
					<p class="lead"><?php if($about_us_subtitle){ echo $about_us_subtitle;} ?></p> 
					<p><?php if($about_us_content){ echo $about_us_content;} ?></p> 
					<div class="row">
						<div class="col-sm-5 col-xs-12">
							<a href="<?php if($our_story_btn_url){ echo $our_story_btn_url;} ?>" class="btn btn-block btn-dark">Our story</a>
						</div>
					</div>							 
				</div>
				<div class="col-sm-5 col-sm-offset-1 offset-sm-1">
					<?php if($about_us_image){ ?>
					<img class="img-rounded img-fluid" src="<?php  echo $about_us_image; ?>">
					<?php } ?>
				</div>
			</div>
			<!--// END Row -->
		</div>
	</section>

	<div class="content-block blog-1 bg-offwhite">
		<div class="container text-center">
			<div class="underlined-title pb-md-0">
				<h1 class="text-left">From our blog</h1>
			</div>
			<div class="col-sm-offset-1 col-sm-12 p-0">
				<?php 
				if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
				elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
				else { $paged = 1; }
				$args = array(
					'post_type' => 'post',
					'posts_per_page'=> 1,
					'paged' => $paged,
					'ignore_sticky_posts' => 1,
					'orderby' => '',
				);

				// the query
				$custom_query = new WP_Query( $args ); 
				
				// Pagination fix
				$temp_query = $wp_query;
				$wp_query   = NULL;
				$wp_query   = $custom_query;
				?>

				
				
				<?php if ( $custom_query->have_posts() ) : ?>
				
					<!-- the loop -->
					<?php 
						while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
							<div class="post">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('post-thumb', array('class'=>'img-fluid img-responsive w-100')); ?></a>
								<p class="text-left"><?php echo wp_trim_words( get_the_content(), 70, '...' ); ?></p>
								<div class="text-left">
									<p class="small text-muted text-uppercase">POSTED BY <?php echo gip_posted_by(); ?> IN <?php echo get_the_category_list( esc_html__( ', ', 'gip' ) ); ?>  ON <?php gip_posted_on(); ?></p>
									<a href="<?php the_permalink(); ?>" class="btn btn-lg btn-dark">Read More</a>
								</div>
							</div><!-- #post-<?php the_ID(); ?> -->
					<?php
						endwhile; 
						wp_reset_postdata(); 
					?>
				<?php else : ?>
					<div class="col-md-12"><?php esc_html_e( 'Sorry, no posts found.' ); ?></div>
				<?php endif; ?>
				<hr>
				<!-- Navigation -->
				<nav class="navigation paging-navigation text-left" role="navigation">
					<?php
					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $custom_query->max_num_pages
					) );
					
					// Reset main query object
					$wp_query = NULL;
					$wp_query = $temp_query;
					?>
				</nav><!-- .navigation -->
			</div>
			<!-- /.col-sm-10 -->
		</div>
		<!-- /.container -->
	</div>
	
	<div class="content-block contact-3">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div id="contact" class="form-container">
						<fieldset>
							<div id="message"></div>
								<?php 
									/* contact form */ 
									dynamic_sidebar( 'sidebar-4' ); 
								?>
						</fieldset>
					</div>
					<!-- /.form-container -->
				</div>
				<?php 
					/* How to find us widget */ 
					dynamic_sidebar( 'sidebar-5' ); 
				?>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</div>

	
<?php
get_footer();
