<?php
/**
 * pharmeon_master_theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package pharmeon_master_theme
 */

require( get_template_directory() . '/inc/customizer.php' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( !function_exists ( 'pharmeon_master_theme_setup' ) ) {
	function pharmeon_master_theme_setup() {
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'Pharmeon Master Theme' ),
		) ); 

	}
	add_action( 'after_setup_theme', 'pharmeon_master_theme_setup' );
}

if ( !function_exists ('remove_nonused_widgets') ) {
	function remove_nonused_widgets() 
	{
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
		//unregister_widget('WP_Widget_Text');
		//unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Nav_Menu_Widget');
	}
	add_action( 'widgets_init', 'remove_nonused_widgets' );
}

if ( !function_exists ('pharmeon_master_theme_vars') ) {
	function pharmeon_master_theme_vars () {
		global $headerImgWidth, $headerImgHeight;
		$headerImgWidth = '1280';
		$headerImgHeight = '500';
	}
	add_action( 'after_setup_theme', 'pharmeon_master_theme_vars' );
}


if ( !function_exists ('logo_upload') ) {
	function logo_upload( $wp_customize ) {
	    $wp_customize->add_section( 'logo_upload_section' , array(
		    'title'       => __( 'Logo', 'Pharmeon Master Theme' ),
		    'priority'    => 30,
		    'description' => 'Upload een logo in uw design',
		) );

		$wp_customize->add_setting( 'pharmeon_master_theme_logo' );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pharmeon_master_theme_logo', array(
		    'label'    	=> __( 'Logo', 'Pharmeon Master Theme' ),
		    'section'  	=> 'logo_upload_section',
		    'settings' 	=> 'pharmeon_master_theme_logo',
		) ) );
	}
	add_action( 'customize_register', 'logo_upload' );
}

if ( !function_exists ('pharmeon_master_theme_custom_header_setup') ) {
	function pharmeon_master_theme_custom_header_setup() {
		global $headerImgWidth, $headerImgHeight;
		add_theme_support( 'custom-header', apply_filters( 'pharmeon_master_theme_custom_header_args', array(
			'default-image'          => get_stylesheet_directory_uri() . '/images/defaultHeaderImage.jpg',
			'width'                  => $headerImgWidth,
			'height'                 => $headerImgHeight,
			'flex-height'            => true,
			'flex-width' 			 => true,
		) ) );

		register_default_headers( array(
	   		'mypic' => array(
	    	'url'   => get_stylesheet_directory_uri() . '/images/defaultHeaderImage.jpg',
	    	'thumbnail_url' => get_stylesheet_directory_uri() . '/images/defaultHeaderImage-thumb.jpg',
	    	'description'   => _x( 'DefaultImage', 'Standaard header afbeelding', 'pharmeon_master_theme' )),
		));
	}
	add_action( 'after_setup_theme', 'pharmeon_master_theme_custom_header_setup' );
}


if ( !function_exists ('pharmeon_master_theme_scripts') ) {
	function pharmeon_master_theme_scripts() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css');		
		wp_enqueue_script( 'pharmeon_master_theme-jquery-2.1.4', get_template_directory_uri() . '/js/jquery-2.1.4.min.js', array(), '20150908', true );
		wp_enqueue_script( 'pharmeon_master_theme-script',  get_template_directory_uri(). '/js/style.js', array(), '20150908', true );

	}
	// add scripts BEFORE child scripts (10 is default priority)
	add_action( 'wp_enqueue_scripts', 'pharmeon_master_theme_scripts', 9 );
}


