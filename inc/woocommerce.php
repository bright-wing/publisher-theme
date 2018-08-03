<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package GIP
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function gip_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'gip_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function gip_woocommerce_scripts() {
	wp_enqueue_style( 'gip-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'gip-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'gip_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function gip_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'gip_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function gip_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'gip_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function gip_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'gip_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function gip_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'gip_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function gip_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'gip_woocommerce_related_products_args' );

if ( ! function_exists( 'gip_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function gip_woocommerce_product_columns_wrapper() {
		$columns = gip_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'gip_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'gip_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function gip_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'gip_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'gip_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function gip_woocommerce_wrapper_before() {
		?>
		<main role="main" class="container margin-top60"> 
			<div class="row">
				<div class="col-md-8 blog-main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'gip_woocommerce_wrapper_before' );

if ( ! function_exists( 'gip_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function gip_woocommerce_wrapper_after() {
			?>

			</div><!-- end .col-md-8 -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'gip_woocommerce_wrapper_after' );



/**
 * After Sidebar.
 *
 * Closes the wrapping divs.
 *
 * @return void
 */
function gip_woocommerce_after_sidebar_content(){
?>
		</div><!-- end .row -->
	</main><!-- end .container -->
<?php
}
add_action( 'woocommerce_sidebar', 'gip_woocommerce_after_sidebar_content', 11);
/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'gip_woocommerce_header_cart' ) ) {
			gip_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'gip_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function gip_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		gip_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'gip_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'gip_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function gip_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'gip' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'gip' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'gip_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function gip_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php gip_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}




/**
 * Filter hook function monkey patching form classes
 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
 *
 * @param string $args Form attributes.
 * @param string $key Not in use.
 * @param null   $value Not in use.
 *
 * @return mixed
 */
if ( ! function_exists ( 'understrap_wc_form_field_args' ) ) {
	function understrap_wc_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			/* Targets all select input type elements, except the country and state select input types */
			case 'select' :
				// Add a class to the field's html element wrapper - woocommerce
				// input types (fields) are often wrapped within a <p></p> tag.
				$args['class'][] = 'form-group';
				// Add a class to the form input itself.
				$args['input_class']       = array( 'form-control', 'input-lg' );
				$args['label_class']       = array( 'control-label' );
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
					// Add custom data attributes to the form input itself.
				);
				break;
			// By default WooCommerce will populate a select with the country names - $args
			// defined for this specific input type targets only the country select element.
			case 'country' :
				$args['class'][]     = 'form-group single-country';
				$args['label_class'] = array( 'control-label' );
				break;
			// By default WooCommerce will populate a select with state names - $args defined
			// for this specific input type targets only the country select element.
			case 'state' :
				// Add class to the field's html element wrapper.
				$args['class'][] = 'form-group';
				// add class to the form input itself.
				$args['input_class']       = array( '', 'input-lg' );
				$args['label_class']       = array( 'control-label' );
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password' :
			case 'text' :
			case 'email' :
			case 'tel' :
			case 'number' :
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'textarea' :
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'checkbox' :
				$args['label_class'] = array( 'custom-control custom-checkbox' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			case 'radio' :
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			default :
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
		} // end switch ($args).
		return $args;
		
		if ( !is_page('checkout') ) {
		  add_filter('woocommerce_form_field_args','understrap_wc_form_field_args', 10, 3);
		} else {
		  remove_filter('woocommerce_form_field_args','understrap_wc_form_field_args', 10, 3);
		}

	}
}
add_action('woocommerce_form_field_args', 'understrap_wc_form_field_args', 10, 3);


/**
* Change loop add-to-cart button class to Bootstrap
*/
add_filter( 'woocommerce_loop_add_to_cart_args', 'understrap_woocommerce_add_to_cart_args', 10, 2 );

if ( ! function_exists ( 'understrap_woocommerce_add_to_cart_args' ) ) {
	function understrap_woocommerce_add_to_cart_args( $args, $product ) {
		$args['class'] = str_replace('button','btn btn-dark', 'button');
		return $args;
	}
}




/**
 * Redirect to Checkout
 */

add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');

function custom_add_to_cart_redirect() {
     return get_permalink(get_option('woocommerce_checkout_page_id')); // Replace with the url of your choosing
}


/**
 * @desc Remove in all product type
 */
function wc_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );

