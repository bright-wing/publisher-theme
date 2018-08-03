<?php
/**
 * GIP Theme Customizer
 *
 * @package GIP
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gip_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'gip_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'gip_customize_partial_blogdescription',
		) );
	}
	
	
	
	/**
	* Add call to action buttons section
	*/
	$wp_customize->add_section( 'call_to_action_btns' , array(
		'title'      => __( 'Call to Action Buttons ', 'gip' ),
		'priority'   => 30,
		//'description' => __('Allows you to customize call to actions buttons settings for GIP theme.', 'gip'), 
	) );	
	
/*---------------------- Discover our books --------------------------*/
	/*-------- add button ------*/
	$wp_customize->add_setting( 'discover_our_books_button' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( 'discover_our_books_button', array(
	  'label' => __( 'Discover our books link' ),
	  'type' => 'text',
	  'section' => 'call_to_action_btns',
	) );	
	
	/*-------- add button color ------*/
	$wp_customize->add_setting( 'discover_our_books_btn_color' , array(
		'default'   => '#545b62',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'discover_our_books_btn', array(
		'label'      => __( 'Discover our books button color', 'gip' ),
		'section'    => 'call_to_action_btns',
		'settings'   => 'discover_our_books_btn_color',
	) ) );
	
	
	
/*---------------------- Publish with us --------------------------*/
	/*-------- add button ------*/
	$wp_customize->add_setting( 'publish_with_us_button' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( 'publish_with_us_button', array(
	  'label' => __( 'Publish with us link' ),
	  'type' => 'text',
	  'section' => 'call_to_action_btns',
	) );	
	
	/*-------- add button color ------*/
	$wp_customize->add_setting( 'publish_with_us_btn_color' , array(
		'default'   => '#0056b3',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'publish_with_us_btn', array(
		'label'      => __( 'Publish with us button color', 'gip' ),
		'section'    => 'call_to_action_btns',
		'settings'   => 'publish_with_us_btn_color',
	) ) );

	
/*---------------------- Download our catalogue --------------------------*/
	/*-------- add button ------*/
	$wp_customize->add_setting( 'download_our_catalogue_button' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( 'download_our_catalogue_button', array(
	  'label' => __( 'Download our catalogue link' ),
	  'type' => 'text',
	  'section' => 'call_to_action_btns',
	) );	
	
	/*-------- add button color ------*/
	$wp_customize->add_setting( 'download_our_catalogue_btn_color' , array(
		'default'   => '#545b62',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'download_our_catalogue_btn', array(
		'label'      => __( 'Download our catalogue button color', 'gip' ),
		'section'    => 'call_to_action_btns',
		'settings'   => 'download_our_catalogue_btn_color',
	) ) );
	
	
	
	
	
	// Add a footer/copyright information section.
	$wp_customize->add_section( 'footer' , array(
	  'title' => __( 'Footer', 'gip' ),
	  'priority' => 500, 
	  'panel' => '', // Not typically needed.
	) );
	$wp_customize->add_setting( 'copyright', array(
	  'default' => 'copyright notice',
	  'sanitize_callback' => 'sanitize_text',
	) );
	$wp_customize->add_control( 'copyright', array(
	  'label' => __( 'Copyright' ),
	  'type' => 'text',
	  'section' => 'footer',
	) );	
		
	
 	// Sanitize text
	function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}
	
}
add_action( 'customize_register', 'gip_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gip_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gip_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gip_customize_preview_js() {
	wp_enqueue_script( 'gip-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'gip_customize_preview_js' );




