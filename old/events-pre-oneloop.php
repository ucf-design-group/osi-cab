<?php
/**
 * Template Name: Events
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
						<h2>Upcoming Events</h2>
						<?php
						$futureCount = 0;
						while ( $loop->have_posts() && $futureCount < 10) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate >= $todaysDate ) { 
						?>
							<h3><?php the_title(); ?></h3>
							<!-- div for each event -->
							<div class="events">
								<?php
								//get date
								$month = date('F', $thedate);
								$day = date('j', $thedate);
								$time = date('g:i a', $thedate);
								$linkToAlbum = get_post_meta($post->ID, 'event-meta-album', true);
								$category = get_the_category();
								$category = $category[0]->cat_name;
								$category = strtolower($category);
								$category =  str_replace(" ", "-", $category);
								//echo the date info in divs
								?>
								<div class="event-date">
									<?php
									echo "<div class='month'>".$month."</div>";
									echo "<div class='day'>".$day."</div>";
									echo "<div class='time'>".$time."</div>";
									echo "<a href='../committees-contact'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/{$category}.png' alt='Event Photos' /></a>";
									echo "<a href='{$linkToAlbum}'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/pictures-icon.png' alt='Event Photos' /></a>";
									?>
								</div>
								<?php
								//the poster for the event
								$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								echo "<a href='{$link}'>";
								the_post_thumbnail( 'medium', $poster);
								$futureCount++; ?></a>
								<?php
								if ($futureCount == 10 && $loop->have_posts()) {
									$lastEvent = $thedate;
								}
								?>
							</div>
						<?php 
						}
						endwhile;
						if ($lastEvent != 0) {
							echo "<div id='".$lastEvent. "' class='load-events'>Load More Events</div>";
						}
						?>
					</div>
					<?php
					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'DESC' );
					$loop = new WP_Query( $eventsQuery ); ?>
					<!-- past events -->
					<div class='past'>
						<h2>Past Events</h2>
						<?php 
						$pastCount = 0;
						while ( $loop->have_posts() && $pastCount < 10) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate < $todaysDate ) { 
						?>
							<h3><?php the_title(); ?></h3>
							<!-- div for each event -->
							<div class="events">
								<?php
								//get date
								$month = date('F', $thedate);
								$day = date('j', $thedate);
								$time = date('g:i a', $thedate);
								$linkToAlbum = get_post_meta($post->ID, 'event-meta-album', true);
								$category = get_the_category();
								$category = $category[0]->cat_name;
								$category = strtolower($category);
								$category =  str_replace(" ", "-", $category);
								//echo the date info in divs
								?>
								<div class="event-date">
									<?php
									echo "<div class='month'>".$month."</div>";
									echo "<div class='day'>".$day."</div>";
									echo "<div class='time'>".$time."</div>";
									echo "<a href='../committees-contact'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/{$category}.png' alt='Event Photos' /></a>";
									echo "<a href='{$linkToAlbum}'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/pictures-icon.png' alt='Event Photos' /></a>";
									?>
								</div>
								<?php
								//the poster for the event
								$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								echo "<a href='{$link}'>";
								the_post_thumbnail( 'medium', $poster);
								$pastCount++; ?></a>
								<?php
								if ($pastCount == 10 && $loop->have_posts()) {
									$lastEvent = $thedate;
								}
								?>
							</div>
						<?php 
						}
						endwhile;
						if ($lastEvent != 0) {
							echo "<div id='".$lastEvent. "' class='load-events'><a href='#'>Load More Events</a></div>";
						}
						?>
					</div>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.scrollbeacon.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/eventRetrieval.js"></script>
		
<?php get_footer(); ?>