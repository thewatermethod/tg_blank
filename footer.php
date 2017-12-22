<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package twilitgrotto
 */

?>
		</div><!-- flexy -->
	</div><!-- #content -->

		<?php 

		if ( is_active_sidebar( 'sidebar-2' ) ) {	?>


		<aside id="secondary" class="widget-area subfooter flexy" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside><!-- #secondary -->

	<?php } ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			Theme by <a href="https://whalingcityweb.com/" rel="designer">Whaling City Web</a>
			<span class="sep"> | </span>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twilitgrotto' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'twilitgrotto' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
