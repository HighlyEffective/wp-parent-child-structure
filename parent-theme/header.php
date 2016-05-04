<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="flexWrapper">
		<a id="docTop" name="docTop"></a>

		<header id="header" class="site-header" role="banner">
			<div class="innerWrapper">

			</div><!-- .innerWrapper -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
			<div class="innerWrapper">

				<div class="mainMenuWrapper">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Menu</button>
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_id' => 'primary-menu', 
							'container' => '', ) 
						); ?>
					</nav><!-- #site-navigation -->
				</div><!-- .mainMenuWrapper -->
				<main id="main" class="site-main" role="main">
