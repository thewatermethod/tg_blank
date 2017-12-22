<?php

function tg_get_header_message(){ 

	if( get_theme_mod('show_home_callout') == 0 || get_theme_mod('home_callout_message') == null ) {
		return;
	}	

	if( get_theme_mod('show_home_callout') == 1 ){

		if( !get_header_image() ){
			return;
		}

		?>

			<div class="hero"><?php echo get_theme_mod('home_callout_message'); ?></div>

		<?php

	} else { ?>


		   <div class="banner <?php if( get_theme_mod('show_home_callout') == 2 ): echo 'home-only'; endif; ?> "><?php echo get_theme_mod('home_callout_message'); ?></div>

		<?php
	}


}