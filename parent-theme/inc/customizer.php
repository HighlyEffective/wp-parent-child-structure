<?php
/**
 * Theme Customizer.
 *
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pharmeon_master_theme_customize_register( $wp_customize ) {
	
	/*******************************************
	Color scheme
	********************************************/
 
	// add the section to contain the settings
	$wp_customize->add_section( 'textcolors' , array(
	    'title' =>  'Thema kleur',
	    'priority' => 20
	) );
	// main color ( site title, h1, h2, h4. h6, widget headings, nav links, footer headings )
	$txtcolors[] = array(
	    'slug'=>'base_color', 
	    'default' => '#1792d5',
	    'label' => 'Basis kleur'
	);
	// add the settings and controls for each color
	foreach( $txtcolors as $txtcolor ) 
	{
	    // SETTINGS
	    $wp_customize->add_setting(
	        $txtcolor['slug'], array(
	            'default' => $txtcolor['default'],
	            'type' => 'option', 
	            'capability' =>  'edit_theme_options'
	        )
	    );
		// CONTROLS
		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        $txtcolor['slug'], 
		        array('label' => $txtcolor['label'], 
		        'section' => 'textcolors',
		        'settings' => $txtcolor['slug'])
		    )
		);
	}
	
	
}
add_action( 'customize_register', 'pharmeon_master_theme_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function pharmeon_master_theme_customize_preview_js() {
	wp_enqueue_script( 'pharmeon_master_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pharmeon_master_theme_customize_preview_js' );

function pharmeon_master_theme_customize_colors() {
	//check if plugin is activated (if it isnt itll break the theme)
	if ( class_exists( 'Pre_Processors_Compiler' ) ) {
		$color = get_option( 'base_color' );
		try
		{
			//$options = array( 'compress'=>true );
			$parser = new Less_Parser( /* $options */ );
			//$parser = new Less_Parser();
			$parser->parse( '@customColor: '.$color.';' );
			$parser->parseFile( get_stylesheet_directory().'/styles/customizer.less', get_stylesheet_directory() );
			$css = $parser->getCss();
			echo "<style>".$css."</style>";
		
		} catch(Exception $e)
		{
	    	$error_message = $e->getMessage();
		}
	}
	
}
add_action( 'wp_head', 'pharmeon_master_theme_customize_colors' );
