<?php /* Template Name: Home Page Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package twilitgrotto
 */

get_header(); ?>

	<div id="primary" class="content-area home-tmpl">
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
					?>

					<h2>What Customers Have Said About Us</h2>
					<div class="testimonials">
						
						<?php

						foreach ($testimonials as $testimonial) { ?>
						
							<div class="testimonial">
								<div class="quote">
									<p><?php echo $testimonial->post_content; ?></p>
								</div>
								<div class="customer">
									<h3><?php echo $testimonial->post_title; ?></h3>
								</div>
							</div>					

					<?php
						}
					?></div><?php
				}

			//
			
			if( have_rows('services_layer') ): 
				$tab_titles = array();

			?>

				<h2>Services We Offer</h2> <?php

				while( have_rows('services_layer') ): the_row();
					
					$tab_titles[] = get_sub_field('title');			
						
				endwhile; 
				
				?>
				<div class="tab">
					<ul class="tabs">
					
					<?php

					foreach ( $tab_titles as $tab_title ) { ?>
						<li><?php echo $tab_title; ?></li>
					<?php 
					}
					?>
					
					</ul>

					<div class="tab_content">

						<?php 
							while( have_rows('services_layer') ): the_row();
							$tab_description = get_sub_field('description');
							$tab_title = get_sub_field('title');
							$tab_thumbnail = get_sub_field('thumbnail');    
								?>

						<div class="tabs_item">
						
							<h3><?php echo $tab_title; ?></h3>

							<?php if( $tab_thumbnail ) : ?>
								<img alt="" src="<?php echo $tab_thumbnails;?>"> 
							<?php endif;
							
							echo $tab_description; 
							
						?></div>
								
						<?php
							endwhile;  ?>
					
					</div>
				</div>
				
		<?php endif;

			if( have_rows('content_section') ):

				while( have_rows('content_section') ): the_row();
					
					$bg_color = get_sub_field('background_color');
					$bg_image = get_sub_field('background_image');
					$content = get_sub_field('content');

				?>

					<div class="full-content box-shadow <?php echo $bg_color;?>">
						<?php echo $content; ?>					
					</div>

			<?php
				endwhile;

			endif;

			if( have_rows('services_summary') ):

				?>
				<h2>Septic Services We Offer</h2>
				<div class="services-summary">
				<?php

				while( have_rows('services_summary') ): the_row(); 

					$title = get_sub_field('title');
					$summary = get_sub_field('summary');
				
				?>

					<div>
						<h3><?php echo $title; ?></h3>
						<p><?php echo $summary; ?></p>
					</div>
			
				<?php 
				
				endwhile;

				?></div><?php

			endif;

			?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
