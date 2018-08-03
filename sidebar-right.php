<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package GIP
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

?>


<div class="col-md-4 widget-area" id="right-sidebar" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
