<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package twilitgrotto
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function twilitgrotto_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twilitgrotto_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twilitgrotto_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'twilitgrotto_pingback_header' );

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];
    return $first_img;
}	


function twilit_grotto_filter_content( $content ){

	//filter out <b>, <u>, and <i> tags from the content
	global $allowedposttags;
	unset( $allowedposttags['b'] );
	unset( $allowedposttags['u'] );
	unset( $allowedposttags['i'] );

	$filtered = wp_kses_post( $content ); 		
	$content = $filtered;

	//filter out empty p, h1, h2 tags
	$content = force_balance_tags($content);
	$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
	$content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );

	$content = preg_replace( '#<h[1-6]>\s*+(<br\s*/*>)?\s*</h[1-6]>#i', '', $content );
	$content = preg_replace( '~\s?<h[1-6]>(\s|&nbsp;)+</h[1-6]>\s?~', '', $content );

	//returns the content
	return $content;
}

add_filter('the_content', 'twilit_grotto_filter_content');