/**
 * Remove/Add actions
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'book_price', 'woocommerce_template_single_price' );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action('purchase_book', 'woocommerce_template_single_add_to_cart', 29);



// Remove the Product Description Title
add_filter('woocommerce_product_description_heading', 'gip_product_description_heading');
function gip_product_description_heading() {
	return '';
}



/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
	
	$tabs['description']['title'] = __( 'Author' );		// Rename the description tab
	$tabs['reviews']['title'] = __( 'Reviews' );				// Rename the reviews tab
	
	global $product;
	
	if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) { // Check if product has attributes, dimensions or weight
		$tabs['additional_information']['title'] = __( 'More Info' );	// Rename the additional information tab
	}
	
	return $tabs;

}




 
/*--------------------------------------------------------------
# Display Fields using WooCommerce Action Hook
--------------------------------------------------------------*/
add_action( 'woocommerce_product_options_general_product_data', 'woocom_general_product_data_custom_field' );

function woocom_general_product_data_custom_field() {
  // Create a custom text field
  
  // Subtitle (text field)
  woocommerce_wp_text_input( 
    array( 
      'id' => '_subtitle', 
      'label' => __( 'Subtitle', 'woocommerce' ), 
      'placeholder' => 'Subtitle...',
      'desc_tip' => 'true',
      'description' => __( 'Enter the subtitle here.', 'woocommerce' ) 
    )
  );
  
  
  // Author (text field)
  woocommerce_wp_text_input( 
    array( 
      'id' => '_author', 
      'label' => __( 'Author', 'woocommerce' ), 
      'placeholder' => 'Author name',
      'desc_tip' => 'true',
      'description' => __( 'Enter the author name here.', 'woocommerce' ) 
    )
  );
  
  // Series/Series Number (text field)
  woocommerce_wp_text_input( 
    array( 
      'id' => '_series', 
      'label' => __( 'Series', 'woocommerce' ), 
      'placeholder' => 'Series number',
      'desc_tip' => 'true',
      'description' => __( 'Enter the series number here.', 'woocommerce' ) 
    )
  ); 
  // ISBN (text field)
  woocommerce_wp_text_input( 
    array( 
      'id' => '_isbn', 
      'label' => __( 'ISBN', 'woocommerce' ), 
      'placeholder' => 'ISBN number',
      'desc_tip' => 'true',
      'description' => __( 'Enter the ISBN number here.', 'woocommerce' ) 
    )
  );
/*   // Book size (text field)
  woocommerce_wp_text_input( 
    array( 
      'id' => '_book_size', 
      'label' => __( 'Book size', 'woocommerce' ), 
      'placeholder' => 'Book size',
      'desc_tip' => 'true',
      'description' => __( 'Enter the book size here.', 'woocommerce' ) 
    )
  ); */
  // Page number (text field)
  woocommerce_wp_text_input( 
    array( 
      'id' => '_total_pages', 
      'label' => __( 'Pages', 'woocommerce' ), 
      'placeholder' => 'Total pages',
      'desc_tip' => 'true',
      'description' => __( 'Enter the total page number here.', 'woocommerce' ) 
    )
  );

}


/*--------------------------------------------------------------
# Hook to save the data value from the custom fields
--------------------------------------------------------------*/
add_action( 'woocommerce_process_product_meta', 'woocom_save_general_proddata_custom_field' );
/** Hook callback function to save custom fields information */
function woocom_save_general_proddata_custom_field( $post_id ) {
	  // Subtitle
	  $subtitle = $_POST['_subtitle'];
	  if( ! empty( $subtitle ) ) {
		 update_post_meta( $post_id, '_subtitle', esc_attr( $subtitle ) );
	  }
	  
	  // Author
	  $author = $_POST['_author'];
	  if( ! empty( $author ) ) {
		 update_post_meta( $post_id, '_author', esc_attr( $author ) );
	  }
	  
	  //Series
	  $series = $_POST['_series'];
	  if( ! empty( $series ) ) {
		 update_post_meta( $post_id, '_series', esc_attr( $series ) );
	  }

	  // isbn
	  $isbn = $_POST['_isbn'];
	  if( ! empty( $isbn ) ) {
		 update_post_meta( $post_id, '_isbn', esc_attr( $isbn ) );
	  }

	  /* // Book size
	  $book_size = $_POST['_book_size'];
	  if( ! empty( $book_size ) ) {
		 update_post_meta( $post_id, '_book_size', esc_attr( $book_size ) );
	  } */

	  // isbn
	  $total_pages = $_POST['_total_pages'];
	  if( ! empty( $total_pages ) ) {
		 update_post_meta( $post_id, '_total_pages', esc_attr( $total_pages ) );
	  }
}


/**
 * Redirect users after add to cart.
 */
function my_custom_add_to_cart_redirect( $url ) {
	$url = WC()->cart->get_checkout_url();
	// $url = wc_get_checkout_url(); // since WC 2.5.0
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );