<?php /* Template Name: Home Page Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package twilitgrotto
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
				// get number of testimonials

				if( have_rows('posts_layer') ):

					while( have_rows('posts_layer') ): the_row();
						
						$value = get_sub_field('number_to_show');
				
					endwhile;
				
				endif;
			
				if( $value > 0) {
					
					$testimonial_args = array(
						'post_type' => 'testimonial',
						'orderby'=> 'rand',
						'posts_per_page' => $value
					);
					
					$testimonials = get_posts( $testimonial_args );

					var_dump( $testimonials);

				}

			?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
