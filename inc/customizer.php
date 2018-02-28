<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Some files that handle the customizer stuff on the front end
 *
 * @package twilitgrotto
 */

require_once 'googlefonts.php';
require_once 'header_message.php';
require_once 'get_logo.php';

/**
 * twilitgrotto Theme Customizer
 *
 * @package twilitgrotto
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function twilitgrotto_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	// This section is for the site specific data options
	$wp_customize->add_section( 'site_settings' , array(
		'title'      => 'Site Settings',
		'priority'   => 49,
	) );

	$wp_customize->add_setting( 'site_phone', array(
		'default'           => null,
		'sanitize_callback' => '',
	) );

	$wp_customize->add_control( 'site_phone', array(
	 	'label'    => 'Site Phone Number',
	 	'section'  => 'site_settings',
	 	'type'     => 'text',
	 	'default' => null,
	 	'priority' => 90
	) );
	
	$wp_customize->add_setting( 'header_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'header_color', 
		array(
			'label'      => 'Header Color' ,
			'section'    => 'colors',
			'settings'   => 'header_color',
		) ) 
	);	


	// This section allows the creation of basic font styles through the customizer
	$wp_customize->add_section( 'layout_settings' , array(
		'title'      => 'Layout Settings',
		'priority'   => 29,
	) );

	$wp_customize->add_setting( 'sidebar_location', array(
		'default'           => 0,
	) );

	$wp_customize->add_control( 'sidebar_location', array(
	 	'label'    => 'Sidebar Location',
	 	'section'  => 'layout_settings',
	 	'type'     => 'select',
	 	'choices' => array( 0 => 'Right', 1 => 'Left', 2 => 'Bottom', 3 => 'None'),
	 	'default' => 0,
	 	'priority' => 3
	) );

	$wp_customize->add_setting( 'show_home_callout', array(
		'default'           => 0,
	) );

	$wp_customize->add_control( 'show_home_callout', array(
	 	'label'    => 'Show Home Callout',
	 	'section'  => 'layout_settings',
	 	'type'     => 'select',
	 	'choices' => array( 0 => 'None', 1 => 'Center (Only with Header Hero Image)', 2 => 'Stick to Top (Home Only)', 3 => 'Stick to Top (All Pages)'),
	 	'default' => 0,
	 	'priority' => 89
	) );

	$wp_customize->add_setting( 'home_callout_message', array(
		'default'           => null,
		'sanitize_callback' => '',
	) );

	$wp_customize->add_control( 'home_callout_message', array(
	 	'label'    => 'Home Callout Message',
	 	'section'  => 'layout_settings',
	 	'type'     => 'textarea',
	 	'default' => null,
	 	'priority' => 90
	) );


	// This section allows the creation of basic font styles through the customizer
	$wp_customize->add_section( 'font_options' , array(
		'title'      => 'Font Options',
		'priority'   => 30,
	) );


	$google_fonts = tg_set_google_fonts();

	$fonts['Georgia']= 'Georgia, serif';
	$fonts['Tahoma'] = 'Tahoma, sans-serif';

	if( $google_fonts ){
		foreach ($google_fonts->items as $key => $value) {
	 		$fonts[ $value->family ] = $value->family;
		 } 

		// Google Fonts - Headings

		$wp_customize->add_setting( 'header_font', array(
			'default'           => 'Tahoma, sans-serif',
			'sanitize_callback' => '',
		) );

		$wp_customize->add_control( 'header_font', array(
		 	'label'    => 'Header Font',
		 	'section'  => 'font_options',
		 	'type'     => 'select',
		 	'choices' => $fonts,
		 	'default' => false,
		 	'priority' => 3
		) );

		// Google Fonts - Body

		$wp_customize->add_setting( 'body_font', array(
			'default'           => 'Georgia, serif',
			'sanitize_callback' => '',
		) );

		$wp_customize->add_control( 'body_font', array(
		 	'label'    => 'Body Font',
		 	'section'  => 'font_options',
		 	'type'     => 'select',
		 	'choices' => $fonts,
		 	'default' => false,
		 	'priority' => 3
		) );

	}

 
}
add_action( 'customize_register', 'twilitgrotto_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function twilitgrotto_customize_preview_js() {
	wp_enqueue_script( 'twilitgrotto_customizer', get_template_directory_uri() . '/inc/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'twilitgrotto_customize_preview_js' );



