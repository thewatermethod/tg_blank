<?php

function tg_set_google_fonts(){

	$google_fonts_api_key = false;

	include 'keys.php';

	if( !$google_fonts_api_key ){
		return false;
	}

	if ( false === ( $google_fonts = get_transient( 'google-fonts' ) ) ) {

	  	$url = 'https://www.googleapis.com/webfonts/v1/webfonts?key='. $google_fonts_api_key;

		$google_fonts = wp_remote_get( $url );

	 	set_transient( 'google-fonts', $google_fonts, 48 * HOUR_IN_SECONDS );

	 	return json_decode( $google_fonts['body'] );

	}	
	
	$google_fonts = get_transient( 'google-fonts' );

	return json_decode( $google_fonts['body'] );


}

function tg_google_fonts(){

	if( !get_theme_mod('body_font') && !get_theme_mod('header_font') ){
		return;
	}

	$body = get_theme_mod('body_font');
	$headings = get_theme_mod('header_font');
	

	?>
	<style>

		<?php if( $body && $headings ): ?>
			@import url('https://fonts.googleapis.com/css?family=<?php echo $body; ?>|<?php echo $headings; ?>');
		<?php elseif( $body && !$headings ) :?>
			@import url('https://fonts.googleapis.com/css?family=<?php echo $body; ?>');
		<?php else:	?>
			@import url('https://fonts.googleapis.com/css?family=<?php echo $headings; ?>');
		<?php endif; ?>

		<?php if( $body ) :?>
			body{
				font-family: '<?php echo $body; ?>' ;
			}
		<?php endif; ?>


		<?php if( $headings ) :?>
			.site-title, .site-header .hero, .main-navigation a,  h1,h2,h3,h4,h5,h6{
				font-family: '<?php echo $headings; ?>' ;
			}
		<?php endif; ?>

	</style>

	<?php
}