<?php

// add a button shortcode for text callouts

function soares_callout( $atts, $content = "" ) {
	return "content = $content";
}
add_shortcode( 'callout', 'soares_callout' );