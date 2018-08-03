<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<section id="content-1-2" class="content-block content-1-2 bg-offwhite pad-bottom45">
			<div class="container pr-md-0">
				<!-- Start Row -->
				<div class="row">
					<div class="col-sm-8"> 
						<?php //the_title( '<h1 class="text-left">', '</h1>' ); ?>
						<h1>Our Books</h1>
						<h3>
							<?php
							/*$book_cats = get_terms( array( 
								'taxonomy' => 'product_cat',
								'parent'   => 0
							) );*/
							
							$book_cats = get_the_terms( $post->ID, 'product_cat' );

							if ( $book_cats && ! is_wp_error( $book_cats ) ) : 
							foreach ( $book_cats as $book_cat ) {
								echo $book_cat->name.' ';
							}
							endif;
							?>
						</h3>

					</div>
					<div class="col-md-4 pr-md-0 text-md-right text-left">
						<?php do_action( 'purchase_book' ); ?>
						<!-- <button type="button" class="btn btn-dark">Purchase</button> -->						 
					</div>
				</div>
				<!--// END Row -->
			</div>
		</section>
		

			
		<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			//do_action( 'woocommerce_before_main_content' );
		?>



				<?php wc_get_template_part( 'content', 'single-product' ); ?>



		<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			//do_action( 'woocommerce_after_main_content' );
		?>

		<?php
			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			//do_action( 'woocommerce_sidebar' );
		?>
	<?php endwhile; // end of the loop. ?>	

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
