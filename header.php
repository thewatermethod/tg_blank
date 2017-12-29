<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package twilitgrotto
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

<?php tg_google_fonts(); ?>
<?php tg_get_color_scheme(); ?>
<?php $logo = tg_get_logo(); ?>

<?php 

	$title_class = 'site-title';

	if( $logo ) {
		$title_class = 'site-title screen-reader-text';
	}

?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'twilitgrotto' ); ?></a>

	<header id="masthead" class="site-header <?php if( get_header_image() ) : ?>header-image<?php endif; ?>" 
			role="banner" style="<?php if( get_header_image() ) : ?> background-image: url( <?php echo header_image(); endif; ?>);">

		<div class="flexy">

			<div class="site-branding">
				<?php

				if( $logo ){
					echo '<a href="'.esc_url( home_url( '/' ) ).'">';
					echo '<img src='.$logo[0].' alt=""></a>';
				}

				if ( is_front_page() || is_home() ) : ?>
					<h1 class="<?php echo $title_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="<?php echo $title_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<nav id="top-navigation" class="top-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
	            	<div class="menui top-menu"></div>
	            	<div class="menui mid-menu"></div>
	            	<div class="menui bottom-menu"></div>
	    		</button>
				<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'menu_id' => 'top-menu' ) ); ?>
			</nav><!-- #site-navigation -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false">
	            	<div class="menui top-menu"></div>
	            	<div class="menui mid-menu"></div>
	            	<div class="menui bottom-menu"></div>
	    		</button>
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_id' => 'main-menu' ) ); ?>
			</nav><!-- #site-navigation -->
			
			<?php tg_get_header_message(); ?>

		</div><!-- inner -->
	</header><!-- #masthead -->

	<div id="content" class="site-content inner">
		<div class="flexy <?php if (get_theme_mod('sidebar_location') == 1): echo 'reverse'; endif; if (get_theme_mod('sidebar_location') == 2): echo 'top-down'; endif; ?>">
