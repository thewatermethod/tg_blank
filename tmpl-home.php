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
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );





			
				// get number of testimonials

				$show_tesimonials = false;

				if( get_field('add_testimonials_block')  ):
					$show_tesimonials = true;
					$value = 4;
				endif;
			
				if( $show_tesimonials ) {
					
					$testimonial_args = array(
						'post_type' => 'testimonial',
						'orderby'=> 'rand',
						'posts_per_page' => $value
					);
					
					$testimonials = get_posts( $testimonial_args );
					?>

					<h2>What Customers Have Said About <?php echo bloginfo('name'); ?></h2>
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
			
			if( have_rows('services_we_offer') ): 
				$tab_titles = array();

			?>

				<h2>Services We Offer</h2> <?php

				while( have_rows('services_we_offer') ): the_row();
					
					$tab_titles[] = get_sub_field('service_name');			
						
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
							while( have_rows('services_we_offer') ): the_row();
							$tab_description = get_sub_field('service_description');
							$tab_title = get_sub_field('service_name');
				
								?>

						<div class="tabs_item">
						
							<h3><?php echo $tab_title; ?></h3>
							
						
						<?php echo $tab_description; ?></div>
								
						<?php
							endwhile;  ?>
					
					</div>
				</div>
				
		<?php endif;

			if( have_rows('content_block') ):

				while( have_rows('content_block') ): the_row();
					
					$content_header = get_sub_field('content_header');
					$content = get_sub_field('content');

				?>

					<div class="full-content">
						<h2><?php echo $content_header; ?></h2>
						<?php echo $content; ?>					
					</div>

			<?php
				endwhile;

			endif;

			if( have_rows('additional_septic_services') ):

				?>
				<h2>Septic Services We Offer</h2>
				<div class="services-summary">
				<?php

				while( have_rows('additional_septic_services') ): the_row(); 

					$title = get_sub_field('service_name');
					$summary = get_sub_field('service_description');
				
				?>

					<div>
						<h3><?php echo $title; ?></h3>
						<p><?php echo $summary; ?></p>
					</div>
			
				<?php 
				
				endwhile;

				?></div><?php

			endif;

			
			endwhile; // End of the loop.
			?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
