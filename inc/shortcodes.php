<?php

// add a button shortcode for text callouts

function soares_callout( $atts, $content = "" ) {
	
	// Attributes
	$atts = shortcode_atts(
		array(
			'url' => home_url('/'),
		),
		$atts,
		'callout'
	);

	return '<a href="'.$atts['url'].'" class="callout box-shadow"><span class="callout-inner">'.$content.'</span></a>';
}

add_shortcode( 'callout', 'soares_callout' );
add_filter( 'widget_text', 'do_shortcode' );
