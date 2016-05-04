<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>
				</main><!-- #main -->
			</div><!-- .innerWrapper -->		
		</div><!-- #content -->
	</div><!-- #flexwrapper -->

	<footer id="footer" class="site-footer" role="contentinfo">
		<div class="innerWrapper">
			<div class="site-info">
				<span class="footerLinks">
					<?php dynamic_sidebar( 'Sidebar 6' ); ?>
				</span>
				<a id="poweredby" href="https://www.pharmeon.nl" target="_blank">Powered by Pharmeon</a>				
			</div><!-- .site-info -->
			<a id="toTop" href="#docTop"></a>
		</div><!-- .innerWrapper -->
	</footer><!-- #footer -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
