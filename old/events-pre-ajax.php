<?php
/**
 * Template Name: Events-OLD
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
				
				<?php
					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'ASC' );
					$loop = new WP_Query( $eventsQuery );

					//grab today's date to organize the page
					$todaysDate = time();

					//format for images
					$poster = array(
							//In CSS as .attachment-poster
							'class'	=> "poster",
						);
					?>
					<!-- future events -->
					<div class='future'>
						<?php 
						while ( $loop->have_posts() ) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate >= $todaysDate ) { 
						?>
							<h2><?php the_title(); ?></h2>
							<!-- div for each event -->
							<div class="events">
								<?php
								//get date
								$month = date('F', $thedate);
								$day = date('j', $thedate);
								$time = date('g:i a', $thedate);
								//echo the date info in divs
								?>
								<div class="event-date">
									<?php
									echo "<div class='month'>".$month."</div>";
									echo "<div class='day'>".$day."</div>";
									echo "<div class='time'>".$time."</div>";
									?>
								</div>
								<?php
								//the poster for the event
								$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								echo "<a href='{$link}'>";
								the_post_thumbnail( 'medium', $poster); ?></a>
								
							</div>
						<?php 
						}
						endwhile;
						?>
					</div>
					<?php
					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'DESC' );
					$loop = new WP_Query( $eventsQuery ); ?>
					<!-- past events -->
					<div class='past'>
						<?php 
						while ( $loop->have_posts() ) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate < $todaysDate ) { 
						?>
							<h2><?php the_title(); ?></h2>
							<!-- div for each event -->
							<div class="events">
								<?php
								//get date
								$month = date('F', $thedate);
								$day = date('j', $thedate);
								$time = date('g:i a', $thedate);
								//echo the date info in divs
								?>
								<div class="event-date">
									<?php
									echo "<div class='month'>".$month."</div>";
									echo "<div class='day'>".$day."</div>";
									echo "<div class='time'>".$time."</div>";
									?>
								</div>
								<?php
								//the poster for the event
								$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								echo "<a href='{$link}'>";
								the_post_thumbnail( 'medium', $poster); ?></a>
							</div>
						<?php 
						}
						endwhile;
						?>
					</div>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>