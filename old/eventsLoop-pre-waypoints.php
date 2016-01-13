<?php

// Our include  
define('WP_USE_THEMES', false);  
require_once('../../../wp-load.php');


// Our variables
$pastOrFuture = (isset($_GET['pastorfuture'])) ? $_GET['pastorfuture'] : '';
$startEvent = (isset($_GET['start'])) ? $_GET['start'] : '';
$number = (isset($_GET['number'])) ? $_GET['number'] : '';

if ($pastOrFuture == "past") {
					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'DESC' );
					$loop = new WP_Query( $eventsQuery );

					//format for images
					$poster = array(
							//In CSS as .attachment-poster
							'class'	=> "poster",
						);
					?>
						<?php 
						$futureCount = 0;
						while ( $loop->have_posts() && $futureCount < $number) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate < $startEvent ) { 
						?>
							<h2><?php the_title(); ?></h2>
							<!-- div for each event -->
							<div class="events" id="<?php echo $thedate; ?>">
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
								the_post_thumbnail( 'medium', $poster);
								$futureCount++; ?></a>
								<?php
								if ($futureCount == $number && $loop->have_posts()) {
									echo "<div class='load-events'>Load More Events</div>";
								}
								?>
							</div>
						<?php 
						}
						endwhile;
						?>
					</div>
<?php
}
else {
					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'ASC' );
					$loop = new WP_Query( $eventsQuery );

					//format for images
					$poster = array(
							//In CSS as .attachment-poster
							'class'	=> "poster",
						);
					?>
						<?php
						$pastCount = 0;
						while ( $loop->have_posts() && $pastCount < $number) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate > $startEvent ) { 
						?>
							<h2><?php the_title(); ?></h2>
							<!-- div for each event -->
							<div class="events" id="<?php echo $thedate; ?>">
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
								the_post_thumbnail( 'medium', $poster);
								$pastCount++; ?></a>
								<?php
								if ($pastCount == $number && $loop->have_posts()) {
									echo "<div class='load-events'>Load More Events</div>";
								}
								?>
							</div>
						<?php 
						}
						endwhile;
						?>
					</div>
<?php } ?>