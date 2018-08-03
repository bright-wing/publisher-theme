<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GIP
 */

?>

			<section class="content-block-nopad footer-wrap-1-1 bg-offwhite">
				<div class="container footer-1-1">
					<div class="row">
						<?php 
							/* Left Footer Widget */ 
							dynamic_sidebar( 'sidebar-2' ); 
						?>
						<div class="col-sm-6 col-sm-offset-1">
							<div class="row">
								<?php 
									/* Right Footer Widgets */ 
									dynamic_sidebar( 'sidebar-3' ); 
								?>
							</div>
						</div>
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container -->
			</section>

			<div class="copyright-bar bg-dark">
				<div class="container">
					<p class="pull-left small"><?php if( get_theme_mod( 'copyright') != "" ) {echo get_theme_mod( 'copyright');}else{ echo '&copy; Granville Island Publishing'; }?></p>
					<p class="pull-right small made-with-by">Made with <i class="fa fa-heart pomegranate"></i> by <a href="<?php echo esc_url( __( 'http://brightwing.ca/', 'gip' ) ); ?>" target="_blank">BRIGHT WING BOOKS</a></p>
				</div>
			</div>
		</main>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
