<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GIP
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
		<header>
			<div class="collapse bg-dark" id="navbarHeader">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-md-7 py-4">
							<h4 class="text-white">Books that make a difference</h4>
							<p class="text-muted">Discover our catalogue and learn more about publishing with us.</p>
							<?php
								//primary menu 
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'menu_class'        => 'menu list-unstyled',
								) );
							?>
						</div>
						<div class="col-sm-4 offset-md-1 py-4">
							<h4 class="text-white">Connect</h4>
							<?php
								//Connect Menu
								wp_nav_menu( array(
									'theme_location' => 'menu-2',
									'menu_id'        => 'connect-menu',
									'menu_class'        => 'menu list-unstyled',
								) );
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="navbar navbar-dark bg-dark box-shadow">
				<div class="container d-flex justify-content-between">
					<?php if ( has_custom_logo() ) :
						the_custom_logo();
					else: ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand d-flex align-items-center"> <strong>GRANVILLE ISLAND PUBLISHING</strong> </a>
					<?php endif; ?>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
			</div>
		</header>
		<main role="main">
