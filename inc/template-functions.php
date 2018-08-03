<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package GIP
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gip_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gip_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gip_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'gip_pingback_header' );




/*--------------------------------------------------------------
# Book Custom Post Type 
--------------------------------------------------------------*/

/*add_action( 'init', 'book_cpt_init' );*/
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
/*function book_cpt_init() {
	$labels = array(
		'name'               => _x( 'Books', 'post type general name', 'gip-textdomain' ),
		'singular_name'      => _x( 'Book', 'post type singular name', 'gip-textdomain' ),
		'menu_name'          => _x( 'Books', 'admin menu', 'gip-textdomain' ),
		'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'gip-textdomain' ),
		'add_new'            => _x( 'Add New', 'book', 'gip-textdomain' ),
		'add_new_item'       => __( 'Add New Book', 'gip-textdomain' ),
		'new_item'           => __( 'New Book', 'gip-textdomain' ),
		'edit_item'          => __( 'Edit Book', 'gip-textdomain' ),
		'view_item'          => __( 'View Book', 'gip-textdomain' ),
		'all_items'          => __( 'All Books', 'gip-textdomain' ),
		'search_items'       => __( 'Search Books', 'gip-textdomain' ),
		'parent_item_colon'  => __( 'Parent Books:', 'gip-textdomain' ),
		'not_found'          => __( 'No books found.', 'gip-textdomain' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'gip-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Current and Upcoming Books.', 'gip-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'menu_icon'   => 'dashicons-book',   
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'book', $args );
}

function my_rewrite_flush() {
    book_cpt_init();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );*/


/*
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_book_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_book_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'gip-textdomain' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'gip-textdomain' ),
		'search_items'      => __( 'Search Genres', 'gip-textdomain' ),
		'all_items'         => __( 'All Genres', 'gip-textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'gip-textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'gip-textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'gip-textdomain' ),
		'update_item'       => __( 'Update Genre', 'gip-textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'gip-textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'gip-textdomain' ),
		'menu_name'         => __( 'Genre', 'gip-textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'book' ), $args );
}*/