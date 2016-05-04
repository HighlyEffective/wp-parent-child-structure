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
<?php
	$praktijkdata = get_option('praktijkdata');
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
			<div id="topHeader">
				<div class="innerWrapper">
					<span class="adressInfo">
						<?php 
							$addressinfo = $praktijkdata["address"];
							$addressinfo .= " ".$praktijkdata["housenumber"]. " | ";
							$addressinfo .= " ".$praktijkdata["zipcode"];
							$addressinfo .= " ".$praktijkdata["city"]. " | ";
							$addressinfo .= " ".$praktijkdata["phonenumber"];
							echo $addressinfo; 
						?>
                    </span>
					<span class="socialLinks">CHILD!!!!!!!!!!!!
						<?php if ( !empty($praktijkdata["facebookurl"]) ) {	
							echo "<a href='".$praktijkdata["facebookurl"]."' target='_blank'><i class='fa fa-facebook-f'></i></a>";					
						} ?>						
						<?php if ( !empty($praktijkdata["twitterurl"]) ) {	
							echo "<a href='".$praktijkdata["twitterurl"]."' target='_blank'><i class='fa fa-twitter'></i></a>";					
						} ?>
						<?php if ( !empty($praktijkdata["linkedinurl"]) ) {	
							echo "<a href='".$praktijkdata["linkedinurl"]."' target='_blank'><i class='fa fa-linkedin'></i></a>";					
						} ?>						
					</span>
				</div>
			</div>
			<div class="innerWrapper">
				<?php if ( get_theme_mod( 'pharmeon_master_theme_logo' ) && is_home() ) { ?>
					<div class='logoWrapper'>
						<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'pharmeon_master_theme_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
					</div>
				<?php } ?>

				<div class="sliderWrapper">
					<img src="<?php header_image(); ?>" alt="Header afbeelding" />					
				</div>
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div><!-- .site-branding -->	

				<div class="headerLinkWrapper">
                  <div class="headerLink">
                    <?php dynamic_sidebar( 'Sidebar 5' ); ?>
                  </div>
                </div> 

			</div><!-- .innerWrapper -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
			<div class="innerWrapper">

				<div class="mainMenuWrapper">
					<?php dynamic_sidebar( 'Sidebar 1' ); ?>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i>Menu</button>
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_id' => 'primary-menu', 
							'container' => '', ) 
						); ?>
					</nav><!-- #site-navigation -->
					<?php dynamic_sidebar( 'Sidebar 2' ); ?>
				</div><!-- .mainMenuWrapper -->
					<main id="main" class="site-main" role="main">

