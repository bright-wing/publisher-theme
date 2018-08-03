<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
 ?>
 
 
 
 <hr class="w-50 margin-bottom30 margin-top30">
 <p id="pages">
	 <?php global $post; ?>
	 
	 <?php $isbn_no = get_post_meta( $post->ID, "_isbn", true ); ?>
	 <?php if($isbn_no){echo 'ISBN: <span id="isbn">'.$isbn_no . ' </span><br>'; } ?> 
	 
	 <?php 
		global $product;
		if ( $product->has_dimensions() ) : ?>
		<span id="width"> <?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?> </span> <br>
	 <?php endif; ?>
	 
	 <?php $no_of_pages = get_post_meta( $post->ID, "_total_pages", true ); ?>
	 <?php if($no_of_pages){echo '<span>'.$no_of_pages . ' Pages </span> <br>'; } ?> 
	 CDN/USD <span id="price"> <?php do_action( 'book_price' );?></span>
 </p>
 
 
 
 
<?php

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="nav-fill margin-top45 tabs wc-tabs " role="tablist">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="tab-pane woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>
