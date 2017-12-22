<?php

	function tg_get_color_scheme(){

		$header_color = get_theme_mod('header_color');

		?>

			<style>

				header.site-header{
					background: <?php echo $header_color; ?>
				}


				@media screen and (max-width: 37.5em){

					.menu ul.nav-menu {
						background: <?php echo $header_color; ?>
					}

				}

			</style>

		<?php

	}

