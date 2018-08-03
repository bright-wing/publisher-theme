<?php
/**
 * Template Name: Contact Us
 * @package GIP
 */

get_header();
?>

			<?php
				$subtitle = get_post_meta( get_the_ID(), 'gip_page_subtitle', true );
			?>
			<section id="content-1-2" class="content-block content-1-2 bg-offwhite pad-bottom45">
				<div class="container pr-md-0">
					<!-- Start Row -->
					<div class="row">
						<div class="col-sm-8"> 
							<?php the_title( '<h1 class="text-left">', '</h1>' ); ?>
							<?php 
								if($subtitle){ 
									echo '<h3 class="text-left mt-md-3">'. $subtitle .'</h3>'; 
								}
							?>
						</div>
						<div class="col-md-4 pr-md-0 text-md-right text-left">
							<?php if( get_theme_mod( 'download_our_catalogue_button') != "" ) : ?>
								<a style="background: <?php echo get_theme_mod('download_our_catalogue_btn_color', '#007bff'); ?>; box-shadow: 0 2px <?php echo get_theme_mod('download_our_catalogue_btn_color', '#007bff'); ?>;"  href="<?php echo get_theme_mod( 'download_our_catalogue_button'); ?>" class="btn btn-secondary my-2">Download our catalogue</a> 
							<?php endif; ?>							 
						</div>
					</div>
					<!--// END Row -->
				</div>
			</section>
			<!-- <div class="map min-height-500px"></div> -->
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2603.2279375608414!2d-123.13830978461!3d49.27207797933018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x548673ce7cd64aef%3A0x4c0baab49f04bbcd!2sGranville+Island+Publishing!5e0!3m2!1sen!2sbd!4v1526535733879" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	
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
