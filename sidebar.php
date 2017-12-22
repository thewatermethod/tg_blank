<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package twilitgrotto
 */

if ( ! is_active_sidebar( 'sidebar-1' )  || get_theme_mod('sidebar_location') == 3 ) {
	return;
}
?>


<aside id="secondary" class="widget-area sticks-to-top" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
