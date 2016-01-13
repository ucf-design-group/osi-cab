<?php
/**
 * Template Name: Homepage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'homepage' ); ?>

				<?php endwhile; // end of the loop. ?>
				
				<?php
					$todaysDate = time();
					$eventMarker = 0;

					$eventCountQuery = array( 'post_type' => 'osi-events', 'posts_per_page' => 3, 'meta_key' => 'oe-form-start', 'orderby' => 'meta_value', 'order' => 'DESC' );
					$eventCountloop = new WP_Query( $eventCountQuery );
					while ( $eventCountloop->have_posts() ) {
						$eventCountloop->the_post();
						$eventDate = get_post_meta($post->ID, 'oe-form-start', true);
						$eventMarker = $eventDate;
					}

					if ($eventMarker > $todaysDate) {
						$eventMarker = $todaysDate;
					}

					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'osi-events', 'posts_per_page' => -1, 'meta_key' => 'oe-form-start', 'orderby' => 'meta_value', 'order' => 'ASC' );
					$loop = new WP_Query( $eventsQuery );

					//format for images
					$poster = array(
							//In CSS as .attachment-poster
							'class'	=> "poster",
						);
					?>
					<!-- future events -->
					<div class='upcoming-events'>
						<?php

						$count = 0;
						while ( $loop->have_posts() && $count < 3) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'oe-form-start', true);
						//compare dates
						$pathToImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
						
						if( $thedate >= $eventMarker ) {
							// div for each event 
							echo "<div class='events' style='background: url({$pathToImage}) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'><a href='" . get_permalink() . "'>";
						?>
							<h3><?php the_title(); ?></h3>
								<?php
								//get date
								$month = date('F', $thedate);
								$day = date('j', $thedate);
								$time = date('g:i a', $thedate);
								//echo the date info in divs
								?>
								<div class="event-date">
									<?php
									echo "<span class='month'>".$month."</span>";
									echo "<span class='day'>".$day."</span>";
									echo "<span class='time'>".$time."</span>";
									?>
								</div>
								<?php
								//the poster for the event
								
								//echo "<a href='{$link}'>";
								//the_post_thumbnail( 'medium', $poster); // Warning: Need an end tag if this is uncommented.
								$count++;
								echo "</a></div>";
							}

						endwhile; ?>
					</div>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>