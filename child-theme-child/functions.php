<?php
/**
 * UPO2015 functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package UPO2015
 */


/**
 * Create available sidebars
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function pharmeon_master_theme_vars () {
	global $headerImgWidth, $headerImgHeight;
	$headerImgWidth = '1280';
	$headerImgHeight = '480';
}
add_action( 'after_setup_theme', 'pharmeon_master_theme_vars' );


 
function UPO2015_widgets_init() 
{
	$widget_spaces = array(
					"Ruimte boven het menu",
					"Ruimte onder het menu",
					"Ruimte onder de pagina tekst",
					"Blokken onder de header afbeelding",
					"Blok in de header afbeelding",
					"Footer ruimte");
	$areas = sizeof($widget_spaces);
	for($i=0;$i<$areas;$i++)
	{
		$nr = $i+1;	
		register_sidebar( array(
		'name'          => $widget_spaces[$i],
		'id'            => 'sidebar'.$nr,
		'before_widget' => '<aside id="%1$s" class="widget %1$s %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
	}
	
}
add_action( 'widgets_init', 'UPO2015_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function UPO2015_scripts() {
	wp_enqueue_style( 'UPO2015-style', get_stylesheet_uri() );
	wp_enqueue_script( 'UPO2015-script',  get_stylesheet_directory_uri(). '/js/style.js', array(), '20150908', true );

}
add_action( 'wp_enqueue_scripts', 'UPO2015_scripts' );

