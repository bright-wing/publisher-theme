<?php
/**
 * GIP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GIP
 */
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

if ( ! function_exists( 'gip_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gip_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on GIP, use a find and replace
		 * to change 'gip' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gip', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'post-thumb', 1110, 378, true);
		add_image_size( 'post-thumb-sm', 200, 250, true);
		
		
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'gip' ),
			'menu-2' => esc_html__( 'Connect', 'gip' ),
			'menu-3' => esc_html__( 'Shortcuts', 'gip' ),
			'menu-4' => esc_html__( 'Media', 'gip' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'gip_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'gip_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gip_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'gip_content_width', 640 );
}
add_action( 'after_setup_theme', 'gip_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gip_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gip' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gip' ),
		'before_widget' => '<div id="%1$s" class="p-3 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="font-italic">',
		'after_title'   => '</h4>',
	) );

	//footer widgets
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Left', 'gip' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widget here.', 'gip' ),
		'before_widget' => '<div id="%1$s" class="col-sm-5 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="text-dark widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets Right', 'gip' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'gip' ),
		'before_widget' => '<div id="%1$s" class="col-md-4 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="text-dark widget-title ">',
		'after_title'   => '</h4>',
	) );
	//Contact Form Widget
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Form Widget', 'gip' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( '', 'gip' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="text-dark widget-title ">',
		'after_title'   => '</h2>',
	) );
	//How to find us Widget
	register_sidebar( array(
		'name'          => esc_html__( 'How to find us Widget', 'gip' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( '', 'gip' ),
		'before_widget' => '<div id="%1$s" class="col-md-6 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="text-dark widget-title ">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gip_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gip_scripts() {
	wp_enqueue_style( 'gip-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '4', 'all');
	wp_enqueue_style( 'gip-album', get_template_directory_uri() . '/css/album.css', array(), '1', 'all');
	wp_enqueue_style( 'gip-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', array(), '4.6.3', 'all');
	wp_enqueue_style( 'gip-blocks', get_template_directory_uri() . '/css/pg.blocks/blocks.css', array(), '', 'all');
	wp_enqueue_style( 'gip-plugins', get_template_directory_uri() . '/css/pg.blocks/plugins.css', array(), '1.3.3', 'all');
	wp_enqueue_style( 'gip-style-library', get_template_directory_uri() . '/css/pg.blocks/style-library-1.css', array(), '1.3.3', 'all');
	wp_enqueue_style( 'gip-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700', false, '', 'all');
	wp_enqueue_style( 'gip-lato',  'http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic', false, '', 'all');
	wp_enqueue_style( 'gip-style', get_stylesheet_uri() );
	

	//wp_deregister_script('jquery');
	//wp_enqueue_script('gip-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), null, true);
	//wp_enqueue_script('gip-jquery',  'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), null, true);
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'gip-proper', get_template_directory_uri() . '/assets/js/popper.js', array ( 'jquery' ), '1.12.5', true);
	wp_enqueue_script( 'gip-ie10-viewport-bug-workaround', get_template_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.js', array (), '', true);
	//wp_enqueue_script( 'gip-bskit-scripts', get_template_directory_uri() . '/js/pg.blocks/bskit-scripts.js', array ( 'gip-jquery' ), '', true);
	wp_enqueue_script( 'gip-plugins', get_template_directory_uri() . '/js/pg.blocks/plugins.js', array (), '', true);
	wp_enqueue_script( 'gip-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array (), '4', true);
	wp_enqueue_script( 'gip-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array (), '3.0.6', true);
	wp_enqueue_script( 'gip-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array (), '4.1.4', true);
	wp_enqueue_script( 'gip-custom', get_template_directory_uri() . '/js/custom.js', array (), '1.1', true);	
	
	
	//wp_enqueue_script( 'gip-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	//wp_enqueue_script( 'gip-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gip_scripts' );




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom Comments.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}





/**
 * CMB2 Metaboxes
 */
if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}



add_action( 'cmb2_admin_init', 'gip_register_home_page_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'Home' page
 */
function gip_register_home_page_metabox() {
	$prefix = 'gip_home_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_home_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Home Page Metabox', 'cmb2' ),
		'object_types' => array( 'page' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'show_on'      => array(
			'id' => array( 4 ),
		), // Specific post IDs to display this metabox
	) );

	$cmb_home_page->add_field( array(
		'name' => esc_html__( 'Hero Title', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'hero_title',
		'type' => 'text',
	) );
	$cmb_home_page->add_field( array(
		'name' => esc_html__( 'Hero Content', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'hero_content',
		'type' => 'textarea',
	) );
	/*$cmb_home_page->add_field( array(
		'name' => esc_html__( 'Discover Our Books Button', 'cmb2' ),
		'desc' => esc_html__( 'insert the link', 'cmb2' ),
		'id'   => $prefix . 'discover_our_books_url',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );
	$cmb_home_page->add_field( array(
		'name' => esc_html__( 'Publish With Us  Button', 'cmb2' ),
		'desc' => esc_html__( 'insert the link', 'cmb2' ),
		'id'   => $prefix . 'publish_with_us_url',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );*/
	
	$cmb_home_page->add_field( array(
		'name' => esc_html__( 'About Us Subtitle', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'about_us_subtitle',
		'type' => 'text',
	) );
	$cmb_home_page->add_field( array(
		'name' => esc_html__( 'About Us Content', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'about_us_content',
		'type' => 'textarea',
	) );
	$cmb_home_page->add_field( array(
		'name' => esc_html__( 'Our Story Button', 'cmb2' ),
		'desc' => esc_html__( 'insert the link', 'cmb2' ),
		'id'   => $prefix . 'our_story_btn_url',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );
	$cmb_home_page->add_field( array(
		'name' => esc_html__( 'About Us Image', 'cmb2' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'cmb2' ),
		'id'   => $prefix . 'about_us_image',
		'type' => 'file',
	) );
	
}


add_action( 'cmb2_admin_init', 'gip_register_page_subtitle_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'Home' page
 */
function gip_register_page_subtitle_metabox() {
	$prefix = 'gip_page_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_page_subtitle = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Page Subtitle Metabox', 'cmb2' ),
		'object_types' => array( 'page' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		/* 'show_on'      => array(
			'id' => array( 4 ),
		), // Specific post IDs to display this metabox */
	) );
	
	$cmb_page_subtitle->add_field( array(
		'name' => esc_html__( 'Sub Title', 'cmb2' ),
		'desc' => esc_html__( 'Write page subtitle', 'cmb2' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
	) );
}


add_action( 'cmb2_admin_init', 'gip_register_post_subtitle_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'Home' page
 */
function gip_register_post_subtitle_metabox() {
	$prefix = 'gip_post_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_page_subtitle = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Post Subtitle Metabox', 'cmb2' ),
		'object_types' => array( 'post' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		/* 'show_on'      => array(
			'id' => array( 4 ),
		), // Specific post IDs to display this metabox */
	) );
	
	$cmb_page_subtitle->add_field( array(
		'name' => esc_html__( 'Sub Title', 'cmb2' ),
		'desc' => esc_html__( 'Write post subtitle', 'cmb2' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
	) );
}


/*--------------------------------------------------------------
# Custom Fields for 'book' Custom Post Type
--------------------------------------------------------------*/
add_action( 'cmb2_admin_init', 'my_book_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function my_book_metabox() {
	$prefix = 'book_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Book Metabox', 'cmb2' ),
		'object_types'  => array( 'book', ), // Post type
	) );



	
	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Sub title', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'sub_title',
		'type' => 'text',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Author name', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'author',
		'type' => 'text',
	) );

}