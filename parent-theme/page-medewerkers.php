<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2 class="content-title"><?php the_title(); ?></h2>	
				<?php the_content(); ?>
				
				<?php
				if ( shortcode_exists( 'medewerkers' ) ) 
				{
					
					echo do_shortcode('[medewerkers]');	
				}		
				?>
				
				<?php endwhile; else: ?>
					<p><?php _e('Sorry, we hebben geen pagina gevonden.'); ?></p>
				<?php endif; ?>
				
<?php get_footer(); ?>
